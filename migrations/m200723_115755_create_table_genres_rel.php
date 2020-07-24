<?php

use yii\db\Migration;

/**
 * Class m200723_115755_create_table_genres_rel
 */
class m200723_115755_create_table_genres_rel extends Migration
{
    private $tableName = 'genres_rel';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'teil_id' => 'int',
            'genre_id' => 'int',
            'link_id' => 'int',
            'PRIMARY KEY(teil_id, genre_id)',
        ]);

        $this->addForeignKey('fk-genre-genre',
            $this->tableName,
            'genre_id',
            'genres',
            'genre_id'
        );

        $this->addForeignKey('fk-genre-teil',
            $this->tableName,
            'teil_id',
            'teils',
            'teil_id'
        );

        $this->addForeignKey('fk-genre-links',
            $this->tableName,
            'link_id',
            'links',
            'link_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200723_115755_create_table_genres_rel cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200723_115755_create_table_genres_rel cannot be reverted.\n";

        return false;
    }
    */
}
