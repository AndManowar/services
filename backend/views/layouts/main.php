<?php

use backend\assets\AdminAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);

// Asset directory
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@webroot/style');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns"
      class="vertical-layout vertical-menu 2-columns  fixed-navbar">
<?php $this->beginBody() ?>
<?= $this->render('left.php') ?>
<?= $this->render('content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
