<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * @var bool $isCreate
 * @var array $rbacs
 * @var \common\components\rbac\models\RoleEditForm $rbacs
 */
?>
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">

                <?php $form = ActiveForm::begin(['id' => 'dynamic-form']) ?>

                <?= Html::submitButton(($isCreate) ? 'Добавить' : 'Изменить', ['class' => 'btn btn-info']) ?>
                <?php if ($isCreate) { ?>
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody'      => '.container-items',
                        'widgetItem'      => '.item',
                        'limit'           => 20,
                        'min'             => 1,
                        'insertButton'    => '.add-item',
                        'deleteButton'    => '.remove-item',
                        'model'           => $rbacs[0],
                        'formId'          => 'dynamic-form',
                        'formFields'      => [
                            'w_size',
                            'h_size',
                        ],
                    ]); ?>
                    <div class="container-items">
                        <?php foreach ($rbacs as $i => $item): ?>
                            <div class="item panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Роль</h3>
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
                                        <div class="col-sm-6">
                                            <?= $form->field($item, "[{$i}]name")->textInput() ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($item, "[{$i}]description")->textInput() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                    <?php } else { ?>
                        <?= $form->field($rbacs, 'name')->textInput(['readonly' => 'readonly']) ?>

                        <?= $form->field($rbacs, 'description')->textInput() ?>
                    <?php } ?>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</section>
