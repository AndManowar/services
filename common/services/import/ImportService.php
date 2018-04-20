<?php

namespace common\services\import;

use common\models\forms\ProductForm;
use common\models\ProductsPhotos;
use common\models\ProductsProperties;
use PHPExcel;
use PHPExcel_Exception;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Exception;
use PHPExcel_Worksheet_MemoryDrawing;
use Yii;

/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 11.04.18
 * Time: 16:10
 */

/**
 * Class ImportService
 * @package common\services\import
 */
class ImportService
{

    /**
     * @param string $filePath
     * @return bool
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     * @throws \yii\db\Exception
     */
    public function import($filePath)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($filePath);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray();

        $attributes = $sheetData[0];

        unset($sheetData[0]);

        $transaction = Yii::$app->db->beginTransaction();

        foreach ($sheetData as $data) {

            $query_array = [];

            foreach ($data as $attr_id => $attributeValue) {
                $query_array[$attributes[$attr_id]] = $attributeValue;
            }

            $productForm = new ProductForm();
            $productForm->setAttributes($query_array, false);

            if (!$productForm->importFromFile()) {
                $transaction->rollBack();
                return false;
            }
        }

        $transaction->commit();
        return true;
    }

    public function newImport($filePath)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($filePath);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray();

        $photos = $this->getImages($objPHPExcel);

        unset($sheetData[0]);

        $attributes = [
            3 => 'barcode',
            5 => 'name',
            6 => 'hidden_price',
        ];

        $transaction = Yii::$app->db->beginTransaction();

        foreach ($sheetData as $id => $data) {

            $query_array = [];

            foreach ($data as $attr_id => $attributeValue) {
                if (isset($attributes[$attr_id])) {
                    $query_array[$attributes[$attr_id]] = $attributeValue;
                }
            }
            $query_array['product_photos'] = new ProductsPhotos(['photo_path' => $photos[$id - 1]]);
            $query_array['product_properties'] = new ProductsProperties(['remains' => isset($data[7]) ? $data[7] : 0, 'vendor_code' => isset($data[1]) ? (string)$data[1] : 'none']);

            $productForm = new ProductForm();
            $productForm->setAttributes($query_array, false);

            if (!$productForm->importFromFile()) {
                $transaction->rollBack();
                return false;
            }
        }


        $transaction->commit();
        return true;
    }

    /**
     * @param PHPExcel $objPHPExcel
     * @return array
     */
    private function getImages($objPHPExcel)
    {
        $i = 0;
        $photos = [];

        /** @var PHPExcel_Worksheet_MemoryDrawing $drawing */
        foreach ($objPHPExcel->getActiveSheet()->getDrawingCollection() as $drawing) {

            ob_start();
            call_user_func(
                $drawing->getRenderingFunction(),
                $drawing->getImageResource()
            );
            $imageContents = ob_get_contents();
            ob_end_clean();

            switch ($drawing->getMimeType()) {

                case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_PNG :
                    $extension = 'png';
                    break;
                case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_GIF:
                    $extension = 'gif';
                    break;
                case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_JPEG :
                    $extension = 'jpg';
                    break;
                default:
                    $extension = 'jpg';
                    break;
            }

            $fileName = Yii::getAlias('@uploadPath') . '/' . 'product_image' . $i . '.' . $extension;
            $photos[] = '/frontend/web/uploads/product_image' . $i . '.' . $extension;
            file_put_contents($fileName, $imageContents);
            $i++;
        }

        return $photos;
    }

}