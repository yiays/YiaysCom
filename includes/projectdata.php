<?php
class Project {
  public string $id;
  public string $title;
  public string $img;
  public array $screenshots;
  public string $langs;
  public string $techs;
  public string $users;
  public string $desc;
  public ?string $link;
  public ?string $github;
  public ?string $article;

  function __construct($id, $title, $img, $screenshots, $langs, $techs, $users, $desc, $link=null, $github=null, $article=null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->img = $img?$img:'/img/genericpurple.svg';
    $this->screenshots = $screenshots;
    $this->langs = $langs;
    $this->techs = $techs;
    $this->users = $users;
    $this->desc = $desc;
    $this->link = $link;
    $this->github = $github;
    $this->article = $article;
  }

  function print() : string {
    return "
      <section class=\"project\" id=\"$this->id\">
        <div class=\"x-scroller\">
          <div class=\"carousel\">
            <div title=\"Artwork that represents $this->title\" style=\"background-image:url('$this->img');\" width=150 height=150></div>
            ".$this->print_screenshots()."
          </div>
        </div>
        <h3>$this->title</h3>
        <span class=\"dim\">
          Users: <b>$this->users</b>
          <br>Platforms: <i>$this->techs</i>
          <br>Technologies: <i>$this->langs</i>
        </span>
        <p>$this->desc</p>
        <div class=\"flex-row\">
          ".($this->link?"<a class=\"btn\" href=\"$this->link\" target=_blank>View Website</a>":'')."
          ".($this->article?"<a class=\"btn\" href=\"$this->article\" target=_blank>Read Article</a>":'')."
          ".($this->github?"<a class=\"btn\" href=\"$this->github\" target=_blank>View on GitHub</a>":'')."
        </div>
      </section>
    ";
  }

  function preview() : string {
    return "
      <a class=\"project-mini\" href=\"/projects/#$this->id\" style=\"background-image: url('$this->img');\">
        <div class=\"info\">
          <b>$this->title</b><br>
          $this->langs
        </div>
      </a>
    ";
  }

  function print_screenshots() : string {
    $out = "";
    foreach($this->screenshots as $screenshot => $screendesc) {
      $out .= "
        <a href=\"$screenshot\" target=\"_blank\" title=\"$screendesc\" style=\"background-image:url('$screenshot');\" height=150></a>
      ";
    }
    return $out;
  }
}

$projects = [
  new Project(
    'yiayscom',
    'Yiays.com',
    '/img/yiayscom.svg',
    [],
    'PHP, Javascript (optional)',
    "Web (mobile friendly)",
    "~200 monthly visits",
    "This website, updated yearly to showcase my skills as they grow. With this most recent design refresh, I'm also merging the blog into this site.",
    null,
    'https://github.com/yiays/YiaysCom',
    'https://yiays.com/blog/a-history-of-my-websites/'
  ),

  new Project(
    'meme',
    "MemeDB",
    "/img/memedb.svg",
    [
      "/img/screenshots/meme1.jpg" => "List of all of the most recently added memes",
      "/img/screenshots/meme2.jpg" => "The interactive meme editor for authenticated users"
    ],
    "NextJS and MongoDB (coming soon)",
    "Database and Web (mobile friendly)",
    "Pending a rewrite",
    "A massive database of memes with crowd-sourced metadata, making for one of the best places on the web to search for memes.",
    "https://meme.yiays.com/",
    "https://github.com/TeamMemeDB/",
    "https://yiays.com/blog/github-activity-summary-2020/"
  ),

  new Project(
    'merely',
    "Merely",
    "/img/merely.svg",
    [
      "/img/screenshots/merely1.jpg" => "Help command from merelybot in Discord",
      "/img/screenshots/merely2.png" => "Merelybot website with video tutorials"
    ],
    "Python and Javascript",
    "Discord and Web (mobile friendly)",
    "~60 Discord guilds",
    "Merely is a framework for discord bots written atop of disnake (a fork of Discord.py) which implements advanced features like module reloading and translation. MerelyBot is an example implementation.",
    "https://merely.yiays.com/",
    "https://github.com/MerelyServices/Merely-Framework"
  ),

  new Project(
    'cb',
    "ConfessionBot",
    "/img/cb.svg",
    [
      "/img/screenshots/cb.jpg" => "An anonymous message sent through ConfessionBot"
    ],
    "Python",
    "Discord",
    "~18,000 Discord Guilds",
    "ConfessionBot adds anonymous messaging to Discord, being used by thousands of Discord servers, ConfessionBot is the most popular implementation of the Merely framework.",
    "https://top.gg/bot/562440687363293195",
    "https://github.com/yiays/ConfessionBot/",
    "https://yiays.com/blog/confession-bot-a-side-project/"
  ),

  new Project(
    'translator',
    "Babel Translator",
    '/img/genericwhite.svg',
    [
      "https://cdn.yiays.com/blog/babel-translator.webp" => "Landing page for the translator GUI"
    ],
    "Javascript",
    "Web (PWA)",
    "~4 Volunteer Translators",
    "Provides tools to help translators work with my Babel language format.",
    "https://translate.yiays.com",
    "https://github.com/yiays/Babel-Translator",
    "https://yiays.com/blog/github-activity-summary-2022/"
  ),

  new Project(
    'smartboard',
    "Smartboard Games",
    '/img/genericpurple.svg',
    [
      "/img/screenshots/whiteboard1.png" => "List of games, can be filtered by subject",
      "/img/screenshots/whiteboard2.png" => "Focused mobile, tablet, and smartboard friendly interface",
      "/img/screenshots/whiteboard3.png" => "A variety of games, challenging students with different subjects"
      //TODO: add a screenshot about leaderboards
    ],
    "Javascript",
    "Web (mobile and smartboard friendly)",
    "Active use in a classroom",
    "A collection of educational games for use in a classroom, being actively developed with a teacher and their classroom of primary school-age students.",
    "https://games.yiays.com",
    "https://github.com/yiays/Smartboard-Games",
    "https://yiays.com/blog/github-activity-summary-2022/"
  ),

  new Project(
    'pukeko',
    "PukekoHost",
    "/img/pukeko.svg",
    [
      "/img/screenshots/pukeko1.png" => "Landing page for PukekoHost, lists all supported games and features",
      "/img/screenshots/pukeko2.png" => "Service tiers and pricing picker for a Minecraft server",
      "/img/screenshots/pukeko3.png" => "Dashboard for customers to manage their servers"
    ],
    "PHP, MySQL, Javascript (optional), and Python",
    "Database, Discord, Web (mobile friendly), and UWP",
    "~70 Monthly Visits",
    "PukekoHost is a democratized game hosting service where members of a Discord server can crowdfund servers for their favourite games.",
    "https://pukeko.yiays.com/",
    "https://github.com/Pukeko-Host/",
    "https://yiays.com/blog/github-activity-summary-2020/"
  ),
  
  /*new Project(
    'kahoot',
    "KahootDiscord",
    "/img/kahoot.svg",
    [],
    "Python, Javascript, and C#",
    "Discord and Web (mobile frendly)",
    "Currently inactive",
    "A clone of Kahoot that can be played within a Discord server. Currently being rewritten.",
    null,
    "https://github.com/yiays/noncopyrightedquizgamename/",
    "https://yiays.com/blog/github-activity-summary-2019/"
  ),*/

  new Project(
    'wipeout',
    "WipEout Fan Site",
    "/img/wipeout.svg",
    [
      "/img/screenshots/wipeout1.jpg" => "Landing page with video background",
      "/img/screenshots/wipeout2.jpg" => "Information tab for a specific game"
    ],
    "Javascript",
    "Web (mobile friendly)",
    "Currently inactive",
    "A fan site for a game franchise. Features some interesting CSS effects.",
    "https://wipeout.yiays.com/",
    "https://github.com/yiays/design/tree/assessment-2/"
  )
];
?>