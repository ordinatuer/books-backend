<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lines".
 *
 * @property int $line_id
 * @property int $line_from
 * @property int $line_to
 * @property string $path
 */
class Lines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['line_from', 'line_to'], 'integer'],
            [['path'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'line_id' => 'Line ID',
            'line_from' => 'Line From',
            'line_to' => 'Line To',
            'path' => 'Path',
        ];
    }
}
