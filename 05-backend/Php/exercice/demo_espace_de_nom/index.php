<?php
// require_once __DIR__ . '/src/Demo.php';
// require_once __DIR__ . '/src/Blog/Article/Demo.php';
require __DIR__ . '/vendor/autoload.php';

use App\Demo as AppDemo;
use App\Blog\Article\Demo;

new AppDemo();
new Demo();
