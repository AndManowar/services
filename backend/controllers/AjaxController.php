<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 20.04.18
 * Time: 16:05
 */

namespace backend\controllers;

use common\components\referenceBook\models\AdditionalField;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class AjaxController
 * @package backend\controllers
 */
class AjaxController extends Controller
{

    /**
     * @param $action
     * @return bool
     * @throws NotFoundHttpException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        return parent::beforeAction($action);
    }
}