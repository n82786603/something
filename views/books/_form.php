<?php

use app\assets\BooksEditAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $model app\models\books\Model
 * @var $cover app\models\forms\BookCover
 * @var $this yii\web\View
 * @var array $authorsAssoc
 * $form yii\widgets\ActiveForm
 */
$this->registerAssetBundle(BooksEditAsset::className(), View::POS_HEAD);
?>

<div class="model-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'author_id')
                ->dropDownList($authorsAssoc) ?>
            <?= $form->field($model, 'name')
                ->textarea(['rows' => 4]) ?>
        </div>
        <div class="col-md-8">
            <div class="col-md-8">
                <?php
                $pluginOptions = $model->isNewRecord ?
                    [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-picture"></i> ',
                        'browseLabel' => Yii::t('app', 'Add Cover')
                    ] :
                    array_merge([
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-picture"></i> ',
                        'browseLabel' => Yii::t('app', 'Add Cover')
                    ], [
                        'initialPreview' => [
                            Html::img($model->getCoverWebPath(), [
                                    'class' => 'file-preview-image',
                                    'alt' => $model->preview_path,
                                    'title' => $model->preview_path]
                            )
                        ],
                        'initialCaption' => $model->preview_path,
                    ]);

                ?>
                <?= $form->field($cover, 'cover')
                    ->widget(\kartik\file\FileInput::className(), [
                        'pluginOptions' => $pluginOptions,
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => false
                        ]
                    ]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::label($model->getAttributeLabel('release_date')) ?>
                <?= Html::tag('div', null, [
                    'data-type' => 'release_date_ui',
                    'data-date-ui' => date(
                        'Y-m-d',
                        ($model->isNewRecord ?
                            time() :
                            $model->release_date)
                    )
                ]) ?>
                <?= Html::tag('input', null, [
                    'data-type' => 'release_date',
                    'type' => 'hidden',
                    'name' => 'Model[release_date]',
                    'value' => ($model->isNewRecord?
                        time():
                        ($model->release_date?$model->release_date:strtotime($model->release_date))
                    ),
                    'data-date-ui' => date(
                        'Y-m-d',
                        ($model->isNewRecord ?
                            time() :
                            $model->release_date)
                    )
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('app', 'Create') :
            Yii::t('app', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
