<?php

use common\components\settings\helpers\FormFieldsHelper;
use common\components\settings\models\Settings;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var Settings $model
 */

$this->params['breadcrumbs'][] = ['label' => 'Настройки ', 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$js = <<<JS
var body = $('body');
 body.on('change','.fieldType_drp select', function (e) {
        e.preventDefault();
        $.ajax({
            'method':"POST",
            'url': '/dashboard/settings/get-field',
            'data':{
                type: $(this).val()
            },
            'beforeSend': function() {
                $(".field-settings-value").remove();
           },
            'success' : function (data) {
              jQuery('#settings-form > .field-settings-fieldtype').after( data );
            }
        });
    });

JS;
$this->registerJs($js, $this::POS_END);
?>
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">

                <?php $form = ActiveForm::begin(['id' => 'settings-form', 'enableAjaxValidation' => true]) ?>
                <?= $form->field($model, 'systemName', ['options' => ['class' => 'form-group label-floating']])->textInput() ?>
                <?= $form->field($model, 'description', ['options' => ['class' => 'form-group label-floating']])->textInput() ?>
                <?= $form->field($model, 'fieldType', ['options' => ['class' => 'form-group label-floating fieldType_drp']])->dropDownList(FormFieldsHelper::getFileList(), ['prompt' => '']) ?>
                <?php if (!$model->isNewRecord) {
                    echo FormFieldsHelper::getFormField($form, $model, 'value', $model->fieldType);
                } else {
                    echo $form->field($model, 'value', ['template' => '{input}'])->hiddenInput();
                }?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-fill btn-success']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>