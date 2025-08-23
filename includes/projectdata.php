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
            <img alt=\"Artwork that represents $this->title\" src=\"$this->img\" width=150 height=150 style=\"aspect-ratio:1\" loading=\"lazy\">
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

  function mainlang() : string {
    $comma = strpos($this->langs, ',') ?: 999;
    $and = strpos($this->langs, ' and') ?: 999;
    return substr($this->langs, 0, min($comma, $and));
  }

  function usercount() : string {
    if(preg_match('/\d/', $this->users)) {
      $space = strpos($this->users, ' ') ?: 999;
      return substr($this->users, 0, $space) . ' users';
    }
    return $this->users;
  }

  function preview() : string {
    return "
      <a class=\"carousel-btn project-mini\" href=\"/projects/#$this->id\">
        <img src=\"$this->img\" alt=\"$this->title\" loading=\"lazy\">
        <div class=\"label\">
          <b>$this->title</b><br>
          <span class=\"c-grey\">".$this->mainlang().", ".$this->usercount()."</span>
        </div>
      </a>
    ";
  }

  function print_screenshots() : string {
    $out = "";
    foreach($this->screenshots as $screenshot => $screendesc) {
      $thumbparts = explode('.', $screenshot);
      $thumbname = join('.', array_merge(array_slice($thumbparts, 0, -1), ['thumb', 'webp']));
      $out .= "
        <a href=\"//cdn.yiays.com/blog/screenshots/$screenshot\" target=\"_blank\" title=\"$screendesc\" height=150>
          <img src=\"//cdn.yiays.com/blog/screenshots/$thumbname\" alt=\"$screendesc\" loading=\"lazy\">
        </a>
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
    "The website you're browsing right now. Frequently updated with new blog posts and projects. This is the centralized hub for everything I want to share.",
    null,
    'https://github.com/yiays/YiaysCom',
    'https://yiays.com/blog/a-history-of-my-websites/'
  ),

  new Project(
    'meme',
    "MemeDB",
    "/img/memedb.svg",
    [
      "meme1.webp" => "List of all of the most recently added memes",
      "meme2.webp" => "The interactive meme editor for authenticated users"
    ],
    "NextJS and MongoDB (coming soon)",
    "Database and Web (mobile friendly)",
    "Pending rewrite",
    "A massive database of memes with crowd-sourced metadata, making for one of the best places on the web to search for memes.",
    "https://meme.yiays.com/",
    "https://github.com/TeamMemeDB/",
    "https://yiays.com/blog/github-activity-summary-2020/"
  ),

  new Project(
    'cb',
    "ConfessionBot",
    "/img/cb.svg",
    [
      "cb.webp" => "An anonymous message sent through ConfessionBot"
    ],
    "Python",
    "Discord",
    "~25,000 Discord Guilds",
    "ConfessionBot adds anonymous messaging to Discord, being used by thousands of Discord servers, ConfessionBot is powered by my Merely framework.",
    "https://top.gg/bot/562440687363293195",
    "https://github.com/yiays/ConfessionBot/",
    "https://yiays.com/blog/confession-bot-a-side-project/"
  ),

  new Project(
    'autologout',
    "AutoLogout",
    "/img/genericwhite.svg",
    [],
    "Typescript, C#",
    "Windows, Android",
    "Public beta",
    "AutoLogout adds downtime and screentime limits to Windows computers, plus a way to change settings remotely with an Android app.",
    "https://autologout.yiays.com",
    "https://github.com/yiays/AutoLogout/",
  ),

  new Project(
    'merely-music',
    "Merely Music",
    "/img/merely-purple.svg",
    [
      "merelymusic2.webp" => "Welcome screen for Merely Music, shows you are signed in as yiays",
      "merelymusic1.webp" => "The about screen for Merely Music, shows the version number",
      "merelymusic3.webp" => "The downloads screen for Merely Music"
    ],
    "Typescript",
    "Expo (Android, iOS, web)",
    "pre-alpha",
    "Merely Music enables you to sync your music, playlists, and metadata wherever you go, with selective offline syncing available.",
    "https://merely.yiays.com/music/",
    "https://github.com/MerelyServices/Merely-Music/"
  ),

  new Project(
    'merely',
    "MerelyBot",
    "/img/merely.svg",
    [
      "merely1.webp" => "Help command from merelybot in Discord",
      "merely2.webp" => "Merelybot website with video tutorials"
    ],
    "Python and Javascript",
    "Discord and Web (mobile friendly)",
    "~60 Discord guilds",
    "Merely is a framework for discord bots written atop of disnake (a fork of Discord.py) which implements advanced features like module reloading and translation. MerelyBot is an example implementation.",
    "https://merely.yiays.com/",
    "https://github.com/MerelyServices/Merely-Framework"
  ),

  new Project(
    'smartboard',
    "Smartboard Games",
    '/img/genericpurple.svg',
    [
      "whiteboard1.webp" => "List of games, can be filtered by subject",
      "whiteboard2.webp" => "Focused mobile, tablet, and smartboard friendly interface",
      "whiteboard3.webp" => "A variety of games, challenging students with different subjects"
      //TODO: add a screenshot about leaderboards
    ],
    "Javascript",
    "Web (mobile and smartboard friendly)",
    "~30 Monthly Visits",
    "A collection of educational games for use in and out of classroom environments. Features leaderboards and badges.",
    "https://games.yiays.com",
    "https://github.com/yiays/Smartboard-Games",
    "https://yiays.com/blog/github-activity-summary-2022/"
  ),

  new Project(
    'translator',
    "Babel Translator",
    '/img/genericwhite.svg',
    [
      "babel-translator.webp" => "Landing page for the translator GUI"
    ],
    "Javascript",
    "Web (PWA)",
    "~4 Volunteer Translators",
    "Provides tools to help translators work with my Babel language format. If you install the PWA, it works offline, too.",
    "https://translate.yiays.com",
    "https://github.com/yiays/Babel-Translator",
    "https://yiays.com/blog/github-activity-summary-2022/"
  ),

  new Project(
    'pukeko',
    "PukekoHost",
    "/img/pukeko.svg",
    [
      "pukeko1.webp" => "Landing page for PukekoHost, lists all supported games and features",
      "pukeko2.webp" => "Service tiers and pricing picker for a Minecraft server",
      "pukeko3.webp" => "Dashboard for customers to manage their servers"
    ],
    "PHP, MySQL, Javascript (optional), and Python",
    "Database, Discord, Web (mobile friendly), and UWP",
    "Inactive",
    "Pukekohost is crowd-funded game server hosting as a service. An experimental new business model which we might launch one day.",
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
      "wipeout1.webp" => "Landing page with video background",
      "wipeout2.webp" => "Information tab for a specific game"
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