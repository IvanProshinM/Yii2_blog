<?php

use yii\db\Migration;

/**
 * Class m220408_162948_imageColumn
 */
class m220408_162948_imageColumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('staff', 'imageExist', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('staff', 'imageExist');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220408_162948_imageColumn cannot be reverted.\n";

        return false;
    }
    */
}
