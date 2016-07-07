<?php 

namespace backend\assets;

use yii\web\AssetBundle;

class ClipboardAsset extends AssetBundle
{
    public $sourcePath = '@bower/';

    public $css = [
    ];
    public $js = [
        'clipboard/dist/clipboard.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}