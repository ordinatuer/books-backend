<?php

use yii\db\Migration;

/**
 * Class m200723_115519_create_table_tags
 */
class m200723_115519_create_table_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tags', [
            'tag_id' => 'pk',
            'tag' => $this->string(128),
            'alias' => $this->string(128),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200723_115519_create_table_tags cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200723_115519_create_table_tags cannot be reverted.\n";

        return false;
    }
    */
}
