<?php

use yii\db\Migration;

/**
 * Class m190609_122854_create_teils
 */
class m190609_122854_create_teils extends Migration
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
			'line_to' => 'int',
			'line_id' => 'int',
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190609_122854_create_teils cannot be reverted.\n";

        return false;
    }
    */
}
