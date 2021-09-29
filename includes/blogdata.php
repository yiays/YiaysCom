<?php
require_once('../blog.conn.php');
require_once('includes/ParseDown.php');

$ParseDown = new Parsedown();

class Article {
  public int $id;
  public Author $author;
  public string $title;
  public string $urlid;
  public string $url;
  public string $tags;
  public string $img;
  public string $col;
  public DateTime $date;
  public ?DateTime $editdate;
  public string $content;
  public bool $hidden;

  function setup($row)
  {
    $this->id = $row['PostID'];
    $this->author = new Author();
    $this->author->setup($row);
    $this->title = $row['Title'];
    $this->urlid = $row['Url'];
    $this->url = "https://yiays.com/blog/$row[Url]/";
    $this->tags = $row['Tags'];
    $this->img = "https://cdn.yiays.com/blog/$row[Cover]";
    $this->col = "#$row[Colour]";
    $this->date = new DateTime($row['Date']);
    $this->editdate = new DateTime($row['EditDate']);
    $this->content = $row['Content'];
    $this->hidden = $row['Hidden'];
  }

  function save() {
    global $conn;
    if($this->id >= 0)
      $result = $conn->query("
        UPDATE post
        SET
          Hidden = ".($this->hidden?'true':'false').",
          Title = '".$conn->real_escape_string($this->title)."',
          Content = '".$conn->real_escape_string($this->content)."',
          Tags = '".$conn->real_escape_string($this->tags)."',
          Cover = '".$conn->real_escape_string(substr($this->img, 27))."',
          Colour = '".$conn->real_escape_string($this->col)."'
        WHERE PostID = $this->id;
      ");
    else
      $result = $conn->query("
        INSERT INTO post(UserID, Hidden, Title, Url, Content, Tags, Cover, Colour)
        VALUES (
          ".$this->author->id.",
          ".($this->hidden?'true':'false').",
          '".$conn->real_escape_string($this->title)."',
          '".$conn->real_escape_string($this->url)."',
          '".$conn->real_escape_string($this->content)."',
          '".$conn->real_escape_string($this->tags)."',
          '".$conn->real_escape_string(substr($this->img, 27))."',
          '".$conn->real_escape_string($this->col)."'
        );
      ");
    if(!$result) {
      throw new Exception($conn->error);
    }
  }

  function preview_wide($edit = false) : string {
    global $ParseDown;
    return "
      <section class=\"post".($this->hidden?' dim':'')."\" id=\"$this->id\">
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
        <p>".strip_tags($ParseDown->text(explode('</', explode("\n", $this->content)[0])[0]))."</p>
        <div class=\"flex-row\">
          <a class=\"btn\" href=\"$this->url\">Read More</a>
          ".($edit?'<a class="btn" href="'.$this->url.'edit/">Edit</a>':'')."
        </div>
      </section>
    ";
  }

  function preview() : string {
    return "
      <a class=\"article-mini\" href=\"$this->url\" style=\"background-color:$this->col;background-image:url($this->img);\">
        <div class=\"info\">
          <b>$this->title</b><br>
          $this->tags
        </div>
      </a>
    ";
  }

  function carousel_images() : string {
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
  public int $id;
  public string $username;
  public ?string $pfp;
  public ?string $bio;

  function setup($row)
  {
    $this->id = $row['UserID'];
    $this->username = $row['Username'];
    $this->pfp = null;
    $this->bio = null;
  }

  function handle() : string{
    return $this->username;
  }
}

$articles = [];
$result = $conn->query(
  "SELECT PostID,Title,Url,Tags,Cover,Colour,Date,EditDate,Content,Hidden,UserID,passport.user.Username
  FROM post LEFT JOIN passport.user ON post.UserID = passport.user.Id
  ORDER BY Date DESC"
);
if(!$result) {
  throw new Exception($conn->error);
}
while($row = $result->fetch_assoc()){
  $article = new Article();
  $article->setup($row);
  $articles[] = $article;
}