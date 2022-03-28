<?php

use yii\db\Migration;

/**
 * Class m220328_133412_userBase
 */
class m220328_133412_userBase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->text(),
            'userSurname' => $this->text(),
            'email' => $this->text(),
            'password' => $this->text(),
            'confirmPassword' => $this->text(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220328_133412_userBase cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220328_133412_userBase cannot be reverted.\n";

        return false;
    }
    */
}
