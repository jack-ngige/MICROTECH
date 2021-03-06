<?php

namespace app\controllers;

use Yii;
use app\models\BirthDetails;
use app\models\NumberSeries;
use app\models\RegistrationCenter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BirthDetailsController implements the CRUD actions for BirthDetails model.
 */
class BirthDetailsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'signup''request-password-reset', 'reset-password', 'verify-email',],
                'rules' => [
                    [
                        'actions' => ['signup', 'error', 'login',],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'error','index','create', 'view','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BirthDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('view-birth-index')) {
            # code...
            $center = RegistrationCenter::findOne(['RegistrationCenterID'=>Yii::$app->user->identity->RegistrationCenterID]);
            if (!empty($center) && $center->RegistrationCenterType == 'Office of Registrar of Births and Deaths') {
                # code...
                $dataProvider = new ActiveDataProvider([
                        'query' => BirthDetails::find(),
                    ]);

                    return $this->render('index', [
                        'dataProvider' => $dataProvider,
                ]);
            }elseif (!empty($center) && ($center->RegistrationCenterType == 'Hospital' or $center->RegistrationCenterType == 'Police Station' or $center->RegistrationCenterType == 'Dispensary')) {
                # code...
                $dataProvider = new ActiveDataProvider([
                        'query' => BirthDetails::find()->where(['RegistrationCenterID'=>Yii::$app->user->identity->RegistrationCenterID]),
                    ]);

                    return $this->render('index', [
                        'dataProvider' => $dataProvider,
                ]);
            }else{
                //error message to be displayed
                Yii::$app->session->setFlash('message', "Kindly register your center before proceeding");
                return $this->redirect(Yii::$app->request->referrer);
            }

        }else{
            throw new ForbiddenHttpException('Action is not Allowed');
        }
        
    }

    /**
     * Displays a single BirthDetails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('view-birth')) {
            # code...
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new ForbiddenHttpException('Action is not Allowed');
        }
        
    }

    /**
     * Creates a new BirthDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('create-birth')) {
            # code...
            $model = new BirthDetails();
            if ($model->load(Yii::$app->request->post())) {
                // code...
                $model->CreatedBy = Yii::$app->user->identity->id;
                $model->CreatedDate = date('Y-m-d');
                $record_year = date('Y',strtotime($model->CreatedDate));
                $center = Yii::$app->user->identity->RegistrationCenterID;
                if (!empty($center)) {
                    # code...
                    $r_center = RegistrationCenter::findOne($center);
                    $model->CountyID = $r_center->CountyID;
                    $model->ConstituencyID = $r_center->ConstituencyID;
                    $model->RegistrationCenterID = $r_center->RegistrationCenterID;
                }else{
                    //error message to be displayed
                    Yii::$app->session->setFlash('message', "Kindly register your center before proceeding");
                    return $this->redirect(Yii::$app->request->referrer);
                }
                if (empty($model->BirthCertNo)) {
                    // code...
                    //generating number for Death Certificate Number
                $number = NumberSeries::GenerateNumbers($module='BirthRegistration',$year=$record_year);
                }
                if (empty($number) && empty($model->BirthCertNo)) {
                    // code...
                    //redirecting to information form
                    return $this->redirect(Yii::$app->request->referrer);
                }else{
                    //generating reference number if it was Empty
                    if (empty($model->BirthCertNo)) {
                        // code...
                        //generating number for Reference
                        $model->BirthCertNo = "BC/".$number."".date('/m/Y');
                    }
                    if ($model->save()) {
                        # code...
                        return $this->redirect(['view', 'id' => $model->PersonID]);
                    }else{
                        var_dump($model->getErrors()).exit();
                    }
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Action is not Allowed');
        }
        
    }

    /**
     * Updates an existing BirthDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('update-birth')) {
            # code...
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                // code...
                $model->UpdatedBy = Yii::$app->user->identity->id;
                $model->UpdatedDate = date('Y-m-d');
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->PersonID]);
                }
            }


            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Action is not Allowed');
        }
    }

    /**
     * Deletes an existing BirthDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('delete-birth')) {
            # code...
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException('Action is not Allowed');
        }
        
    }

    /**
     * Finds the BirthDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BirthDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BirthDetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
