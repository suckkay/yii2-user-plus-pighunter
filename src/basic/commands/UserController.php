<?php
namespace suckkay\userplus\basic\commands;

use suckkay\userplus\base\ConsoleController;

/**
 * User manager commands
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class UserController extends ConsoleController{
    
    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'create-admin'=>'suckkay\userplus\basic\actions\CommandCreateAction',
        ];
    }
}
