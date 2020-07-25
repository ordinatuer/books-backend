<?php

namespace app\commands;

use app\helpers\Alias;
//use yii\helpers\Console;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\Links;
use app\models\Teils;
use app\models\Tags;
use app\models\Genres;
use app\models\TagsRel;
use app\models\GenresRel;

class SubtablesController extends Controller
{
    public function actionGenreid()
    {
        $links = Links::find()->all();

        foreach($links as $link) {
            $genre_id = $this->getGenreId($link->genre);

            $link->genre_id = $genre_id;
            $flag = $link->save();

            print $flag . ' | ' . $link->genre . "\n";
        }

        return ExitCode::OK;
    }

    public function actionTags()
    {
        $links = Links::find()->all();

        foreach ($links as $link) {
            $tags_list = explode(',', $link->tags);

            foreach($tags_list as $tag) {
                $tag = trim($tag);

                $rel = new TagsRel;

                $rel->tag_id = $this->getTagId($tag);
                $rel->teil_id = $this->getTeilId($link->link_id);
                $rel->link_id = $link->link_id;

                $rel->save();                
            }
        }

        return ExitCode::OK;
    }

    public function actionGenres()
    {
        
        $links = Links::find()->all();

        foreach($links as $link) {
            $genre = trim($link->genre);

            $MGenre = Genres::find()->where(['genre' => $genre])->one();

            $rel = new GenresRel;

            $rel->genre_id = $this->getGenreId($genre);
            $rel->teil_id = $this->getTeilId($link->link_id);
            $rel->link_id = $link->link_id;

            $rel->save();
        }

        return ExitCode::OK;
    }

    private function getTeilId($link_id)
    {
        $teil = Teils::find()
            ->where(['link_id' => $link_id])
            ->one();

        if ( $teil ) {
            return $teil->teil_id;
        } else {
            return null;
        }
        
    }

    /**
     * tag exist - return tag_id
     * not exist - add it and and return tag_id 
     *
     * @property string $tag
    */
    private function getTagId($tag)
    {
        $MTag = Tags::find()
            ->where(['tag' => $tag])
            ->one();

        if ( ! $MTag) {
            $MTag = new Tags;
            $MTag->tag = $tag;
            $MTag->alias = Alias::get($tag, '_');
            $MTag->save();
        }

        return $MTag->tag_id;
    }

    private function getGenreId($genre) {
        $MGenre = Genres::find()
            ->where(['genre' => $genre])
            ->one();

        if ( ! $MGenre ) {
            $MGenre = new Genres;
            $MGenre->genre = $genre;
            $MGenre->alias = Alias::get($genre, '_');
            $MGenre->save();
        }

        return $MGenre->genre_id;
    }
}