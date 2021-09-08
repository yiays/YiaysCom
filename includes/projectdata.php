<?php
class Project {
  public $id;
  public $title;
  public $img;
  public $langs;
  public $techs;
  public $desc;
  public $link;
  public $github;

  function __construct($id, $title, $img, $langs, $techs, $desc, $link, $github=null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->img = $img;
    $this->langs = $langs;
    $this->techs = $techs;
    $this->desc = $desc;
    $this->link = $link;
    $this->github = $github;
  }

  function __toString()
  {
    return "
      <div class=\"project\" id=\"$this->id\" data-langs=\"$this->langs\">
        <img alt=\"Artwork that represents $this->name\" src=\"$this->img\" width=150 height=150>
        <h3>$this->title</h3>
        <span>$this->techs</span>
        <p>$this->desc</p>
        <a class=\"btn\" href=\"$this->link\" target=_blank>View</a>
        <a class=\"btn\" href=\"$this->github\" target=_blank>View on GitHub</a>
      </div>
    ";
  }

  function preview()
  {
    return "
      <a class=\"project-mini\" href=\"/projects/#$this->id\" style=\"background-image: url('$this->img');\">
        <div class=\"info\">
          <b>$this->title</b><br>
          $this->langs
        </div>
      </a>
    ";
  }
}

$projects = [
  new Project('meme', "MemeDB", "/img/memedb.svg", "php,mysql,js", "database,discord,desktop,mobile", "A massive database of memes with crowd-sourced metadata, making for one of the best places on the web to search for memes!", "https://meme.yiays.com/", "https://github.com/TeamMemeDB/"),
  new Project('merely', "Merely", "/img/merely.svg", "py,js", "discord,desktop,mobile", "Merely is a framework for discord bots written atop of Discord.py which makes advanced features like module reloading and translation possible. MerelyBot is an example implementation.", "https://merely.yiays.com/", "https://github.com/yiays/merely/"),
  new Project('cb', "ConfessionBot", "/img/cb.svg", "py", "discord", "ConfessionBot adds anonymous messaging to Discord, being used by thousands of Discord servers, ConfessionBot is the most popular implementation of the Merely framework.", "https://l.yiays.com/confessionbot", "https://github.com/yiays/Translate-Confessionbot/"),
  new Project('pukeko', "PukekoHost", "/img/pukeko.svg", "php,mysql,js,py", "database,discord,desktop,mobile", "PukekoHost is a democratized game hosting service where members of a Discord server can crowdfund servers for their favourite games.", "https://pukeko.yiays.com/", "https://github.com/Pukeko-Host/"),
  new Project('kahoot', "KahootDiscord", "/img/kahoot.svg", "py,js,cs", "discord,desktop,mobile", "A clone of Kahoot that can be played within a Discord server. Currently being rewritten.", "https://kahoot.yiays.com/", "https://github.com/yiays/noncopyrightedquizgamename/"),
  new Project('dino', "Dino", "/img/genericwhite.svg", "cs,mysql,php", "database,desktop,mobile", "A clone of the Dino Game in Chrome, but in 3D and with a global leaderboard.", "https://github.com/yiays/dino/releases", "https://github.com/yiays/dino"),
  new Project('wipeout', "WipEout Fan Site", "/img/wipeout.svg", "js", "desktop,mobile", "A fan site for a game franchise. Features some interesting CSS effects.", "https://wipeout.yiays.com/", "https://github.com/yiays/design/tree/assessment-2/"),
  new Project('blog', "Blog", "/img/blog.svg", "php,mysql,js", "database,desktop,mobile", "An alternative design for the blog on this website, highly experimental.", "https://blog.yiays.com/?old=1", "https://github.com/yiays/blog/")
];
?>