<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genres_rel".
 *
 * @property int $teil_id
 * @property int $genre_id
 * @property int $link_id
 */
class GenresRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genres_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teil_id', 'genre_id'], 'required'],
            [['teil_id', 'genre_id', 'link_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teil_id' => 'Teil ID',
            'genre_id' => 'Genre ID',
            'link_id' => 'Link ID',
        ];
    }
}
