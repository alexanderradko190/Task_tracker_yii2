<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workers_rating}}`.
 */
class m240223_132527_create_workers_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workers_rating}}', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer()->notNull(),
            'rating' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workers_rating}}');
    }
}
