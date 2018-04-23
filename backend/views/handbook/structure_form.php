<?php

use common\components\handbook\models\Handbook;
use common\components\handbook\models\HandbookFields;
use common\components\handbook\TypeHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * @var Handbook $handbook
 * @var HandbookFields[] $fields
 */

$this->title = $handbook->isNewRecord ? 'Новый справочник' : 'Обновление структуры справочника';

$action = $handbook->isNewRecord ? ['create'] : ['update-structure', 'id' => $handbook->id];
?>
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">

                <?php $form = ActiveForm::begin([
                    'id'                     => 'dynamic-form',
                    'action'                 => $action,
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]) ?>

                <div class="col-md-12 block_on_top">
                    <h4 style="text-align: center">Информация о справочнике</h4>
                    <div class="col-md-4">
                        <?= $form->field($handbook, 'systemName')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($handbook, 'description')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($handbook, 'relation')->dropDownList(Yii::$app->handbook->getHandbooksList(), ['prompt' => 'Справочник, от которого зависит данный']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= Html::submitButton($handbook->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => 'btn btn-info']) ?>
                        <?php if (!$handbook->isNewRecord) { ?>
                            <a href="<?= Url::toRoute(['handbook/update', 'id' => $handbook->id]) ?>"
                               class="btn btn-danger"> Перейти к данным </a>
                        <?php } ?>
                        <button class="btn btn-warning add_field pull-right"
                                data-state="<?= $handbook->isNewRecord && count($fields) < 2 ? 1 : 2 ?>">Дополнительные
                            поля
                        </button>
                    </div>
                </div>
                <div class="col-md-12 block_on_top <?= $handbook->isNewRecord && count($fields) < 2 ? 'hidden' : '' ?> additional_fields">
                    <h4 style="text-align: center">Добавить поля к справочнику</h4>

                    <div class="panel-body">
                        <?php DynamicFormWidget::begin([
                            'id'              => 'fields_is',
                            'widgetContainer' => 'dynamicform_wrapper',
                            'widgetBody'      => '.container-items',
                            'widgetItem'      => '.item',
                            'limit'           => 999,
                            'min'             => 1,
                            'insertButton'    => '.add-item',
                            'deleteButton'    => '.remove-item',
                            'model'           => $fields[0],
                            'formId'          => 'dynamic-form',
                            'formFields'      => [
                                'name',
                                'description',
                                'type',
                                'notNull',
                            ],
                        ]); ?>

                        <div class="container-items">
                            <?php foreach ($fields as $i => $item): ?>
                                <div class="item panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title pull-left">Добавить поля</h3>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i
                                                        class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                        class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <?= $form->field($item, "[{$i}]name")->textInput() ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?= $form->field($item, "[{$i}]description")->textInput() ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?= $form->field($item, "[{$i}]type")->dropDownList(TypeHelper::getTitleTypes(), ['prompt' => '--Тип поля--']) ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?= $form->field($item, "[{$i}]notNull")->checkbox() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
</section>
