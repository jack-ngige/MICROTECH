<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BirthDetails */

$this->title = 'Create Birth Details';
$this->params['breadcrumbs'][] = ['label' => 'Birth Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="birth-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>