<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 20.04.18
 * Time: 12:05
 */

namespace backend\controllers;

use common\components\AjaxValidationTrait;
use common\components\rbac\baseController;
use common\components\referenceBook\models\AdditionalField;
use common\components\referenceBook\models\ReferenceBook;
use common\components\referenceBook\models\ReferenceBookSearch;
use common\components\referenceBook\services\ReferenceBookService;
use Yii;
use yii\base\Module;

class ReferenceBookController extends baseController
{

    use AjaxValidationTrait;

    /**
     * @var ReferenceBookService
     */
    private $referenceBookService;

    /**
     * ReferenceBookController constructor.
     * @param $id
     * @param Module $module
     * @param ReferenceBookService $referenceBookService
     * @param array $config
     */
    public function __construct($id, Module $module, ReferenceBookService $referenceBookService, array $config = [])
    {
        $this->referenceBookService = $referenceBookService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ReferenceBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Создание справочника
     *
     * @return array|null|string
     */
    public function actionCreate()
    {
        $model = new ReferenceBook();

        if ($model->load(Yii::$app->request->post())) {

            if (($errors = $this->modelAjaxValidation($model)) !== null) {
                return $errors;
            }
        }

        return $this->render('_form', ['model' => $model]);
    }


}