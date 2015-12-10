<?php
/**
 * Created by PhpStorm.
 * User: cejixo3
 * Date: 11.12.15
 * Time: 0:17
 */

namespace app\assets;


use yii\web\AssetBundle;

class FancyBoxAsset extends AssetBundle
{
    public $sourcePath = '@bower/fancybox';
    public $js = [
        'source/jquery.fancybox.js',
    ];
    public $css = [
        'source/jquery.fancybox.css',
    ];
}