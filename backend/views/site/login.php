<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $form yii\bootstrap\ActiveForm
 * @var $this yii\web\View
 * @var \common\models\forms\LoginForm $model
 */


$this->title = 'Авторизация';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@webroot/style');

?>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <div class="p-1"><img src="<?= $directoryAsset ?>/images/logo/robust-logo-dark.png"
                                                      alt="branding logo"></div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login</span>
                            </h6>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal form-simple']]) ?>

                                <?= $form->field($model, 'username')
                                    ->textInput([
                                        'placeholder' => 'Username',
                                        'class'       => 'form-control form-control-lg input-lg'
                                    ])->label(false) ?>
                                <?= $form->field($model, 'password')
                                    ->textInput([
                                        'placeholder' => 'Password',
                                        'class'       => 'form-control form-control-lg input-lg'
                                    ])->label(false) ?>

                                <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                    <fieldset>
                                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                    </fieldset>
                                </div>

                                <?= Html::submitButton('<i class="icon-unlock2"></i> Login', ['class' => 'btn btn-primary btn-lg btn-block']) ?>

                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="">
                                <p class="float-sm-left text-xs-center m-0"><a href="recover-password.html"
                                                                               class="card-link">Восстановить пароль</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>