<?php

use yii\db\Migration;

/**
 * Class m220405_125049_resetHashColumn
 */
class m220405_125049_resetHashColumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'ResetHash', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220405_125049_resetHashColumn cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220405_125049_resetHashColumn cannot be reverted.\n";

        return false;
    }
    */
}
