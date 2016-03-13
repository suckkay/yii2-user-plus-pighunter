<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\School */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <label><?= Yii::t('app' , 'Gender'); ?></label>
    <?=  SwitchInput::widget([
        'model'=>$model,
        'attribute'=>'gender',
        'pluginOptions' => [
            'size' => 'medium',
            'onColor' => 'success',
            'offColor' => 'success',
            'onText' =>  Yii::t('app', 'Male'),
            'offText' => Yii::t('app', 'Female'),
        ]
    ]);?>

    <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>

    <label><?= Yii::t('app' , 'Birth Date'); ?></label>

    <?= DatePicker::widget([
        'attribute' => 'birth_date', 
        'model' => $model, 
        'options' => ['placeholder' => 'Select date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose'=>true,
            'todayHighlight' => false
        ]
    ]);
    ?>

    

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pict')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>