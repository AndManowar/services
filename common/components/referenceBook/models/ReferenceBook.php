<?php

namespace common\components\referenceBook\models;

use common\models\AppActiveRecord;


/**
 * This is the model class for table "reference_book".
 *
 * @property int $id
 * @property string $systemName
 * @property string $description
 * @property string $fields
 * @property int $relation
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ReferenceBookData[] $referenceBookData
 */
class ReferenceBook extends AppActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reference_book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['systemName', 'description'], 'required'],
            [['relation', 'created_at', 'updated_at'], 'integer'],
            [['systemName', 'description', 'fields'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'systemName' => 'Название',
            'description' => 'Описание',
            'fields' => 'Fields',
            'relation' => 'Relation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferenceBookData()
    {
        return $this->hasMany(ReferenceBookData::class, ['reference_book_id' => 'id']);
    }
}
