<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 20.04.18
 * Time: 15:15
 */

use yii\widgets\ActiveForm;


?>

<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Дополнительное поле</h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a class="remove_field"><i class="icon-square-cross remove_field"></i> удалить</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">


                <input type="text" name="AdditionalFields[data]" required>

<!--                --><?php //$form = ActiveForm::begin(['id' => 'reference_book_form', 'enableAjaxValidation' => true, 'enableClientValidation' => false]) ?>
<!--                <div class="col-md-12 block_on_top">-->
<!--                    <h4 style="text-align: center">Информация о справочнике</h4>-->
<!--                    <div class="col-md-3">-->
<!--                        --><?//= $form->field($model, 'name')->textInput() ?>
<!--                    </div>-->
<!--                    <div class="col-md-3">-->
<!--                        --><?//= $form->field($model, 'description')->textInput() ?>
<!--                    </div>-->
<!--                    <div class="col-md-3">-->
<!--                        --><?//= $form->field($model, 'type')->dropDownList([], ['prompt' => 'Зависим от справочника']) ?>
<!--                    </div>-->
<!--                    <div class="col-md-3">-->
<!--                        --><?//= $form->field($model, 'notNull')->checkbox() ?>
<!--                    </div>-->
<!--                    --><?php //ActiveForm::end() ?>
<!--                </div>-->

            </div>
        </div>
    </div>
</section>
