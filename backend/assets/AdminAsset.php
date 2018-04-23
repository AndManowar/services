<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminAsset extends AssetBundle
{
    public $baseUrl = '@web/style';

    public $sourcePath = '@webroot/style';

    public $css = [
        'css/bootstrap.css',
        'fonts/icomoon.css',
        'fonts/flag-icon-css/css/flag-icon.min.css',
        'vendors/css/extensions/pace.css',
        'css/bootstrap-extended.css',
        'css/app.css',
        'css/colors.css',
        'css/core/menu/menu-types/vertical-menu.css',
        'css/core/menu/menu-types/vertical-overlay-menu.css',
        'css/core/colors/palette-gradient.css',
        'css/style.css',
    ];
    public $js = [
        'vendors/js/ui/tether.min.js',
        'js/core/libraries/bootstrap.min.js',
        'vendors/js/ui/perfect-scrollbar.jquery.min.js',
        'vendors/js/ui/unison.min.js',
        'vendors/js/ui/blockUI.min.js',
        'vendors/js/ui/jquery.matchHeight-min.js',
        'vendors/js/ui/screenfull.min.js',
        'vendors/js/extensions/pace.min.js',
        'vendors/js/charts/chart.min.js',
        'js/core/app-menu.js',
        'js/core/app.js',
        'js/scripts/pages/dashboard-lite.js',
        'js/main.js',
        'js/scan-js.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
