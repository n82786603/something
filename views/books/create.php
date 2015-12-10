<?php

use yii\helpers\Html;

/**
 * @var $model app\models\books\Model
 * @var $this yii\web\View
 * @var array $authorsAssoc
 * @var $cover app\models\forms\BookCover
 */

$this->title = Yii::t('app', 'Create Books');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'cover' => $cover,
        'model' => $model,
        'authorsAssoc' => $authorsAssoc
    ]) ?>

</div>
