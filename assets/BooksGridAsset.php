<?php
/**
 * Created by PhpStorm.
 * User: cejixo3
 * Date: 10.12.15
 * Time: 0:20
 */

namespace app\assets;

use yii\web\AssetBundle;

class BooksGridAsset extends AssetBundle
{
    public $js = [
        'js/books_grid.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\DatePickerAsset',
        'app\assets\FancyBoxAsset',
    ];
}