<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 27.07.17
 * Time: 9:27
 */

namespace common\components\handbook\models;


use common\components\handbook\TypeHelper;
use common\models\AppActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * @property integer $id
 * @property integer $handbook_id
 * @property string $title
 * @property string $value
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $fields
 * @property integer $data_id
 * @property integer $relation
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property ActiveQuery $handbook
 * @property array $customFields
 */
class HandbookData extends AppActiveRecord
{
    /**
     * @var array
     */
    public $additionalFields;

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%handbook_data}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['handbook_id', 'value', 'title', 'data_id'], 'required'],
            [['handbook_id', 'created_at', 'updated_at', 'data_id', 'created_by', 'updated_by'], 'integer'],
            [['created_by', 'updated_by'], 'default', 'value' => 1],
            [['value', 'title'], 'string'],
            ['additionalFields', function () {

                $fields = $this->getHandbookFieldsForValidation();

                foreach ($this->additionalFields as $name => $additionalField) {
                    if (isset($fields['required']) && !$additionalField && in_array($name, $fields['required'])) {
                        $this->addError("additionalFields[{$name}]", "Поле {$name} обязательно к заполнению");
                    }

                    if (!TypeHelper::validation($fields[$name], $additionalField)) {
                        $this->addError("additionalFields[{$name}]", TypeHelper::$errors);
                    }
                }
            }],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'handbook_id'      => 'ід справочника',
            'value'            => 'Значение',
            'title'            => 'Заголовок(для пользователя)',
            'relation'         => 'Значение от которого зависит данное (только вып. список)',
            'created_at'       => 'Создано в',
            'updated_at'       => 'Обновлено в',
            'additionalFields' => '',
        ];
    }

    /**
     * Получить значение
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Получить заголовок
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCustomFields()
    {
        return (array)json_decode($this->fields);
    }

    /**
     * @return ActiveQuery
     */
    public function getHandbook()
    {
        return $this->hasOne(Handbook::class, ['id' => 'handbook_id']);
    }

    /**
     * Получение необходимых к заполнению полей справочника для валидации
     * @return array
     */
    private function getHandbookFieldsForValidation()
    {
        $fields = [];

        /** @var HandbookFields $field */
        foreach (Handbook::findOneStrictException($this->handbook_id)->getFields() as $field) {
            if ($field->notNull) {
                $fields['required'][] = $field->name;
            }
            $fields[$field->name] = $field->type;
        }

        return $fields;
    }
}