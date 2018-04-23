<?php
/** @var string $content */

use backend\widgets\Alert;
?>

<?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>

<div class="app-content content container-fluid">
    <div class="container-fluid"><br><?= Alert::widget() ?></div>
    <div class="content-wrapper">
        <?= $content ?>
    </div>
</div>
