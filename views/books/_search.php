<?php

/**
 * @var $this yii\web\View
 * @var $model app\models\books\Search
 * @var $form yii\widgets\ActiveForm
 * @var array $authorsAssoc
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="model-search">

    <?php $form = ActiveForm::begin([
        'action' => Url::current(),
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'author_id')
                        ->dropDownList(
                            $authorsAssoc,
                            ['prompt' => Yii::t('app', 'All Authors')]
                        ) ?>
                    <!--<?= $form->field($model, 'author') ?> FULL TEXT SEARCH-->
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label" for="search-author_id"><?=Yii::t('app','Release Date')?></label>
                    <div class="input-group input-daterange">

                        <input type="text" class="form-control"
                               name="Search[release_date_start]"
                               value="<?=date('M d, Y',$model->release_date_start?$model->release_date_start:time())?>">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control"
                               name="Search[release_date_end]"
                               value="<?=date('M d, Y',$model->release_date_end?$model->release_date_end:time())?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group pull-right">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?=Html::a(Yii::t('app','Reset filters and orders'),\app\helpers\url\Books::index(),['class' => 'btn btn-default'])?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
