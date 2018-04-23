<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * @var bool $isCreate
 * @var \common\components\rbac\models\GroupPermissionForm $permissions
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
                        'model'           => $permissions[0],
                        'formId'          => 'dynamic-form',
                        'formFields'      => [
                            'systemName',
                        ],
                    ]); ?>
                    <div class="container-items">
                        <?php foreach ($permissions as $i => $item): ?>
                            <div class="item panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Группа разрешений</h3>
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

                                    </div>
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
            </div>
        </div>
    </div>
</section>
