<?php
require_once('../blog.conn.php');
require_once('includes/ParseDown.php');

$ParseDown = new Parsedown();

class Article {
  function __construct($row)
  {
    $this->id = $row['PostID'];
    $this->author = new Author($row);
    $this->title = $row['Title'];
    $this->url = "https://blog.yiays.com/$row[Url]/";
    $this->tags = $row['Tags'];
    $this->img = "https://cdn.yiays.com/blog/src/$row[Cover]";
    $this->col = "#$row[Colour]";
    $this->date = new DateTime($row['Date']);
    $this->editdate = new DateTime($row['EditDate']);
    $this->content = $row['Content'];
  }

  function print() {
    global $ParseDown;
    print("
      <article class=\"post\" id=\"$this->id\">
        <h2>$this->title</h2>
        <span class=\"dim\">By ".$this->author->handle().", Written ".$this->date->format('Y-m-d').($this->editdate?', <i>Edited '.$this->editdate->format('Y-m-d').'</i>':'')."</span>
        <span>$this->tags</span>
        <div style=\"background-color:$this->col;background-image:url($this->img);height:10em;\"></div>
        <div class=\"content\">
          ".$ParseDown->text($this->content)."
        </div>
      </article>
    ");
  }

  function preview_wide() {
    global $ParseDown;
    print("
      <section class=\"post\" id=\"$this->id\">
        <div class=\"x-scroller\">
          <div class=\"carousel\">
            <div style=\"background-image:url('$this->img');\"></div>
            ".$this->carousel_images()."
          </div>
        </div>
        <h3>$this->title</h3>
        <span class=\"dim\">
          Published by <b>".$this->author->handle()."</b> on <i>".$this->date->format('Y-m-d')."</i>
          ".($this->editdate?'<i>(Last edited '.$this->editdate->format('Y-m-d').')</i>':'')."
          ".($this->tags?"<br>Tags: <i>$this->tags</i>":'')."
        </span>
        <p>".strip_tags($ParseDown->text(explode("\n", $this->content)[0]))."</p>
        <div class=\"flex-row\">
          <a class=\"btn\" href=\"$this->url\" target=_blank>Read More</a>
        </div>
      </section>
    ");
  }

  function preview() {
    print("
      <a class=\"article-mini\" href=\"$this->url\" style=\"background-color:$this->col;background-image:url($this->img);\">
        <div class=\"info\">
          <b>$this->title</b><br>
          $this->tags
        </div>
      </a>
    ");
  }

  function carousel_images() {
    $result = "";
    $matchcount = preg_match_all("/!\[([^\]]*?)\]\((.*?)\s*(\"(?:.*[^\"])\")?\s*\)/", $this->content, $matches);
    if($matchcount) {
      for($i=0; $i<$matchcount; $i++) {
        $result .= "<div title=\"".$matches[1][$i]."\" style=\"background-image:url(".$matches[2][$i].");\"></div>
            ";
      }
    }
    return $result;
  }
}
class Author {
  function __construct($row)
  {
    $this->id = $row['UserID'];
    $this->username = $row['Username'];
    $this->date = new DateTime($row['DateCreated']);
    $this->pfp = null;
    $this->bio = null;
  }

  function handle(){
    return $this->username;
  }
}

$articles = [];
$result = $conn->query(
  "SELECT PostID,Title,Url,Tags,Cover,Colour,Date,EditDate,Content,post.UserID,auth.Username,auth.DateCreated
  FROM post LEFT JOIN auth ON post.UserID = auth.UserID
  WHERE post.Hidden = 0
  ORDER BY Date DESC"
);
if(!$result) {
  throw new Exception($conn->error);
}
while($row = $result->fetch_assoc()){
  $articles[] = new Article($row);
}