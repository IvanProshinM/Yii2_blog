<?php

use yii\db\Migration;

/**
 * Class m220407_144256_staffColumn
 */
class m220407_144256_staffColumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('staff', 'staffName', $this->text());
        $this->addColumn('staff', 'staffPosition', $this->text());
        $this->addColumn('staff', 'staffSpecialization', $this->text());
        $this->addColumn('staff', 'age', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('staff', 'staffName');
        $this->dropColumn('staff', 'staffPosition');
        $this->dropColumn('staff', 'staffSpecialization');
        $this->dropColumn('staff', 'age');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220407_144256_staffColumn cannot be reverted.\n";

        return false;
    }
    */
}
