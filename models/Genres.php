<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genres".
 *
 * @property int $genre_id
 * @property string $genre
 * @property string $alias
 */
class Genres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genre'], 'required'],
            [['genre', 'alias'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'genre_id' => 'Genre ID',
            'genre' => 'Genre',
            'alias' => 'Alias',
        ];
    }
}
