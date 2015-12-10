<?php

use yii\helpers\Html;

/**
 * @var $model app\models\books\Model
 * @var $this yii\web\View
 * @var array $authorsAssoc
 * @var $cover app\models\forms\BookCover
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Books',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'cover' => $cover,
        'model' => $model,
        'authorsAssoc' => $authorsAssoc
    ]) ?>

</div>
