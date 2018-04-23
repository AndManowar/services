<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 20.04.18
 * Time: 16:56
 */

namespace common\components\handbook\services;

use common\components\handbook\models\Handbook;
use common\components\handbook\models\HandbookData;
use common\components\handbook\models\HandbookFields;

class HbService
{
    /**
     * Создание справочника
     *
     * @param Handbook $handbook
     * @param array $fields
     * @return bool
     */
    public function createOrEditHandbook(Handbook $handbook, array $fields)
    {
        $handbook->fields = $this->encodeFields($this->deleteEmptyFields($fields));

        return $handbook->save();
    }

    /**
     * Добавление значений справочника
     *
     * @param HandbookData[] $data
     * @return bool
     */
    public function addData($data)
    {
        /** @var HandbookData $dataItem */
        foreach ($data as $data_id => $dataItem) {

            $dataItem->data_id = $data_id + 1;
            $dataItem->fields = $this->encodeFields($dataItem->additionalFields);

            if (!$dataItem->save()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Удаление справочника
     *
     * @param integer $id
     * @return bool
     */
    public function deleteHandbook($id)
    {
        if (!(Handbook::findOneStrictException($id))->delete()) {
            return false;
        }
        HandbookData::deleteAll(['handbook_id' => $id]);

        return true;
    }

    /**
     * Удаляем пустые доп поля, если они есть
     *
     * @param array $fields
     * @return array
     */
    private function deleteEmptyFields(array $fields)
    {
        $fieldsResult = [];

        /** @var HandbookFields $field */
        foreach ($fields as $field) {

            if (!$field->isEmpty) {
                $fieldsResult[] = $field;
            }
        }

        return $fieldsResult;
    }

    /**
     * @param array $fields
     * @return string
     */
    private function encodeFields($fields)
    {
        return json_encode($fields);
    }
}