<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccounts */

$this->title = 'Update : ' . ' ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'User Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-accounts-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form_password', [
        'model' => $model,
    ]) ?>

</div>