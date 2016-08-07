<?php
/**
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */

class Model_Excel {

    const WorkSheetTYPE     = 'Excel2007';
    const WorkSheetEXT      = 'xlsx';
    const WorkBookUploads   = 'events';

    /**
     * @todo Plug in configs.
     */
    public static function instance(){

    }

    /**
     * @param $eventName [String] - Creating Excel file with event name.
     */
    public static function createNewEventsSheet($eventName) {

        /**
         * Setting default configuration as standarts
         */
        $excel = new PHPExcel();
        $excel->getProperties()
            ->setTitle($eventName)
            ->setCreator('Khaydarov Murod')
            ->setCompany('ProNWE');


        $sheet1 = $excel->getSheet(0);
        $sheet1->setTitle('ИТОГ');

        $sheet1->setCellValue('C1', 'Название конкурсов');
        $sheet1->setCellValue('C2', 'Максимальное значение');
        $sheet1->setCellValue('C2', 'Приоритет конкурса');


        $dataHeaders = array(
            'ID участника', 'Порядок выступления', 'Участники'
        );

        $headers = 'A4:C4';

        $sheet1->fromArray($dataHeaders, ' ', 'A4');

        $sheet1->getStyle($headers)
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('00ccfe');

        $style = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );

        $sheet1->getStyle($headers)->applyFromArray($style);


        for ($col = ord('a'); $col <= ord('c'); $col++)
        {
            $sheet1->getColumnDimension(chr($col))->setAutoSize(true);
        }

        /**
         * Creation WorkBook
         */
        $writer = PHPExcel_IOFactory::createWriter($excel, self::WorkSheetTYPE);
        $writer->save(self::WorkBookUploads. '/'. $eventName. '.' . self::WorkSheetEXT);

    }

    /**
     * @param $sheet [Object] - Worksheet
     * @param $interval [String] - Cell from
     * @param $style [Array] - Styles
     */
    public static function setHeaders($sheet, $interval, $style) {


    }

}