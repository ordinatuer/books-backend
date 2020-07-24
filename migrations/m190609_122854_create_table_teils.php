<?php

use yii\db\Migration;

/**
 * Class m190609_122854_create_teils
 */
class m190609_122854_create_table_teils extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('teils', [
			'teil_id' => 'pk',
			'x' => 'int',
			'y' => 'int',
			'l' => 'int',
			'h' => 'int',
			'r' => 'int',
			'fill' => 'string',
			'image' => 'string',
			'text' => 'text',
			'size' => 'int',
			'type' => 'int',
			'link_id' => 'int',
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190609_122854_create_teils cannot be reverted.\n";
		
        return false;
    }
}
