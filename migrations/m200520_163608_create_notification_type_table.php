<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification_type}}`.
 */
class m200520_163608_create_notification_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notification_type}}', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string()->unique()->notNull()
        ]);

        $this->insertDemoData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification_type}}');
    }

    protected function insertDemoData(): void
    {
        foreach ($this->getDemoData() as $type) {
            $this->insert('{{%notification_type}}', ['title' => $type]);
        }
    }

    protected function getDemoData(): array
    {
        return [
            'Sign up',
            'Change password',
            'Add news',
            'Delete news',
        ];
    }
}
