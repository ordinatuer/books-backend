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
            'answer' => 'int',
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
}
