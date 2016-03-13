<?php 

use yii\i18n\Formatter;

?>
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">My Profile</div>
 <table class="table">
 	<tr>
 		<td>Name</td><td>:</td><td><?= Yii::$app->user->identity->fullname; ?></td>
 	</tr> 
 	<tr>
 		<td>Email</td><td>:</td><td><?= $model->login; ?></td>
 	</tr> 
 	<tr>
 		<td>Birth Place</td><td>:</td><td><?= $model->birth_place; ?> </td>
 	</tr> 
 	<tr>
 		<td>Birth Date</td><td>:</td><td><?= Yii::$app->formatter->asDate($model->birth_date); ?></td>
 	</tr> 
 	<tr>
 		<td>Gender</td><td>:</td><td><?= ($model->gender == 1 ) ? Yii::t('app' , 'Male') : Yii::t('app', 'Female'); ?></td>
 	</tr> 
 	<tr>
 		<td>Address</td><td>:</td><td><?= $model->address; ?></td>
 	</tr> 
 	<tr>
 		<td>Phone</td><td>:</td><td><?= $model->mobile_phone; ?></td>
 	</tr>  
 </table>

</div>