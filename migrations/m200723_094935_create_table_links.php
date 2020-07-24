<?php

use yii\db\Migration;

/**
 * Class m200723_094935_create_table_links
 */
class m200723_094935_create_table_links extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('links', [
            'link_id' => 'pk',
            'link_text' => 'text',
            'image' => 'text',
            'name' => 'text',
            'genre' => $this->string(127),
            'genre_id' => 'int',
            'tags' => 'text',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200723_094935_create_table_links cannot be reverted.\n";

        return false;
    }
}
