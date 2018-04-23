<?php

use common\components\handbook\models\Handbook;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var Handbook $searchModel
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Справочник';
$this->params['breadcrumbs'][] = $this->title;
?>


<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a href="<?= Url::toRoute(['/handbook']) ?>"><i class="icon-android-refresh"></i></a></li>
                <li><a href="<?= Url::toRoute(['handbook/create']) ?>"><i class="icon-android-add-circle"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <?php Pjax::begin() ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel,
                    'tableOptions' => [
                        'class' => 'table'
                    ],
                    'layout'       => '{items} <div class="box-footer clearfix">{pager}</div>',
                    'pager'        => [
                        'options' => [
                            'class' => 'pagination pagination-sm no-margin pull-right'
                        ],
                    ],
                    'columns'      => [
                        [
                            'class'          => 'yii\grid\SerialColumn',
                            'headerOptions'  => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center']
                        ],
                        'systemName',
                        'description',
                        [
                            'header'  => 'Создано',
                            'content' => function ($model) {
                                return Yii::$app->formatter->asDatetime($model->created_at, 'dd/MM/Y H:i');
                            },
                        ],
                        [
                            'header'  => 'Обновлено',
                            'content' => function ($model) {
                                return Yii::$app->formatter->asDatetime($model->updated_at, 'dd/MM/Y H:i');
                            },
                        ],
                        [
                            'class'          => 'yii\grid\ActionColumn',
                            'header'         => 'Действия',
                            'headerOptions'  => ['class' => 'text-right'],
                            'contentOptions' => ['class' => 'td-actions text-right'],
                            'template'       => '{update} {clone} {delete}',
                            'buttons'        => [
                                'update' => function ($url) {
                                    return Html::a(
                                        '<i class="material-icons">edit</i>',
                                        $url, ['class' => 'btn btn-success']);
                                },
                                'delete' => function ($url) {
                                    return Html::a(
                                        '<i class="material-icons">close</i>',
                                        $url, [
                                        'class'        => 'btn btn-danger',
                                        'title'        => 'Удалить',
                                        'aria-label'   => 'Удалить',
                                        'data-pjax'    => '0',
                                        'data-confirm' => 'Вы уверены, что хотите удалить справочник?',
                                        'data-method'  => 'post'
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</section>
