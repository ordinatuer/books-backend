<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teils".
 *
 * @property int $teil_id
 * @property int $x
 * @property int $y
 * @property int $l
 * @property int $h
 * @property int $r
 * @property string $fill
 * @property string $image
 * @property string $text
 * @property int $size
 * @property int $line_to
 * @property int $line_id
 */
class Teils extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teils';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['x', 'y', 'l', 'h', 'r', 'size', 'type'], 'integer'],
            [['text'], 'string'],
            [['fill', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teil_id' => 'Teil ID',
            'x' => 'X',
            'y' => 'Y',
            'l' => 'L',
            'h' => 'H',
            'r' => 'R',
            'fill' => 'Fill',
            'image' => 'Image',
            'text' => 'Text',
            'size' => 'Size',
            'line_to' => 'Line To',
            'line_id' => 'Line ID',
            'type' => 'Type',
        ];
    }
}
