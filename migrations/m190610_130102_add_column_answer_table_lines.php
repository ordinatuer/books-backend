<?php

use yii\db\Migration;

/**
 * Class m190610_130102_add_column_answer_table_lines
 */
class m190610_130102_add_column_answer_table_lines extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('lines', 'answer', 'int');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('lines', 'answer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190610_130102_add_column_answer_table_lines cannot be reverted.\n";

        return false;
    }
    */
}
