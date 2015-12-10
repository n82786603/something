<?php

/**
 * @var array $authorsAssoc
 * @var View $this
 * @var Search $searchModel
 * @var ActiveDataProvider $dataProvider
 */

use app\assets\BooksGridAsset;
use app\models\books\Search;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

$this->registerAssetBundle(BooksGridAsset::className(), View::POS_HEAD);
$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel, 'authorsAssoc' => $authorsAssoc]); ?>
    <?php echo $this->render('_modal', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name:ntext',
            [
                'attribute' => 'author',
                'value' => 'authorModel.fullName'
            ],
            [
                'attribute' => 'preview_path',
                'format' => 'raw',
                'value' => function (\app\models\books\Model $model) {
                    return Html::tag(
                        'div',
                        Html::a(
                            Html::img(
                                $model->getCoverWebPath(),
                                [
                                    'class' => 'img-responsive',
                                ]
                            ),
                            $model->getCoverWebPath(),
                            [
                                'target' => '_blank',
                                'data-type' => 'grid-image-preview'
                            ]
                        ),
                        [
                            'class' => 'img-grid-wrapper'
                        ]
                    );

                }
            ],
            'release_date:date',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            Html::tag(
                                'span',
                                null,
                                [
                                    'class' => 'glyphicon glyphicon-eye-open'
                                ]
                            ),
                            $url,
                            [
                                'data-toggle' => 'book-preview'
                            ]
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            Html::tag(
                                'span',
                                null,
                                [
                                    'class' => 'glyphicon glyphicon-pencil'
                                ]
                            ),
                            $url,
                            [
                                'target' => '_blank'
                            ]
                        );
                    },
                ]
            ],
        ],
    ]); ?>
</div>
