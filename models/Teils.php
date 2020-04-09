<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
class Teils extends ActiveRecord
{
    public $imagefile;
    private $imageDir = '/img/';
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
            [['imagefile'], 'image', 'extensions' => 'png, jpg'],
            [['fill', 'image'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        if (
             $this->validate() AND
              3 == $this->type
          ) {
            $this->imagefile = UploadedFile::getInstanceByName('imagefile');
            if (0 === $this->imagefile->error) {
                $fileName = substr(time(), 2) . '.' . $this->imagefile->extension;
                $fullName = Yii::getAlias('@webroot') . $this->imageDir . $fileName;

                $flag = $this->imagefile->saveAs($fullName);

                $this->image = $fileName;
            }
        }


        
        return parent::beforeSave($insert);
    }

    public function fields()
    {
        return ['image', 'teil_id', 'text', 'type', 'x', 'y','fill', 'size', 'r'];
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
