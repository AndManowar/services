<?php

use common\components\handbook\models\Handbook;
use common\components\handbook\models\HandbookFields;
use common\components\handbook\TypeHelper;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * @var Handbook $handbook
 * @var HandbookFields[] $fields
 * @var array $data
 */

$this->title = 'Данные справочника';

$js = <<<JS
  $(".dynamicform_wrapper").on('afterInsert',function () {
  var hb_id = $('.hb_id');
        hb_id.find('input:hidden').val(hb_id.data('id'));
    });
JS;

$this->registerJs($js);
?>
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">

                <?php $form = ActiveForm::begin([
                    'id'                     => 'dynamic-form1',
                    'action'                 => ['update', 'id' => $handbook->id],
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]) ?>
                <?= Html::submitButton('Сохранить записи', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Изменить структуру справочника', Url::toRoute(['handbook/update-structure', 'id' => $handbook->id]), ['class' => 'btn btn-warning']) ?>
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody'      => '.container-items',
                        'widgetItem'      => '.item',
                        'limit'           => 5000,
                        'min'             => 1,
                        'insertButton'    => '.add-item',
                        'deleteButton'    => '.remove-item',
                        'model'           => $data[0],
                        'formId'          => 'dynamic-form1',
                        'formFields'      => [
                            'handbook_id',
                            'value',
                            'title',
                            'relation',
                            'additionalFields',
                        ],
                    ]); ?>
                    <div class="container-items">
                        <?php foreach ($data

                        as $i => $item): ?>
                        <div class="item panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Добавить значения справочника</h3>
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
                                    <div class="hb_id" data-id="<?= $handbook->id ?>">
                                        <?= $form->field($item, "[{$i}]handbook_id")->hiddenInput(['value' => $handbook->id])->label(false) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($item, "[{$i}]value")->textInput() ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($item, "[{$i}]title")->textInput() ?>
                                    </div>
                                    <?php if ($handbook->relation) { ?>
                                        <div class="col-sm-12">
                                            <?=
                                            $form->field($item, "[{$i}]relation")->widget(Select2::class, [
                                                'data'          => Yii::$app->handbook->getDataForRelation($handbook->relation),
                                                'language'      => 'ru',
                                                'options'       => ['placeholder' => 'Значение, от которого зависит данное'],
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                ],
                                            ]);
                                            ?>
                                        </div>
                                    <?php }
                                    if (!empty($fields)) { ?>
                                        <div class="col-md-12 well">
                                            <h4 style="text-align: center">Дополнительные поля</h4>
                                            <?php
                                            $countFields = round(12 / (count($fields)));
                                            foreach ($fields as $field):
                                                $fieldType = TypeHelper::getTypes($field->type);
                                                $fieldType = $fieldType[3];
                                                $key = $field['name'];
                                                ?>
                                                <div class="col-sm-<?= $countFields ?>">
                                                    <?= $form->field($item, "[{$i}]additionalFields[$key]")->$fieldType()->label($field->description) ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php endforeach;
                            DynamicFormWidget::end();
                            ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


