
markdown-it-youtube-php
=======================

This is a plugin for the [markdown-it-php Markdown parser][1] by Kenji Yasuda.  It allows you to easily embed YouTube videos into your Markdown enabled website, without allowing HTML.

__Table of Contents__

- [Install](#install)
- [Syntax](#syntax)
- [License](#license)

## Install

**composer**:

```bash
composer require gcdinsmore/markdown-it-youtube-php
```


### Simple

```php
use Kaoken\MarkdownIt\MarkdownIt;
use GCDinsmore\YoutubeIt\YoutubeIt;

$md = new MarkdownIt();
$md->plugin(new YoutubeIt());
echo $md->render("!yt[](sk2pr4XD_kw)");
```


### Init with options

```php
$md = new MarkdownIt();
$md->plugin(new YoutubeIt([
	"width" => "200px",
	"height" => "200px",
	"origin" => "https://example.com"
]));
echo $md->render("!yt[](sk2pr4XD_kw)");
```

### Details of the options

| Option  | Default | Description                                                          |
| ------- | ------- | -------------------------------------------------------------------- |
| class   |         | Specify a class attribute for the iframe. Use this to style iframes. |
| height  | 480px   | The height attribute of the YouTube iframe                           |
| origin  |         | This is the origin argument of the embedded URL.  According to [YouTube][3], this can help prevent malicious JavaScript from hijacking your YouTube videos. |
| width   | 270px   | The width attribute of the YouTube iframe                            |

## Syntax

YoutubeIt syntax is similar to the standard image Markdown syntax, except you add **yt** after the initial exclamation point. The text inside the square brackets is used as the alt text.  The optional text after the URL is used as the title.

The URL portion can be just the video ID, or it can be the URL from the YouTube page.

```
!yt[Lady Washington](https://www.youtube.com/watch?v=4YBB1VXg_hk "Lady Washington from SailingNW.com")
```
The reference style syntax is supported as well.

```
!yt[S/V Audrey II][1]
Some text
- a
- b


[1]: sk2pr4XD_kw \"S/V Audrey II Adventure\"
```


## License

I'm using the same [MIT][2] license that markdown-it and markdown-it-php are using.

[1]: https://github.com/kaoken/markdown-it-php/
[2]: https://github.com/gcdinsmore/markdown-it-youtube-php/blob/main/LICENSE
[3]: https://developers.google.com/youtube/iframe_api_reference