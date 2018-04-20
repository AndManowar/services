<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

?>
<div class="col-md-12 block_on_top">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']) ?>
    <?= Html::submitButton(($isCreate) ? 'Добавить' : 'Изменить', ['class' => 'btn btn-info']) ?>
    <?php if ($isCreate) { ?>
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 4, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $permissions[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'w_size',
                'h_size',
            ],
        ]); ?>
        <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($permissions as $i => $item): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Особенности</h3>
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
                            <div class="col-md-8 col-md-offset-2">
                                <?= $form->field($item, "[{$i}]systemName")->textInput() ?>
                            </div>

                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            <?php DynamicFormWidget::end(); ?>
        </div>
        <?php } else { ?>
            <?= $form->field($permissions, 'systemName')->textInput() ?>

        <?php } ?>



        <?php ActiveForm::end() ?>
    </div>