<?php

namespace app\models;

use Yii;
use app\models\Teils;

/**
 * This is the model class for table "tags".
 *
 * @property int $tag_id
 * @property string $tag
 * @property string $alias
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag', 'alias'], 'string', 'max' => 128],
        ];
    }

    public function getTeils()
    {
        return $this->hasMany(Teils::className(), ['teil_id' => 'teil_id'])
            ->viaTable('tags_rel', ['tag_id' => 'tag_id']);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'tag' => 'Tag',
            'alias' => 'Alias',
        ];
    }
}
