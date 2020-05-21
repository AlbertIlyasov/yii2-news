<?php

use yii\db\Migration;

/**
 * Class m200521_213653_alter_login_column_to_user_table
 */
class m200521_213653_rename_login_column_to_username_column_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%user}}', 'login', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%user}}', 'username', 'login');
    }
}
