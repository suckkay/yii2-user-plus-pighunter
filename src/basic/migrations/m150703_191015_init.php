<?php

use yii\db\Schema;
use suckkay\userplus\base\migrations\BaseMigration;

class m150703_191015_init extends BaseMigration {

    public function up() {
        $this->createTable('user_accounts', [
            'id' => Schema::TYPE_PK,
            'login' => Schema::TYPE_STRING . '(255) NOT NULL',
            'username' => Schema::TYPE_STRING . '(255) NOT NULL',
            'full_name'=>Schema::TYPE_STRING.'(255)',
            'gender'=>Schema::TYPE_INTEGER,
            'birth_place'=>Schema::TYPE_STRING.'(255)',
            'birth_date'=>Schema::TYPE_DATE,
            'pict_url'=>Schema::TYPE_STRING.'(255)',
            'address'=>Schema::TYPE_TEXT,
            'mobile_phone'=>Schema::TYPE_STRING . '(13)',

            'password_hash' => Schema::TYPE_STRING . '(255) NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(255) NOT NULL',
            'administrator' => Schema::TYPE_INTEGER,
            'creator' => Schema::TYPE_INTEGER,
            'creator_ip' => Schema::TYPE_STRING . '(40)',
            'confirm_token' => Schema::TYPE_STRING,
            'recovery_token' => Schema::TYPE_STRING,
            'blocked_at' => Schema::TYPE_INTEGER,
            'confirmed_at' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $this->tableOptions);
        
        $this->createIndex('user_unique_login', 'user_accounts', 'login', true);
        $this->createIndex('user_unique_username', 'user_accounts', 'username', true);

        $this->createIndex('user_unique_phone', 'user_accounts', 'mobile_phone', true);
    }

    public function down() {
        $this->dropTable('user_accounts');
        return true;
    }

}
