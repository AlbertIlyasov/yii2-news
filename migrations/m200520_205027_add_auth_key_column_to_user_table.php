<?php

use yii\db\Migration;
use app\models\User;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m200520_205027_add_auth_key_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%user}}',
            'auth_key',
            $this->string(32)->notNull()->after('email')
        );
        $this->updateDemoData();
        $this->createIndex('auth_key', '{{%user}}', 'auth_key', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'auth_key');
    }

    protected function updateDemoData(): void
    {
        foreach ($this->getDemoData() as $data) {
            $this->update('{{%user}}', ['auth_key' => $data['auth_key']], ['id' => $data['id']]);
        }
    }

    protected function getDemoData(): array
    {
        $data = [];
        $authKeys = [];
        $users = User::find()->select('id')->asArray()->all();
        foreach ($users as $user) {
            do {
                $authKey = Yii::$app->security->generateRandomString();
            } while (in_array($authKey, $authKeys));
            $authKeys[] = $authKey;

            $data[] = [
                'id' => $user['id'],
                'auth_key' => $authKey,
            ]; 
        }
        return $data;
    }
}
