<?php

use yii\db\Migration;

/**
 * Class m220328_145036_userBase
 */
class m220328_145036_userBase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'gender', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220328_145036_userBase cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220328_145036_userBase cannot be reverted.\n";

        return false;
    }
    */
}
