<?php
/** @var string $directoryAsset */

use backend\widgets\Menu;
?>

<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <div class="main-menu-header">
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
    </div>
    <div class="main-menu-content">
        <?= Menu::widget([
            'options' => ['class' => 'navigation navigation-main'],
            'items'   => [
                ['label' => 'Настройки магазина', 'icon' => 'settings', 'url' => ['/settings']],
                ['label' => 'Справочник', 'icon' => 'book', 'url' => ['/reference-book']],
                ['label' => 'RBAC', 'icon' => 'bug_report', 'url' => ['/roles']],
                ['label' => 'Сканер роутов', 'icon' => 'fingerprint', 'url' => ['/scan']],
            ],
        ]) ?>
    </div>
</div>