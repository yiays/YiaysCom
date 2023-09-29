<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/ParseDown.php');
$ParseDown = new Parsedown();

class Article {
  public string $author;
  public string $title;
  public string $urlid;
  public string $url;
  public array $tags;
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
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/blog/articles/$urlid.views"))
      $this->views = intval(file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$urlid.views"));
    else $this->views = 0;
    $this->img = $img;
    $this->col = $col;
    $this->date = $date;
    $this->editdate = $editdate;
    $this->hidden = $hidden;
  }

  function save($content) {
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.md", $content);
  }

  function view() {
    $this->views += 1;
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.views", $this->views);
  }

  function preview_wide($edit = false) : string {
    global $ParseDown;
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/articles/$this->urlid.md");
    return "
      <section class=\"post".($this->hidden?' dim':'')."\">
        <div class=\"x-scroller\">
          <div class=\"carousel\">
            <img src=\"https://cdn.yiays.com/blog/$this->img\" alt=\"Cover image for $this->title\">
            ".$this->carousel_images()."
          </div>
        </div>
        <h3><a href=\"$this->url\">$this->title</a></h3>
        <span class=\"dim\">
          Published by <b>".$this->author."</b> on <i>".$this->date->format('Y-m-d')."</i>
          ".($this->editdate?'<i>(Last edited '.$this->editdate->format('Y-m-d').')</i>':'')."
          ".($this->tags?"<br>Tags: <i>".implode(', ', $this->tags)."</i>":'')." | $this->views Views
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
    return "
      <a class=\"article-mini\" href=\"$this->url\" style=\"background-color:$this->col;background-image:url(https://cdn.yiays.com/blog/$this->img);\">
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
    $matchcount = preg_match_all("/!\[([^\]]*?)\]\((.*?)\s*(\"(?:.*[^\"])\")?\s*\)/", $content, $matches);
    if($matchcount) {
      for($i=0; $i<$matchcount; $i++) {
        $imgurl = str_replace('.webp', '.thumb.webp', $matches[2][$i]);
        $result .= "<img alt=\"".$matches[1][$i]."\" src=\"".$imgurl."\" width=400 height=300>
            ";
      }
    }
    $doc = new DOMDocument();
    $doc->loadHTML($content);
    foreach($doc->getElementsByTagName('img') as $img) {
      $imgurl = str_replace('.webp', '.thumb.webp', $img->getAttribute('src'));
      $result .= "<img alt=\"".$img->getAttribute('alt')."\" src=\"".$imgurl."\">
            ";
    }
    return $result;
  }
}

$articles = [
  new Article(
    "Yiays",
    "GitHub Activity Summary 2022",
    'github-activity-summary-2022',
    ['GitHub', 'Development', 'Web Development'],
    'github-summary-2022.webp',
    '0e1017',
    new DateTime('2023-01-13'),
    new DateTime('2023-01-14'),
    false
  ),
  new Article(
    'Yiays',
    "Bringing developers, translators, and users together with Discord",
    'bringing-developers-translators-and-users-together-with-discord',
    ['Case Study', 'Development', 'Discord'],
    'discord.webp',
    '5662f6',
    new DateTime('2022-01-25'),
    new DateTime('2022-03-25'),
    false
  ),
  new Article(
    'Yiays',
    "GitHub Activity Summary 2021",
    'github-activity-summary-2021',
    ['GutHub', 'Development', 'Web Development'],
    'github-summary-2021.webp',
    '0d1017',
    new DateTime('2022-01-10'),
    new DateTime('2023-01-12'),
    false
  ),
  new Article(
    'Yiays',
    "The curious case of my Cookie Clicker clone",
    'the-curious-case-of-my-cookie-clicker-clone',
    ['GitHub', 'Web Development'],
    'cookie-clicker-win11.webp',
    '653319',
    new DateTime('2021-11-30'),
    null,
    false
  ),
  new Article(
    'Yiays',
    "GitHub Activity Summary 2020",
    'github-activity-summary-2020',
    ['GitHub', 'Development', 'Web Development'],
    'github-summary-2020.webp',
    '0d1017',
    new DateTime('2021-11-15'),
    new DateTime('2023-01-12'),
    false
  ),
  new Article(
    'Yiays',
    "Who is Yiays?",
    'who-is-yiays',
    ['Personal', 'Development'],
    'who-is-yiays.webp',
    '000000',
    new DateTime('2021-10-08'),
    new DateTime('2021-11-17'),
    false
  ),
  new Article(
    'Yiays',
    "GitHub Activity Summary 2019",
    'github-activity-summary-2019',
    ['GitHub', 'Development', 'Web Development'],
    'github-summary-2019.webp',
    '0d1017',
    new DateTime('2021-09-30'),
    new DateTime('2023-01-12'),
    false
  ),
  new Article(
    'Yiays',
    "A history of Yiays.com",
    'a-history-of-my-websites',
    ['Web Development', 'Personal'],
    'yiayscom.webp',
    '7295cd',
    new DateTime('2020-03-18'),
    new DateTime('2021-11-17'),
    false
  ),
  new Article(
    'Yiays',
    "Introducing ConfessionBot",
    'confession-bot-a-side-project',
    ['Discord', 'Development'],
    'confessionbot.webp',
    '000000',
    new DateTime('2019-06-22'),
    new DateTime('2022-05-15'),
    false
  )
];

function fetch_article($urlid) {
  global $articles;
  foreach($articles as $article) {
    if($article->urlid == $urlid) return $article;
  }
}