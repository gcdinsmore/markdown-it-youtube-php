<?php
/* markdown-it-youtube-php 0.1.0 
 * https://github.com/gcdinsmore/markdown-it-youtube-php
 * Copyright (c) 2022 Glen Dinsmore <glen@saltygeek.com>
 * @license MIT 
 */

use PHPUnit\Framework\TestCase;
use Kaoken\MarkdownIt\MarkdownIt;
use GCDinsmore\YoutubeIt\YoutubeIt;

final class YoutubeItTest extends TestCase
{
	private static MarkdownIt $md;

	static function setUpBeforeClass(): void { 
		self::$md = new MarkdownIt([
			"html"=> false,
			"typographer"=> false,
			"linkify"=> false
		]);
		self::$md->plugin(new YoutubeIt());
	}

	public function testHappyNoArgs(): void {
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw\" width=\"480px\" height=\"270px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"\" title=\"YouTube video player\"></iframe></p>\n",
			self::$md->render("!yt[](sk2pr4XD_kw)")
		);
	}

	public function testHappyLabel(): void {
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw\" width=\"480px\" height=\"270px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"My label\" title=\"YouTube video player\"></iframe></p>\n",
			self::$md->render("!yt[My label](sk2pr4XD_kw)")
		);
	}

	public function testHappyTitle(): void {
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw\" width=\"480px\" height=\"270px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"\" title=\"My Title\"></iframe></p>\n",
			self::$md->render("!yt[](sk2pr4XD_kw \"My Title\")")
		);
	}

	public function testHappyURL1(): void {
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw\" width=\"480px\" height=\"270px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"\" title=\"My Title\"></iframe></p>\n",
			self::$md->render("!yt[](youtu.be/sk2pr4XD_kw \"My Title\")")
		);
	}

	public function testHappyURL2(): void {
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw\" width=\"480px\" height=\"270px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"\" title=\"My Title\"></iframe></p>\n",
			self::$md->render("!yt[](www.youtube.com/watch?v=sk2pr4XD_kw \"My Title\")")
		);
	}

	public function testHappyReference(): void {
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw\" width=\"480px\" height=\"270px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"label\" title=\"My Title\"></iframe></p>\n<h1>Header</h1>\n",
			self::$md->render("!yt[label][1]\n# Header\n\n[1]: sk2pr4XD_kw \"My Title\"\n")
		);
	}

	public function testFailMissingEndPeren(): void {
		$this->assertEquals(
			"<p>!yt[label](sk2pr4XD_kw &quot;My Title&quot;</p>\n",
			self::$md->render("!yt[label](sk2pr4XD_kw \"My Title\"\n")
		);
	}

	public function testOptions(): void {
		$md = new MarkdownIt([
			"html"=> false,
			"typographer"=> false,
			"linkify"=> false
		]);
		$md->plugin(new YoutubeIt([
			"width"=> "240px",
			"height"=> "200px",
			"origin"=> "https://example.com",
			"class"=> "yt"
		]));
		$this->assertEquals(
			"<p><iframe src=\"https://www.youtube.com/embed/sk2pr4XD_kw?origin=https://example.com\" width=\"240px\" height=\"200px\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" alt=\"\" title=\"YouTube video player\" class=\"yt\"></iframe></p>\n",
			$md->render("!yt[](sk2pr4XD_kw)")
		);
	}

}