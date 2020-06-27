<?php

return [
    // xpath заголовка 
    'h1' => [
        'xpath' => "/html/body/div[1]/div[3]/div[2]/div/div[1]/div/div[2]/div[1]/h1/text()",
        'find' => function ($src) {
            return $src->item(0)->nodeValue;
        },
    ],

    // xpath скрипта вставки изображения изображения 
    'src_image' => [
        'xpath' => '//*[@id="biblio-book-cover-wrapper"]',
        'find' => function($src) {
            $string = $src->item(0)->nodeValue;
            $string = explode("img_path = '", $string);
            $string = explode("';", $string[1]);

            return $string[0];
        },
    ],

    // жанр
    'genres' => [
        'xpath' => '//*[@class="biblio_info__link"]',
        'find' => function($src) {
            $res = [];

            for ($i=0;$i<$src->length;$i++) {
                $res[] = $src->item($i)->nodeValue;
            }

            return $res;
        },
    ],
];