<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 11.08.17
 * Time: 11:36
 */

namespace common\components\rbac\models;


use yii\base\Model;

class GroupPermissionForm extends Model
{

    public $systemName;

    public function rules()
    {
        return [
            ['systemName', 'required'],
            ['systemName', 'string', 'min' => 5, 'max' => 40]
        ];

    }

    public function attributeLabels()
    {
        return [
            'systemName' => 'Описание'
        ];
    }


}