<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */

$this->title = 'Update Auth Assignment: ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="app-content content">
	<div class="content-header"></div>
	<div class="content-wrapper">
		<!-- <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?> -->
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
										<li></li>
									</ul>
								</div>
							</div>
							<div class="card-content collapse show">
								<div class="card-body card-dashboard">
									<!-- content -->
									<div class="auth-assignment-update">
										<?= $this->render('_form', [
									        'model' => $model,
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