<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

use app\models\Links;
use app\models\Tags;

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
 * @property int $type (1, 2, 3)
 * @property int $link_id 
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
            [['x', 'y', 'l', 'h', 'r', 'size', 'type', 'link_id'], 'integer'],
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
        return [
            'image' => function() {
                if ($this->image) {
                    return 'webp-prev/' . $this->image . '.webp';
                } else {
                    return null;
                }
            },
            'teil_id', 'text', 'type', 'x', 'y','fill', 'size', 'r'
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
            'type' => 'Type',
            'link_id' => 'Link ID',
        ];
    }

    public function getLinks()
    {
        return $this->hasOne(Links::className(), ['link_id' => 'link_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['tag_id' => 'tag_id'])
            ->viaTable('tags_rel', ['teil_id' => 'teil_id']);
    }

    public function picture($full = true)
    {
        if ($this->image) {
            $names = [];

            $home = ( $full ) ? Url::home(true) : '';

            $names['jpg'] = $home . Yii::getAlias('@img-jpg') . '/' . $this->image;
            $names['webp'] = $home . Yii::getAlias('@img-webp') . '/' . $this->image . '.webp';
            $names['webp-prev'] = $home . Yii::getAlias('@img-webp-prev') . '/' . $this->image . '.webp';

            return $names;
        } else {
            return false;
        }
    }
}
