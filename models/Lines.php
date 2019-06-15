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
 * @property int $answer
 *
 * @property Teils $lineFrom
 * @property Teils $lineTo
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
            [['line_from', 'line_to', 'answer'], 'integer'],
            [['path'], 'string'],
            [['line_from'], 'exist', 'skipOnError' => true, 'targetClass' => Teils::className(), 'targetAttribute' => ['line_from' => 'teil_id']],
            [['line_to'], 'exist', 'skipOnError' => true, 'targetClass' => Teils::className(), 'targetAttribute' => ['line_to' => 'teil_id']],
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
            'answer' => 'Answer',
        ];
    }

    
    public function fields() {
        return ['line_id','lineFrom','lineTo'];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineFrom()
    {
        return $this->hasOne(Teils::className(), ['teil_id' => 'line_from'])
            //->select(['x', 'y'])
                ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineTo()
    {
        return $this->hasOne(Teils::className(), ['teil_id' => 'line_to'])
            ->select(['x', 'y']);
    }
}
