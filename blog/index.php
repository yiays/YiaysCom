<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/router.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/blogdata.php');

$params = explode('/', $url);
if(strlen($params[2])) {
  require('article.php');
}else{
  $title = 'Blog';
  $desc = "I write about my successes and failures as a form of self reflection. Hopefully, these chronicals will help myself and others.";
  $keywords = 'blog, journal, documentation, history';

  require($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');?>
  <article class="hero" style="background:rgb(0, 68, 97);">
    <div class="flex-row" style="flex-wrap:nowrap;">
      <h1 style="flex-grow:1;">Blog</h1>
      <?php echo userpreview($user); ?>
    </div>
    <p>
      I write about my successes and failures as a form of self reflection. Hopefully, these
      chronicals will help myself and others.
    </p>
  </article>
  <?php if($user && $user->username == 'yiays') { ?>
  <hr>
  <section class="flex-row">
    <input type="text" name="articleid" id="articleid" placeholder="new-article">
    <a href="/blog/new-article/edit/" id="new-article" class="btn">New Article</a>
  </section>
  <?php } ?>
  <hr>
  <?php
  $i = 0;
  foreach($articles as $article) {
    if(!$article->hidden || ($user && $user->username == 'yiays')) {
      if($i++ != 0) print('<hr>');
      print($article->preview_wide(boolval($user), $i!=1));
    }
  }
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const input = document.getElementById('articleid');
      const link = document.getElementById('new-article');

      input.addEventListener('input', function() {
          link.href = input.value? `/blog/${input.value}/edit/`: '/blog/new-article/edit/';
      });
    });
  </script>
  <?php
  require($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');
}

function userpreview($user, $edit=null) {
  $result = '<span class="login-status text-center" style="margin-left:auto;">';
  if (!$user) {
    $result .= "Not logged in.
      <br><sub><a href=\"https://passport.yiays.com/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Login with Passport</a>";
  }else{
    $result .= "Logged in as <b>$user->username</b>
      <br><sub>Not you? <a href=\"https://passport.yiays.com/?logout&redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Logout</a>";
  }
  return $result.'</span>';
}
?>