<?php

use yii\db\Migration;

/**
 * Class m200723_115030_create_table_genres
 */
class m200723_115030_create_table_genres extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('genres', [
            'genre_id' => 'pk',
            'genre' => $this->string(64),
            'alias' => $this->string(64),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200723_115030_create_table_genres cannot be reverted.\n";

        return false;
    }
}
