<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistrationCenter */

$this->title = $model->RegistrationCenterID;
//$this->params['breadcrumbs'][] = ['label' => 'Registration Centers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="app-content content">
    <div class="content-header"></div>
    <div class="content-wrapper">
       <!--  <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?> -->
        <?=Yii::$app->controller->renderPartial('//layouts/alert');?>
        <div class="content-body">
            <section class="flexbox-container">
                    <div class="content-body">
                        <div class="card">
                            <div class="card-header card--header">
                                <h4 class="card-title"><?= $this->title; ?></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline list-actions">
                                        <li><?= Html::a('Update', ['update', 'id' => $model->RegistrationCenterID], ['class' => 'btn btn-primary']) ?></li>
                                        <li><?= Html::a('Delete', ['delete', 'id' => $model->RegistrationCenterID], [
                                                'class' => 'btn btn-danger',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <!-- content -->
                                    <div class="registration-center-view">

                                        <?= DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                                'RegistrationCenterID',
                                                'RegistrationCenterName',
                                                'RegistrationCenterType',
                                                'CountyID',
                                                'ConstituencyID',
                                                'RegistrationCenterEmail:email',
                                                'RegisteredBy',
                                                'RegistrationDate',
                                                'RegistrationUpdateDate',
                                            ],
                                        ]) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>