<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_notification}}`.
 */
class m200520_165901_create_user_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_notification}}', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'notification_type_id' => $this->integer()->unsigned()->notNull(),
        ]);
        
        $this->createIndex(
            'idx-user_id-notification_type_id',
            '{{%user_notification}}',
            ['user_id', 'notification_type_id'],
            true
        );
        
        $this->addForeignKey(
            'fk-user_notification-user_id',
            '{{%user_notification}}',
            'user_id',
            '{{%user}}',
            'id'
        );

        $this->addForeignKey(
            'fk-user_notification-notification_type_id',
            '{{%user_notification}}',
            'notification_type_id',
            '{{%notification_type}}',
            'id'
        );
        
        $this->insertDemoData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_notification}}');
    }

    protected function insertDemoData(): void
    {
        $data = [];
        foreach ($this->getDemoData() as $datum) {
            foreach ($datum['notificationTypeIds'] as $notificationTypeId) {
                $data[] = [$datum['user_id'], $notificationTypeId];
            }
        }

        $this->batchInsert(
            '{{%user_notification}}',
            ['user_id', 'notification_type_id'],
            $data
        );
    }

    protected function getDemoData(): array
    {
        return [
            [
                'user_id' => 1,
                'notificationTypeIds' => [1, 2, 3, 4],
            ],
            [
                'user_id' => 2,
                'notificationTypeIds' => [1, 3],
            ],
        ];
    }
}
