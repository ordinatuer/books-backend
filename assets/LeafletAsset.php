<?php

namespace app\assets;
use yii\web\AssetBundle;

class LeafletAsset extends AssetBundle
{
    public $css = [
        '//unpkg.com/leaflet@1.5.1/dist/leaflet.css',
    ];
    public $js = [
        'https://unpkg.com/leaflet@1.5.1/dist/leaflet.js',
    ];
    public $cssOptions = [
        'integrity' => 'sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==',
        'crossorigin' => '',
    ];
    public $jsOptions = [
        'integrity' => 'sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==',
        'crossorigin' => '',
        'position' => \yii\web\View::POS_END,
    ];
}