<?php

namespace app\assets;
use yii\web\AssetBundle;
//use app\assets\LeafletAsset;

class BooksAsset extends AssetBundle 
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/styles.css',
    ];
    public $js = [
        'js/svg.js',
        'js/script.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];
    public $depends = [
        'app\assets\LeafletAsset',
    ];
}