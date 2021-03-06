<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Counties';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="app-content content">
    <div class="content-header"></div>
    <div class="content-wrapper"><!-- 
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?> -->
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
                                        <li></li>
                                        <li><?= Html::a('Create County', ['create'], ['class' => 'btn btn-success']) ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <!-- content -->
                                    <div class="county-index">


                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                //'CountyID',
                                                'CountyName',
                                                'CountyDescription',
                                                'CreatedDate',
                                                'CreatedBy',
                                                //'UpdatedDate',
                                                //'UpdatedBy',

                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]); ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>