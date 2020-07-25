<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tags_rel".
 *
 * @property int $tag_id
 * @property int $link_id
 * @property int $teil_id
 */
class TagsRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['tag_id', 'required'],
            [['tag_id', 'link_id', 'teil_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'link_id' => 'Link ID',
            'teil_id' => 'Teil ID',
        ];
    }
}
