<?php

namespace johnitvn\userplus\basic\controllers;

use Yii;
use yii\filters\AccessControl;
use johnitvn\userplus\base\WebController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ManagerController implements the CRUD actions for UserAccounts model.
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class ProfileController extends WebController {

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        } else if (Yii::$app->user->isGuest) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('user', 'You are not allowed to perform this action.'));
        } else {
            return true;
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * Lists all UserAccounts models.
     * @return mixed
     */
    public function actionIndex() {
        
        return $this->render('index' , ['model' => $this->findModel(Yii::$app->user->identity->id)]);
    }

    /**
     * Displays a single UserAccounts model.
     * @param integer $id
     * @return mixed
     */
    


    /**
     * Updates an existing UserAccounts model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post())) {
            $model->pict = UploadedFile::getInstance($model, 'pict');

            if($model->pict){
                $file_name1 = time().'_'.$model->pict->baseName .'.'.$model->pict->extension;
                $file_name1 = str_replace(' ', '_', $file_name1);
                $model->pict_url = $file_name1;
            }



            if($model->save()){
                
                if($model->pict){
                    $model->pict->saveAs('img/avatar/' .$file_name1 );
                    Image::thumbnail('@webroot/img/avatar/'.$file_name1, 200, 200)->save(Yii::getAlias('@webroot/img/thumb/'.$file_name1), ['quality' => 80]);
                }
    
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionPassword(){


        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'change_password';
        if ($model->load(Yii::$app->request->post())) {

            if(Yii::$app->security->validatePassword($model->old_password, $model->password_hash) == false){
                \Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Old Password Fail'));     
            }else{
                if($model->new_password != $model->retype_password){
                    \Yii::$app->getSession()->setFlash('info', Yii::t('app', 'New Password Missmatch'));  
                }else{
                    $model->password_hash =  Yii::$app->security->generatePasswordHash($model->new_password);
                    $model->save();
                    \Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Password Change Successfully'));  
                }
            }
    
        } 
            return $this->render('update-password', [
                'model' => $model,
            ]);
    
    }

    

    /**
     * Finds the UserAccounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return johnitvn\userplus\base\models\UserAccounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $userClassName = $this->userPlusModule->getModelClassName('UserAccounts');
        if (($model = call_user_func($userClassName . '::findOne', $id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
