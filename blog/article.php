<?php
$article = fetch_article($params[2]);
$article?->fetch_content();

$edit = false;
if(count($params) > 3) {
  if($params[3] == 'edit') {
    if($user && $user->username == 'yiays') {
      $edit = true;
    }else{
      http_response_code(403);
      die('Failed to verify you as an administrator.');
    }
  }elseif($params[3] != '') {
    http_response_code(404);
    die();
  }
}

if($edit) {
  require('edit.php');
} else {
  if(is_null($article)) {
    http_response_code(404);
    die();
  }else{
    if($article->hidden && (!$user || !$user->username == 'yiays')) {
      http_response_code(404);
      die();
    }
  }

  $title = $article->title;
  $content = $ParseDown->text($article->content);
  # Add IDs to all post headings
  preg_match_all('/<(h[123456])>(.*)<\/h[123456]>/U', $content, $headings);
  $norepeatid = [];
  for($i=0; $i<count($headings[0]); $i++) {
    $headingid = preg_replace('/-+/', '-', preg_replace('/[^a-z0-9]/', '-', strtolower($headings[2][$i])));
    if(array_search($headingid, $norepeatid)) continue;
    $content = str_replace($headings[0][$i], "<{$headings[1][$i]} id=\"{$headingid}\">{$headings[2][$i]}</{$headings[1][$i]}>", $content);
    $norepeatid[]=$headingid;
  }
  $desc = strip_tags($ParseDown->text(explode("\n", $content)[0]));
  $keywords = implode(', ', $article->tags);
  $image = "https://cdn.yiays.com/blog/$article->img";
  require($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
  
  $article->view();
  print("
    <article class=\"post".($article->hidden?' dim':'')."\">
      <div class=\"post-header hero\" style=\"background:#$article->col;\">
        <div class=\"flex-row\" style=\"flex-wrap:nowrap;\">
          <h2 style=\"flex-grow:1;\">
            $article->title
            ".($user&&$user->username=='yiays'?"<a class=\"btn\" href=\"/blog/$article->urlid/edit\">Edit</a>":'')."
          </h2>
          ".userpreview($user, true)."
        </div>
        <span class=\"dim\">By ".$article->author.", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':'')."</span>
        <br><span>".implode(', ', $article->tags)."</span> | ".number_format($article->views)." Views
        <img alt=\"".htmlspecialchars($article->title)." cover art\" src=\"https://cdn.yiays.com/blog/$article->img\">
      </div>
      <div class=\"post-content\">
        ".$content."
      </div>
    </article>
  ");
  ?>
  <aside>
    <h2>Related articles</h2>
    <div class="x-scroller">
      <div class="carousel">
        <?php
        usort($articles, function($a, $b) {
          global $article;
          return count(array_intersect($article->tags, $b->tags)) - count(array_intersect($article->tags, $a->tags));
        });
        $i = 0;
        foreach($articles as $relatedarticle) {
          if(!$relatedarticle->hidden && $relatedarticle->urlid!=$article->urlid) {
            print($relatedarticle->preview());
            if($i++ == 3) {
              break;
            }
          }
        }?>
      </div>
    </div>
  </aside>
<?php
}
require($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');
?>