<?php

use yii\db\Migration;

/**
 * Class m200723_123652_create_table_tags_rel
 */
class m200723_123652_create_table_tags_rel extends Migration
{
    private $tableName = 'tags_rel';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'tag_id' => 'int',
            'teil_id' => 'int',
            'link_id' => 'int',
            'PRIMARY KEY(tag_id, teil_id)',
        ]);

        $this->addForeignKey('fk-tags-tag',
            $this->tableName,
            'tag_id',
            'tags',
            'tag_id'
        );

        $this->addForeignKey('fk-tags-teil',
            $this->tableName,
            'teil_id',
            'teils',
            'teil_id'
        );

        $this->addForeignKey('fk-tags-links',
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
        echo "m200723_123652_create_table_tags_rel cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200723_123652_create_table_tags_rel cannot be reverted.\n";

        return false;
    }
    */
}
