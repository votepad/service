<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model_Uploader
 */

class Model_Uploader extends Model
{
    /**
     *	Site Methods Model
     */
    public $IMAGE_SIZES_CONFIG = array(

        // первый параметр - вырезать квадрат (true) или просто ресайзить с сохранением пропрорций (false)
        'o'  => array(false , 1500, 1500 ),
        'b'  => array(true , 200 ),
        'm'  => array(true , 100 ),
        's'  => array(true , 50  ),
    );

    public function save_cover($cover)
    {
        $new_name = bin2hex(openssl_random_pseudo_bytes(5));
        $cover['name'] = $new_name . '.' . pathinfo($cover['name'], PATHINFO_EXTENSION);
        $uploaddir = 'upload/covers/';

        if ($file = Upload::save($cover, NULL, $uploaddir)) {
            Image::factory($file)->save($uploaddir . $cover['name']);
            unlink($file);
            return $cover['name'];
        } else {
            return false;
        }
    }
    public function saveImage( $file , $path )
    {
        /**
         *   Проверки на  Upload::valid($file) OR Upload::not_empty($file) OR Upload::size($file, '8M') делаются в контроллере.
         */
        if (!Upload::type($file, array('jpg', 'jpeg', 'png', 'gif'))) return FALSE;
        if (!is_dir($path)) mkdir($path);

        if ( $file = Upload::save($file, NULL, $path) ){
            $filename = bin2hex(openssl_random_pseudo_bytes(16)) . '.jpg';
            $image = Image::factory($file);
            foreach ($this->IMAGE_SIZES_CONFIG as $prefix => $sizes) {
                $isSquare = !!$sizes[0];
                $width    = $sizes[1];
                $height   = !$isSquare ? $sizes[2] : $width;
                $image->background('#fff');
                // Вырезание квадрата
                if ( $isSquare ){
                    if ( $image->width >= $image->height ) {
                        $image->resize( NULL , $height, true );
                    } else {
                        $image->resize( $width , NULL, true );
                    }
                    $image->crop( $width, $height );
                } else {
                    if ( $image->width > $width || $image->height > $height  ) {
                        $image->resize( $width , $height , true );
                    }
                }
                $image->save($path . $prefix . '_' . $filename);
            }
            // Delete the temporary file
            unlink($file);
            return $filename;
        }
        return FALSE;
    }
    /**
     * @param array $sizes - array of keys in IMAGE_SIZES_CONFIG that need to be cropped
     * @param array $forcedSizes - new size config looks like IMAGE_SIZES_CONFIG
     */
    public function saveImageByUrl( $url, $path, $sizes = null, $forcedSizes = null )
    {
        $file = $this->getFiles($url);
        if ($file) {
            if (!Upload::type($file, array('jpg', 'jpeg', 'png', 'gif'))) return FALSE;
            if (!is_dir($path)) mkdir($path);
            return $this->saveImage($file, $path, $sizes, $forcedSizes);
        }
        return false;
    }
    public function getFiles($url)
    {
        $tempName = tempnam('/tmp', 'tmp_files');
        $originalName = basename(parse_url($url, PHP_URL_PATH));
        $imgRawData = @file_get_contents($url);
        if (!$imgRawData) return false;
        file_put_contents($tempName, $imgRawData);
        return array(
            'name' => $originalName,
            'type' => mime_content_type($tempName),
            'tmp_name' => $tempName,
            'error' => 0,
            'size' => strlen($imgRawData),
        );
    }
    /** Saving uploaded file to database */
    public function newFile( $fields )
    {
        return current(DB::insert( 'files' , array_keys($fields) )->values(array_values($fields))->execute());
    }
    public static function getUriByTitle($string)
    {
        // заменяем все кириллические символы на латиницу
        $converted_string = self::rus2translit($string);
        // заменяем все не цифры и не буквы на дефисы
        $converted_string = preg_replace("/[^0-9a-zA-Z]/", "-", $converted_string);
        // заменяем несколько дефисов на один
        $converted_string = preg_replace('/-{2,}/', '-', $converted_string);
        // отсекаем лишние дефисы по краям
        $converted_string = trim($converted_string, '-');
        return $converted_string;
    }
    /**
     * Транслитерация кириллицы
     * @param string $string - строка с киррилицей
     */
    public static function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => "",    'ы' => 'y',   'ъ' => "",
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => "",    'Ы' => 'Y',   'Ъ' => "",
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            ' ' => '_',   '-' => '_',   '-' => '_',    '.' => '_',
            ',' => '_',   '\'' => '',   '\"' => '',    '(' => '_', ')' => '_',
            '?' => '_',   '#' => '_',   '$' => '_',    '!' => '_',
            '@' => '_',   '%' => '^',   '&' => '_',    '*' => '_',
            '`' => '_',   '\\' => '_',  '/' => '_'//,    '*' => '_'
        );
        // translit
        $tmp = strtr($string, $converter);
        // remove underline from begin and end of line
        $tmp = trim($tmp, "_");
        // replace lines
        $tmp = strtr($tmp, array(
            "__"    => "_",
            "___"   => "_",
            "____"  => "_",
            "_____" => "_",
        ));
        return $tmp;
    }

    /**
     * Рекурсивно создает директории по указанному пути
     * @param string $path - строка с киррилицей
     * @param int $rights   - права на директории. По умолчанию 0777
     */
    function CreateDirRec($path, $rights = 0777){
        //        mkdir($parh, $rights, true); // do not work recursivle on win :(
        $arr = explode('/', $path);
        $dir = "";
        foreach($arr as $key => $val){
            $dir .= $val . "/";
            if (!file_exists($dir))
                mkdir($dir, $rights);
        }
    }
    
}