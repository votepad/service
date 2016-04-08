<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 03.04.2016
 * Time: 12:31
 */

class Model_Uploader extends Model {

    public $file;
    public $index;
    public $substance;

    public function __construct( $file, $substance, $index)
    {
        $this->substance    = $substance;
        $this->index         = $index;
        $this->file         = $file;
    }

    public function upload()
    {
        $temporary = explode(".", $_FILES[$this->substance . '_' . $this->index ]["name"]);
        $file_extension = end($temporary);

        if ((($this->file['type'] == "image/png")
                || ($this->file["type"] == "image/jpg")
                || ($this->file["type"] == "image/jpeg")
                || ($this->file["type"] == "image/gif" )))
        {
            move_uploaded_file($this->file['tmp_name'], DOCROOT. '/uploads/' . basename($this->file['name']) );
        }
    }



    public static function fileTransport($file, $uploadInputName)
    {
        move_uploaded_file($file[$uploadInputName]["tmp_name"], DOCROOT. '/uploads/' . basename($file[$uploadInputName]['name']) );
    }


}