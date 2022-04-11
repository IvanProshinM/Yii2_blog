<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff}}`.
 */
class m220407_143943_create_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff}}', [
            'id' => $this->primaryKey(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%staff}}');
    }
}
