<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../blog.conn.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/ParseDown.php');

$ParseDown = new Parsedown();

class Article {
  public int $id;
  public Author $author;
  public string $title;
  public string $urlid;
  public string $url;
  public array $tags;
  public int $views;
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
    $this->tags = explode(', ', $row['Tags']);
    $this->views = intval($row['Views']);
    $this->img = $row['Cover'];
    $this->col = $row['Colour'];
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
          Tags = '".$conn->real_escape_string(implode(', ', $this->tags))."',
          Cover = '".$conn->real_escape_string($this->img)."',
          Colour = '".$conn->real_escape_string($this->col)."'
        WHERE PostID = $this->id;
      ");
    else {
      $this->urlid = substr(strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $this->title))), 0, 64);
      $result = $conn->query("
        INSERT INTO post(UserID, Hidden, Title, Url, Content, Tags, Cover, Colour)
        VALUES (
          ".$this->author->id.",
          ".($this->hidden?'true':'false').",
          '".$conn->real_escape_string($this->title)."',
          '".$conn->real_escape_string($this->urlid)."',
          '".$conn->real_escape_string($this->content)."',
          '".$conn->real_escape_string(implode(', ', $this->tags))."',
          '".$conn->real_escape_string($this->img)."',
          '".$conn->real_escape_string($this->col)."'
        );
      ");
    }
    if(!$result) {
      throw new Exception($conn->error);
    }
  }

  function view($userid = 'NULL') {
    global $conn;
    $result = $conn->query("
      INSERT INTO viewers(PostID, UserID) VALUES($this->id, $userid)
    ");
    if(!$result) {
      throw new Exception($conn->error);
    }
    $this->views += 1;
  }

  function preview_wide($edit = false) : string {
    global $ParseDown;
    return "
      <section class=\"post".($this->hidden?' dim':'')."\" id=\"$this->id\">
        <div class=\"x-scroller\">
          <div class=\"carousel\">
            <img src=\"https://cdn.yiays.com/blog/$this->img\" alt=\"Cover image for $this->title\">
            ".$this->carousel_images()."
          </div>
        </div>
        <h3><a href=\"$this->url\">$this->title</a></h3>
        <span class=\"dim\">
          Published by <b>".$this->author->handle()."</b> on <i>".$this->date->format('Y-m-d')."</i>
          ".($this->editdate?'<i>(Last edited '.$this->editdate->format('Y-m-d').')</i>':'')."
          ".($this->tags?"<br>Tags: <i>".implode(', ', $this->tags)."</i>":'')." | $this->views Views
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
      <a class=\"article-mini\" href=\"$this->url\" style=\"background-color:$this->col;background-image:url(https://cdn.yiays.com/blog/$this->img);\">
        <div class=\"info\">
          <b>$this->title</b><br>
          ".implode(', ', $this->tags)."
        </div>
      </a>
    ";
  }

  function carousel_images() : string {
    $result = "";
    $matchcount = preg_match_all("/!\[([^\]]*?)\]\((.*?)\s*(\"(?:.*[^\"])\")?\s*\)/", $this->content, $matches);
    if($matchcount) {
      for($i=0; $i<$matchcount; $i++) {
        $imgurl = str_replace('.webp', '.thumb.webp', $matches[2][$i]);
        $result .= "<img alt=\"".$matches[1][$i]."\" src=\"".$imgurl."\" width=400 height=300>
            ";
      }
    }
    $doc = new DOMDocument();
    $doc->loadHTML($this->content);
    foreach($doc->getElementsByTagName('img') as $img) {
      $imgurl = str_replace('.webp', '.thumb.webp', $img->getAttribute('src'));
      $result .= "<img alt=\"".$img->getAttribute('alt')."\" src=\"".$imgurl."\">
            ";
    }
    return $result;
  }
}
class Author {
  public int $id;
  public string $username;

  function setup($row)
  {
    $this->id = $row['UserID'];
    $this->username = $row['Username'];
  }

  function handle() : string{
    return $this->username;
  }
}
class Comment {
  public int $id;
  public Author $author;
  public string $content;
  public ?Comment $reply;
  public DateTime $date;
  public bool $hidden;

  function setup($row) {
    $this->id = $row['CommentID'];
    $this->author = new Author();
    $this->author->setup($row);
    $this->content = $row['Content'];
    $this->reply = null;
    $this->date = new DateTime($row['PublishDate']);
    $this->hidden = $row['Hidden'];
  }
}

function fetch_articles($trim=false, $start=0, $limit=20): array {
  global $conn;

  $contentq = ($trim?"SUBSTRING(Content, 1, $trim) AS Content":'Content');
  $result = $conn->query(
    "SELECT post.PostID,Title,Url,Tags,Cover,Colour,Date,EditDate,$contentq,Hidden,post.UserID,passport.user.Username,COUNT(viewers.ViewTime) AS Views
    FROM (post
      LEFT JOIN passport.user ON post.UserID = passport.user.Id)
      LEFT JOIN viewers ON post.PostID = viewers.PostID
    GROUP BY post.PostID
    ORDER BY Date DESC
    LIMIT $start, $limit"
  );
  if(!$result) {
    throw new Exception($conn->error);
  }
  $articles = [];
  while($row = $result->fetch_assoc()){
    $article = new Article();
    $article->setup($row);
    $articles[] = $article;
  }

  return $articles;
}

function fetch_article($url=null, $id=null): ?Article {
  global $conn;

  if(!is_null($id)) $id = (int)$id;
  $result = $conn->query(
    "SELECT post.PostID,Title,Url,Tags,Cover,Colour,Date,EditDate,Content,Hidden,post.UserID,passport.user.Username,COUNT(viewers.ViewTime) AS Views
    FROM (post
      LEFT JOIN passport.user ON post.UserID = passport.user.Id)
      LEFT JOIN viewers ON post.PostID = viewers.PostID
    WHERE ".($url?"Url = '".$conn->real_escape_string($url)."'":"PostID = $id")."
    GROUP BY post.PostID
    ORDER BY Date DESC"
  );
  if(!$result) {
    throw new Exception($conn->error);
  }
  if($result->num_rows == 1) {
    $article = new Article();
    $article->setup($result->fetch_assoc());

    return $article;
  } else {
    return null;
  }
}