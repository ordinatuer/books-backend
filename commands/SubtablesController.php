<?php

namespace app\commands;

use yii\helpers\Console;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\Links;
use app\models\Tags;
use app\models\Genres;

class SubtablesController extends Controller
{
    public function actionTags()
    {
        $tags_list = [];

        $links = Links::find()->select('tags')->all();

        foreach ($links as $link) {
            $tags = explode(',', $link->tags);

            foreach($tags as $tag) {
                $tag = trim($tag);

                if (in_array($tag, $tags_list)) {
                    continue;
                }

                $tags_list[] = $tag;

                $tag_already = Tags::find()
                    ->where([
                        'tag' => $tag
                    ])
                    ->one();

                if (!$tag_already) {
                    $tag_new = new Tags();
                    $tag_new->tag = $tag;

                    $tag_add = $tag_new->save();
                

                    if ($tag_add) {
                        print("Add " . $tag . "\n");
                    } else {
                        print("Чо-то не добавился " . $tag . "\n");
                    }
                } else {
                    print("Уже есть " . $tag . "\n");
                }
            }
        }

        return ExitCode::OK;
    }

    public function actionGenres()
    {
        $genres = [];

        $links = Links::find()->select('genre')->all();

        foreach ($links as $link) {
            $genre = trim($link->genre);

            if (!in_array($genre, $genres)) {
                $genres[] = $genre;

                $genre_already = Genres::find()->where(['genre'=>$genre])->one();
                if (!$genre_already) {
                    $genre_new = new Genres();
                    $genre_new->genre = $genre;
                    $genre_add = $genre_new->save();

                    if ($genre_add) {
                        print("Добавлен жанр " . $genre . "\n");
                    } else {
                        print("Чо-то не добавился " . $genre . "\n");
                    }
                } else {
                    print('Повтор в базе ' . $genre . "\n");    
                }
            } else {
                print('Повтор в списке ' . $genre . "\n");
            }
        }

        return ExitCode::OK;
    }
}