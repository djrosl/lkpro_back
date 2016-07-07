<?php 

namespace backend\assets;

use yii\web\AssetBundle;

class AdminltePluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/';

    public $css = [
        'tablesorter/themes/blue/style.css',
    ];
    public $js = [
        'Chart.js/dist/Chart.js',
        'jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js',
        'tablesorter/jquery.tablesorter.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dmstr\web\AdminLteAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}