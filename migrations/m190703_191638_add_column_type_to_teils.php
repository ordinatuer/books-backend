<?php

use yii\db\Migration;

/**
 * Class m190703_191638_add_column_type_to_teils
 */
class m190703_191638_add_column_type_to_teils extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'teils',
            'type',
            $this->integer(2)->defaultValue(1)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('teils', 'type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190703_191638_add_column_type_to_teils cannot be reverted.\n";

        return false;
    }
    */
}
