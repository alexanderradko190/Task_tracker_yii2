<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks_workers}}`.
 */
class m240203_152756_create_tasks_workers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks_workers}}', [
            'tasks_id' => $this->integer(),
            'workers_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks_workers}}');
    }
}
