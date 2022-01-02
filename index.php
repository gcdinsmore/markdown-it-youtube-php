<?php
/* markdown-it-youtube-php 0.1.0 
 * https://github.com/gcdinsmore/markdown-it-youtube-php
 * Copyright (c) 2022 Glen Dinsmore <glen@saltygeek.com>
 * @license MIT 
 */

/**
 * This is for testing YoutubeIt
 */
require_once __DIR__.'/vendor/autoload.php';

use Kaoken\MarkdownIt\MarkdownIt;
use SaltyGeek\YoutubeIt\YoutubeIt;

$md = new MarkdownIt([
	"html"=> false,
	"typographer"=> false,
	"linkify"=> false
]);
$md->plugin(new YoutubeIt([
	"width"=> "240px",
	"height"=> "200px",
	"origin"=> "https://www.example.com"
]));
echo $md->render("!yt[](https://www.youtube.com/watch?v=sk2pr4XD_kw)");