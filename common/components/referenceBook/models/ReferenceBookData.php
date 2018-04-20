<?php

namespace common\components\referenceBook\models;

use common\models\AppActiveRecord;


/**
 * This is the model class for table "reference_book_data".
 *
 * @property int $id
 * @property int $reference_book_id
 * @property int $data_id
 * @property string $value
 * @property int $related_data
 * @property string $fields
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ReferenceBook $referenceBook
 */
class ReferenceBookData extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reference_book_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reference_book_id', 'data_id', 'value', 'title'], 'required'],
            [['reference_book_id', 'data_id', 'related_data', 'created_at', 'updated_at'], 'integer'],
            [['value', 'fields', 'title'], 'string', 'max' => 255],
            [['reference_book_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReferenceBook::class, 'targetAttribute' => ['reference_book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reference_book_id' => 'Reference Book ID',
            'data_id' => 'Data ID',
            'value' => 'Value',
            'related_data' => 'Related Data',
            'fields' => 'Fields',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferenceBook()
    {
        return $this->hasOne(ReferenceBook::class, ['id' => 'reference_book_id']);
    }
}
