<?php
/**
 * Created by PhpStorm.
 * User: cejixo3
 * Date: 10.12.15
 * Time: 20:13
 */

namespace app\assets;

use yii\web\AssetBundle;

class DatePickerAsset extends  AssetBundle
{
    public $sourcePath = '@bower/bootstrap-datepicker';
    public $js = [
        'dist/js/bootstrap-datepicker.min.js',
    ];
    public $css = [
        'dist/css/bootstrap-datepicker.min.css',
    ];

}