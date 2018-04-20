<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 20.04.18
 * Time: 12:30
 */

use yii\widgets\ActiveForm;

/**
 * @var \common\components\referenceBook\models\ReferenceBook $model
 * @var \common\components\referenceBook\models\AdditionalField[] $fields
 */

$this->title = $model->isNewRecord ? 'Новый справочник' : 'Обновить справочник';
?>
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a class="add_new_field"><i class="icon-square-plus"></i> поле</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">

                <?php $form = ActiveForm::begin(['id' => 'reference_book_form', 'enableAjaxValidation' => true, 'enableClientValidation' => false]) ?>
                <div class="col-md-12 block_on_top">
                    <h4 style="text-align: center">Информация о справочнике</h4>
                    <div class="col-md-4">
                        <?= $form->field($model, 'systemName')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'description')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'relation')->dropDownList([], ['prompt' => 'Зависим от справочника']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="additional"></div>
