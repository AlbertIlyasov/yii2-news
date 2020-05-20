<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200519_150251_create_user_table extends Migration
{
    const TABLE_NAME = '{{%user}}';
    const FIELD_ID = 'id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            self::FIELD_ID => $this->primaryKey()->unsigned(),
            'login' => $this->string(30)->unique()->notNull(),
            'passwd' => $this->string(60)->notNull(),
            'email' => $this->string(60)->unique()->notNull(),
            'created_at' => $this->timestamp()
                ->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()
                ->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP')
                ->append('ON UPDATE NOW()'),
        ]);

        $this->insertDemoData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    protected function insertDemoData(): void
    {
        foreach ($this->getDemoData() as $data) {
            $this->insert(self::TABLE_NAME, $data);
        }
    }

    protected function getDemoData(): array
    {
        return [
            [
                'login' => 'user1',
                'passwd' => Yii::$app->getSecurity()->generatePasswordHash('user1'),
                'email' => 'user1@testajskhf7823auyioq.ru',
            ],
            [
                'login' => 'user2',
                'passwd' => Yii::$app->getSecurity()->generatePasswordHash('user2'),
                'email' => 'user2@testajskhf7823auyioq.ru',
            ],
        ];
    }
}
