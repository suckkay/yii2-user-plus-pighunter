<?php

namespace suckkay\userplus\basic\controllers;

use suckkay\userplus\simple\controllers\SecurityController as BaseController;

/**
 * Security controller contain all bussiness action for user manager flow.
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class SecurityController extends BaseController {

    protected $registerView = '@userplus/basic/views/security/register';
    
    protected $loginView = '@userplus/basic/views/security/login';

    /**
     * @inheritdoc
     */
    public function actions() {
        $actions = parent::actions();
        $actions['confirm'] = 'suckkay\userplus\basic\actions\ConfirmAction';
        $actions['recovery'] = 'suckkay\userplus\basic\actions\RecoveryPasswordAction';
        $actions['reset'] = 'suckkay\userplus\basic\actions\ResetPasswordAction';
        $actions['resend'] = 'suckkay\userplus\basic\actions\ResendConfirmAction';
        return $actions;
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['access']['only'][] = 'confirm';
        $behaviors['access']['only'][] = 'recovery';
        $behaviors['access']['only'][] = 'reset';
        $behaviors['access']['only'][] = 'resend';
        $behaviors['access']['rules'][] = [
            'actions' => ['confirm', 'recovery', 'reset', 'resend'],
            'allow' => true,
            'roles' => ['?'],
        ];
        return $behaviors;
    }

}
