<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 02.03.18
 * Time: 10:00
 */

namespace backend\controllers;

use common\components\rbac\baseController;
use common\helpers\StatisticHelper;

/**
 * Class MainpageController
 *
 * @package backend\controllers
 */
class MainpageController extends baseController
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index', ['statistic' => StatisticHelper::getMainStatistic()]);
    }

}