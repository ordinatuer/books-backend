<?php

use yii\db\Migration;

/**
 * Class m190610_123826_drop_lines_from_table_teils
 */
class m190610_123826_drop_lines_from_table_teils extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->dropColumn('teils', 'line_to');
		$this->dropColumn('teils', 'line_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->addColumn('teils', 'line_to', 'int');
		$this->addColumn('teils', 'line_id', 'int');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190610_123826_drop_lines_from_table_teils cannot be reverted.\n";

        return false;
    }
    */
}
