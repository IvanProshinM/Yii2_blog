<?php

use yii\db\Migration;

/**
 * Class m220401_123142_hashcolumn
 */
class m220401_123142_hashcolumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'activateHash', $this->text());
        $this->addColumn('user', 'activatedAt', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220401_123142_hashcolumn cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220401_123142_hashcolumn cannot be reverted.\n";

        return false;
    }
    */
}
