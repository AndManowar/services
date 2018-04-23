<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.07.2016
 * Time: 9:43
 */

namespace common\components\handbook;

use yii\base\InvalidArgumentException;
use yii\base\UnknownPropertyException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use yii\validators\StringValidator;
use yii\validators\BooleanValidator;
use yii\validators\NumberValidator;

class TypeHelper
{

    /**
     * @var
     */
    public static $errors;

    /**
     * @var array
     */
    private static $types = [
        1 => [
            'StringValidator',                      // Класс Валидатора
            ['max' => 30],                          // Параметры класа Валидатора
            'Текстовое поле (макс. 30 знаков)',     // Описание
            'textInput',                            // Элемент формы (Класс Виджета)
            ['string', 'max' => 30],
        ],
        2 => [
            'StringValidator',
            ['max' => 250],
            'Большое текст. поле (макс. 250 знаков)',
            'textInput',
            ['string', 'max' => 250],
        ],
        3 => [
            'BooleanValidator',
            [],
            'Чекбокс (Да / Нет)',
            'checkbox',
            ['boolean'],
        ],
        4 => [
            'NumberValidator',
            ['integerOnly' => true],
            'Целое число',
            'textInput',
            ['integer'],
        ],
        5 => [
            'NumberValidator',
            [],
            'Число',
            'textInput',
            ['integer'],
        ],
    ];

    /**
     * @param null $id
     * @return array
     *
     * Список Наименований / Наименование типов
     */
    public static function getTitleTypes($id = null)
    {
        if (isset(self::$types[$id])) {
            return self::$types[$id][2];
        } else {
            return ArrayHelper::getColumn(self::$types, function ($array) {
                return $array[2];
            });
        }
    }

    /**
     * @param null $id
     * @return array
     *
     * Список описаний типов / описание типа
     */
    public static function getTypes($id = null)
    {
        if (isset(self::$types[$id])) {
            return self::$types[$id];
        } else {
            return self::$types;
        }
    }

    /**
     * @param $id
     * @param $name
     * @param string $value
     * @param array $options
     * @return mixed
     * @throws UnknownPropertyException
     *
     * Элемент формы
     */
    public static function getInput($id, $name, $value = '', $options = [])
    {
        if (isset(self::$types[$id])) {
            $inputName = self::$types[$id][3];

            return Html::$inputName($name, $value, $options);
        } else {
            throw new UnknownPropertyException;
        }
    }

    /**
     * @param $id
     * @param $fieldName
     * @return array
     * @throws UnknownPropertyException
     */
    public static function getRules($id, $fieldName)
    {
        if (isset(self::$types[$id])) {
            return [$fieldName] + self::$types[$id][4];
        } else {
            throw new UnknownPropertyException;
        }
    }

    /**
     * @param $id
     * @param $value
     * @return bool
     * @throws UnknownPropertyException
     *
     * Валидация переданого значения
     * Ошибка записываеться в свойство Хелпера
     */
    public static function validation($id, $value)
    {
        if (!isset(self::$types[$id])) {
            throw new UnknownPropertyException;
        }

        self::$errors = null;
        /** @var NumberValidator|BooleanValidator|StringValidator $validator */
        $validator = self::createValidator(self::$types[$id][0], self::$types[$id][1]);

        if ($validator->validate($value, self::$errors)) {
            return true;
        }

        return false;

    }


    /**
     * @param integer $fieldType
     * @param $params
     * @return BooleanValidator|NumberValidator|StringValidator
     */
    private static function createValidator($fieldType, $params)
    {
        switch ($fieldType) {
            case 'NumberValidator':
                return new NumberValidator($params);
                break;
            case 'BooleanValidator':
                return new BooleanValidator($params);
                break;
            case 'StringValidator':
                return new StringValidator($params);
                break;
        }

        throw new InvalidArgumentException();
    }
}