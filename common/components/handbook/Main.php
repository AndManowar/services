<?php

namespace common\components\handbook;

use common\components\handbook\models\Handbook;
use common\components\handbook\models\HandbookData;
use yii\helpers\ArrayHelper;

class Main
{

    const CACHE_NAME = 'handbook_data_cache_name';
    const CACHE_DURATION = 43200;

    /**
     * @param string $name
     * @return array|null|\yii\db\ActiveRecord
     */
    public function __get($name)
    {
        return $this->getHandbook($name);
    }

    /**
     * Возвращаем все записи справочника
     *
     * @param $name
     * @return array|null|\yii\db\ActiveRecord
     */
    private function getHandbook($name)
    {
        return Handbook::find()->where(['systemName' => $name])->one();
    }

    /**
     * Запись справочника
     *
     * @param $name
     * @param $data_id
     *
     * @return array|null|HandbookData
     */
    public function getHandbookDataItem($name, $data_id)
    {
        /** @var Handbook $handbook */
        $handbook = $this->getHandbook($name);

        return HandbookData::find()->where(['handbook_id' => $handbook->id, 'data_id' => $data_id])->one();
    }

    /**
     * Значения сравочников для дропдауна
     * @param $name
     * @return array
     */
    public function getHandbooksListByName($name)
    {
        /** @var Handbook $handbook */
        $handbook = Handbook::find()->where(['systemName' => $name])->one();
        if ($handbook) {
            return ArrayHelper::map($handbook->handbookData, 'data_id', 'title');
        }

        return [
            1 => 'Отсутствует',
        ];
    }

    /**
     * Список справочников для дропдауна
     * @return array
     */
    public function getHandbooksList()
    {
        return ArrayHelper::map(Handbook::find()->all(), 'id', 'description');
    }

    /**
     * Получаем записи из справочника по запросу
     * @param $query
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getDataByQuery($query)
    {
        return HandbookData::find()->where($query)->all();
    }

    /**
     * Данные справочник для выбора значения, от которого будет зависеть данное
     *
     * @param integer $related_handbook_id
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function getDataForRelation($related_handbook_id)
    {
        return ArrayHelper::map(
            (Handbook::findOneStrictException($related_handbook_id))->getData(),
            'data_id',
            'title'
        );
    }

    /**
     * Записи зависимого справочника
     *
     * @param integer $relation
     * @param array $id
     * @return array
     */
    public function getRelatedData($relation, array $id)
    {
        if (!$relation || !$id) {
            return [];
        }
        $data = [];
        $result = [];

        foreach ($id as $item) {
            $data[] = ArrayHelper::map(HandbookData::find()->where(['handbook_id' => $relation])->andWhere(['like', 'relation', $item])->all(), 'data_id', 'title');
        }

        foreach ($data as $item) {
            foreach ($item as $id => $value) {
                $result[$id] = $value;
            }
        }

        return $result;
    }

}