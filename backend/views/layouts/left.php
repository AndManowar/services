<?php
/** @var string $directoryAsset */

use backend\widgets\Menu;

?>

<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <div class="main-menu-header">

    </div>
    <div class="main-menu-content">
        <?= Menu::widget([
            'options' => ['class' => 'navigation navigation-main'],
            'items'   => [
                ['label' => 'Настройки', 'icon' => 'settings', 'url' => ['/settings']],
                ['label' => 'Справочник', 'icon' => 'book', 'url' => ['/handbook']],
                [
                    'label' => 'RBAC',
                    'icon'  => 'bug_report',
                    'url'   => '#',
                    'items' =>
                        [
                            [
                                'label' => 'Группы/разрешения',
                                'url'   => ['/roles']
                            ],
                            [
                                'label' => 'Сканер роутов',
                                'url'   => ['/scan']
                            ],
                        ],
                ],
            ],
        ]) ?>
    </div>
</div>