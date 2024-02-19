<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workers}}`.
 */
class m240203_150253_create_workers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('workers', [
            'id' => $this->primaryKey(),
            'fio' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'rate' => $this->integer(),
            'phone' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workers}}');
    }
}
