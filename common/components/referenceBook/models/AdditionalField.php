<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 20.04.18
 * Time: 12:40
 */

namespace common\components\referenceBook\models;

use yii\base\Model;

class AdditionalField extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var integer
     */
    public $type;

    /**
     * @var boolean
     */
    public $notNull;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'description', 'type'], 'required'],
            [['name', 'description'], 'string'],
            ['type', 'integer'],
            ['notNull', 'boolean']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name'        => 'Название',
            'description' => 'Описание',
            'type'        => 'Тип поля',
            'notNull'     => 'Обязательное'
        ];
    }
}