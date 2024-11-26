<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/ParseDown.php');
$ParseDown = new Parsedown();

class Article {
  public string $author;
  public string $title;
  public string $urlid;
  public string $url;
  public array $tags;
  public ?string $content = null;
  public int $views;
  public string $img;
  public string $col;
  public DateTime $date;
  public ?DateTime $editdate;
  public bool $hidden;

  function __construct($author, $title, $urlid, $tags, $img, $col, $date, $editdate, $hidden) {
    $this->author = $author;
    $this->title = $title;
    $this->urlid = $urlid;
    $this->url = "https://yiays.com/blog/$urlid/";
    $this->tags = $tags;
    $this->views = 0;
    $this->img = $img;
    $this->col = $col;
    $this->date = $date;
    $this->editdate = $editdate;
    $this->hidden = $hidden;
  }

  function save() {
    // Save blog content, if loaded, then remove from object to reduce metadata size
    $MDDIR = $_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.md";
    $METADIR = $_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.meta";

    $tempcontent = $this->content;
    file_put_contents($MDDIR, isset($this->content)? $this->content: '');
    $this->content = null;
    // Save metadata
    file_put_contents($METADIR, serialize($this));
    // Restore blog content
    if($tempcontent) $this->content = $tempcontent;
  }

  function view() {
    $this->views += 1;
    $this->save();
  }

  function fetch_content() {
    $this->content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.md");
  }

  function preview_wide($edit = false, $lazy = true) : string {
    global $ParseDown;
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.md");
    return "
      <section class=\"post".($this->hidden?' dim':'')."\">
        <div class=\"x-scroller\">
          <div class=\"carousel\">
            <a href=\"$this->url\">
              <img src=\"https://cdn.yiays.com/blog/$this->img\" alt=\"Cover image for $this->title\" loading=\"".($lazy?'lazy':'eager')."\">
            </a>
            ".$this->carousel_images()."
          </div>
        </div>
        <h3><a href=\"$this->url\">$this->title</a></h3>
        <span class=\"dim\">
          Published by <b>".$this->author."</b> on <i>".$this->date->format('Y-m-d')."</i>
          ".($this->editdate?'<i>(Last edited '.$this->editdate->format('Y-m-d').')</i>':'')."
          ".($this->tags?"<br>Tags: <i>".implode(', ', $this->tags)."</i>":'')." | ".number_format($this->views)." Views
        </span>
        <p>".strip_tags($ParseDown->text(explode('</', explode("\n", $content)[0])[0]))."</p>
        <div class=\"flex-row\">
          <a class=\"btn\" href=\"$this->url\">Read More</a>
          ".($edit?'<a class="btn" href="'.$this->url.'edit/">Edit</a>':'')."
        </div>
      </section>
    ";
  }

  function preview() : string {
    $esc_img = str_replace('+', '%20', urlencode($this->img));
    return "
      <a class=\"article-mini\" href=\"$this->url\">
        <img src=\"//cdn.yiays.com/blog/$esc_img\" alt=\"$this->title\" loading=\"lazy\">
        <div class=\"info\">
          <b>$this->title</b><br>
          ".implode(', ', $this->tags)."
        </div>
      </a>
    ";
  }

  function carousel_images() : string {
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.md");
    $result = "";
    // Find markdown images
    $matchcount = preg_match_all("/!\[([^\]]*?)\]\((.*?)\s*(\"(?:.*[^\"])\")?\s*\)/", $content, $matches);
    if($matchcount) {
      for($i=0; $i<$matchcount; $i++) {
        $imgurl = str_replace('.webp', '.thumb.webp', $matches[2][$i]);
        $result .= "<img alt=\"".$matches[1][$i]."\" src=\"".$imgurl."\" width=640 height=480 loading=\"lazy\">
            ";
      }
    }
    // Find HTML images
    $doc = new DOMDocument();
    $doc->loadHTML($content);
    foreach($doc->getElementsByTagName('img') as $img) {
      $imgurl = str_replace('.webp', '.thumb.webp', $img->getAttribute('src'));
      $result .= "<img alt=\"".$img->getAttribute('alt')."\" src=\"".$imgurl."\" loading=\"lazy\">
            ";
    }
    return $result;
  }
}

$articles = [];
foreach(glob($_SERVER['DOCUMENT_ROOT']."/blog/articles/*.meta") as $article) {
  $articles []= unserialize(file_get_contents($article));
  usort($articles, fn($a, $b) => $a->date < $b->date);
}

function fetch_article($urlid) {
  global $articles;
  foreach($articles as $article) {
    if($article->urlid == $urlid) return $article;
  }
}