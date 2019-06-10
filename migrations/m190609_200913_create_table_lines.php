<?php

use yii\db\Migration;

/**
 * Class m190609_200913_create_table_lines
 */
class m190609_200913_create_table_lines extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('lines', [
			'line_id' => 'pk',
			'line_from' => 'int',
			'line_to' => 'int',
			'path' => 'text',
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190609_200913_create_table_lines cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190609_200913_create_table_lines cannot be reverted.\n";

        return false;
    }
    */
}
