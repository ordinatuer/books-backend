<?php

use yii\db\Migration;

/**
 * Class m190612_204853_add_lines_fk
 */
class m190612_204853_add_lines_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $fk_from = 'line_from_point';
    private $fk_to = 'line_to_point';
    
    public function safeUp()
    {
        $this->addForeignKey(
            $this->fk_from,
            'lines',
            'line_from',
            'teils',
            'teil_id'
        );
        
        $this->addForeignKey(
            $this->fk_to,
            'lines',
            'line_to',
            'teils',
            'teil_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            $this->fk_from,
            'lines'
        );
        
        $this->dropForeignKey(
            $this->fk_to,
            'lines'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_204853_add_lines_fk cannot be reverted.\n";

        return false;
    }
    */
}
