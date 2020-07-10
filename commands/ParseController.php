<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

use app\models\Links;
use app\models\Teils;

use app\commands\parseTmpl\Tmpl;

class ParseController extends Controller
{    
    const IMAGE_TEIL = 3;
    const TMPL_FILE = __DIR__ . '/parseTmpl/tmpl.php';

    public function actionWait()
    {
        $links = Links::find()->all();
        $inTeil = Teils::find();

        foreach($links as $link) {
            $c = $inTeil->where([
                'text' => $link->name
            ])->count();

            if (0 === $c) {
                $teil = new Teils;
                $teil->y = -10;
                $teil->image = $link->image;
                $teil->text = $link->name;
                $teil->type = self::IMAGE_TEIL; // image type

                $flag = $teil->save();

                if ($flag) {
                    echo $link->name." converted! \n";
                } else {
                    echo $link->name." something went wrong \n";
                }

                unset($teil);
            } else {
                echo $link->name." already loaded \n";
            }
        }

        return ExitCode::OK;
    }

    public function actionIndex()
    {
        echo "------------------------ \n";

        $res = Links::find()->all();

        foreach ($res as $book) {
            if ('' === $book->genre) {
                echo $book->link_text . "\n";

                $parsed = $this->get_parse(trim($book->link_text));

                $path = \Yii::getAlias('@images');

                $flag = $this->curl_copy_img($parsed['src_image'], $path);

                if ($flag) {
                    $current_book = Links::find()->
                        where(['link_id' => $book->link_id])->
                        one();

                    $current_book->image = $this->get_image_name($parsed['src_image']);
                    $current_book->name = $parsed['h1'];
                    $current_book->genre = $parsed['genre'];
                    $current_book->tags = implode(', ', $parsed['tags']);

                    $db_flag = $current_book->save();

                    $db_flag = ($db_flag) ? 'Save' : 'Not' ;

                    echo $db_flag . ' | ' . $parsed['h1'] . " copied -- \n";
                } else {
                    echo "-- Copy error -- \n";
                }
            } else {
                echo "-- Empty list -- \n";
            }
        }

        echo "\n------------------------ \n";

        return ExitCode::OK;
    }

    public function actionFile()
    {
        $flist = fopen('./books.txt', 'r');
        $list = '';

        while(!feof($flist)) {
            $db = new Links;

            $str = fgets($flist);
            $list .= $str;

            $db->link_text = $str;
            $db->image = '';
            $db->name = '';

            $db->save();

            unset($db);
        }

        echo $list;

        return ExitCode::OK;
    }
    /**
     * @param string $src to copy image_src
     * @param string $path images dir
     * @param string $name saved image name
     * @return bool if true - image saved
    */
    private function curl_copy_img($src, $path, $name = '')
    {
        $ch = curl_init($src);

        if ( '' === $name ) {
            $name = $this->get_image_name($src);
        }

        $fp = fopen($path . '/' . $name, "wb");

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $flag = curl_exec($ch);
        curl_close($ch);

        fclose($fp);

        return $flag;
    }

    /**
     * https://srv13.somesite.com/foo/bar/grosse_augen.jpg -> 
     * grosse_augen.jpg
     * @param string $src
     * @return string
    */ 
    private function get_image_name($src)
    {
        $strings = explode('/', $src);
        $last = count($strings) - 1;

        return $strings[$last];
    }

    private function get_parse($link)
    {   
        //$link = "https://www.litres.ru/nil-stivenson/lavina/";

        $doc = new \DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($link);
        libxml_clear_errors();

        $xpath = new \DOMXpath($doc);


        //$arr = require __DIR__ . '/parseTmpl/tmpl.php';
        $arr = require self::TMPL_FILE;
        $result = [];

        foreach ($arr as $name => $tmpl) {
            $src = $xpath->query($tmpl['xpath']);
            $result[$name] = $tmpl['find']($src);
        }
        
        $result['genre'] = array_shift($result['genres']);
        $result['tags'] = $result['genres'];
        unset($result['genres']);

        return $result;
    }

    // private function get_parse($link)
    // {
    //     //$link = "https://www.litres.ru/nil-stivenson/lavina/";
    //     // xpath заголовка 
    //     $h1_xpath = "/html/body/div[1]/div[3]/div[2]/div/div[1]/div/div[2]/div[1]/h1/text()";

    //     // xpath скрипта вставки изображения изображения 
    //     $image_xpath = '//*[@id="biblio-book-cover-wrapper"]';

    //     // жанр
    //     $genre_xpath = '//*[@class="biblio_info__link"]';

    //     $doc = new \DOMDocument();

    //     libxml_use_internal_errors(true);
    //     $doc->loadHTMLFile($link);
    //     libxml_clear_errors();

    //     $xpath = new \DOMXpath($doc);

    //     // получение заголовка
    //     $find = $xpath->query($h1_xpath);
    //     $h1 = $find->item(0)->nodeValue;

    //     // получение изображения из фрагмента JS кода
    //     $find = $xpath->query($image_xpath);
    //     $src_text = $find->item(0)->nodeValue;

    //     $src_text = explode("img_path = '", $src_text);
    //     $src_text = explode("';", $src_text[1]);
    //     $src_image = $src_text[0];

    //     // получение жанра
    //     $find = $xpath->query($genre_xpath);
    //     $_genre = [];

    //     for($i=0;$i<$find->length;$i++) {
    //         $_genre[] = $find->item($i)->nodeValue;
    //     }

    //     $genre = array_shift($_genre);

    //     $result = [
    //         'h1' => $h1,
    //         'src_image' => $src_image,
    //         'genre' => $genre,
    //         'tags' => $_genre,
    //     ];

    //     return $result;
    // }
}