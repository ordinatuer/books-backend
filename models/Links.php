<?php

namespace app\models;

use Yii;
use app\models\Teils;

/**
 * This is the model class for table "links".
 *
 * @property int $link_id
 * @property string $link_text
 * @property string $image
 * @property string $name
 * @property string $genre
 * @property string $tags
 * @property int $genre_id
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_text'], 'required'],
            [['link_text', 'image', 'name', 'genre', 'tags'], 'string'],
            [['genre_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'link_text' => 'Ссылка',
            'image' => 'Обложка',
            'name' => 'Название',
            'genre' => 'Жанр',
            'tags' => 'Тэги',
            'genre_id' => 'Genre ID',
        ];
    }
}
