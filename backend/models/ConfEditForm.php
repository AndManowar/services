<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 16.08.17
 * Time: 11:04
 */

namespace backend\models;
use yii\base\Model;

/**
 * Class ConfEditForm
 *
 * @package backend\models
 */
class ConfEditForm extends Model
{

    /**
     * @var array
     */
    public $fields;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['fields[]', 'required']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return[
            'fields'=>''
        ];
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
        $this->fields = \Yii::$app->config->getValues();
    }
}