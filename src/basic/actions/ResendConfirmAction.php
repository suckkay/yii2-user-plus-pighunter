<?php

namespace suckkay\userplus\basic\actions;

use Yii;
use suckkay\userplus\base\Action;
use suckkay\userplus\base\traits\AjaxValidationTrait;

/**
 * Recovery action handler user reset password request
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class ResendConfirmAction extends Action {

    use AjaxValidationTrait;

    /**
     * @var string the view file to be rendered. If not set, it will take the value of [[id]].
     * That means, if you name the action as "error" in "SiteController", then the view name
     * would be "error", and the corresponding view file would be "views/site/error.php".
     */
    public $view;

    /**
     * Runs the reset password action
     *
     * @return string result content
     */
    public function run() {
        $model = $this->userPlusModule->createModelInstance('ResendForm');

        $this->performAjaxValidation($model);
        $view = $this->view == null ? $this->id : $this->view;
        $model->load(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->resendConfirmation()) {
            return $this->controller->render($view, [
                        'alert' => true,
                        'model' => $model,
            ]);
        } else {
            return $this->controller->render($view, [
                        'alert' => false,
                        'model' => $model,
            ]);
        }
    }

}
