<?php
// Post editor image upload
if(array_key_exists('upload', $_GET)) {
  $file = $_FILES['upload'];
  $filename = $file['name'];
  if(str_starts_with($filename, 'image.')) {
    $datetime = new DateTime();
    $filename = "screenshot_".$datetime->format('Y-m-d_G:i.s');
  }
  $dest = '../cdn/blog/src/';
  handlepostfileupload($file, $dest.$filename);
  converttowebp($dest, $filename);
  header('content-type: application/json');
  die(json_encode(['url'=>"https://cdn.yiays.com/blog/".urlencode($filename)]));
}

if(is_null($article)) {
  assert($user instanceof passport\User);
  $article = new Article();
  $article->id = -1;
  $article->author = new Author();
  $article->author->id = $user->id;
  $article->author->username = $user->username;
  $article->title = str_replace('-', ' ', ucfirst($params[2]));
  $article->urlid = $params[2];
  $article->tags = [];
  $article->img = 'default.svg';
  $article->col = '004461';
  $article->date = new DateTime();
  $article->editdate = null;
  $article->content = 'Click here to edit the article content.';
  $article->hidden = true;
}else{
  if($article->hidden && (!$user || !$user->admin)) {
    http_response_code(404);
    die();
  }
}

// Submit handler
if($edit && array_key_exists('title', $_POST) && array_key_exists('color', $_POST) && array_key_exists('contenthtml', $_POST)) {
  $article->title = $_POST['title'];
  if(array_key_exists('tags', $_POST)) $article->tags = explode(', ',$_POST['tags']);
  if(array_key_exists('cover', $_FILES) && $_FILES['cover']['size'] > 0) {
    $file = $_FILES['cover'];
    $filename = $file['name'];
    $dest = '../cdn/blog/src/';
    handlepostfileupload($file, $dest.$filename);
    converttowebp($dest, $filename);
    $article->img = $filename;
  }
  $article->col = substr($_POST['color'], 1);
  $article->hidden = array_key_exists('hidden', $_POST);
  $article->content = $ParseDown->parse($_POST['contenthtml']);
  # Add IDs to all post headings
  preg_match_all('/<(h[123456])>(.*)<\/h[123456]>/U', $article->content, $headings);
  $norepeatid = [];
  for($i=0; $i<count($headings[0]); $i++) {
    $headingid = preg_replace('/-+/', '-', preg_replace('/[^a-z0-9]/', '-', strtolower($headings[2][$i])));
    if(array_search($headingid, $norepeatid)) continue;
    $article->content = str_replace($headings[0][$i], "<{$headings[1][$i]} id=\"{$headingid}\">{$headings[2][$i]}</{$headings[1][$i]}>", $article->content);
    $norepeatid[]=$headingid;
  }
  $article->save();
  http_response_code(403);
  header("location: /blog/$article->urlid");
  die();
}

$title = "Editing ".$article->title;
$desc = strip_tags($ParseDown->text(explode("\n", $article->content)[0]));
$keywords = implode(', ', $article->tags);
$image = "https://cdn.yiays.com/blog/$article->img";
require($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');

?>
<form method="POST" enctype="multipart/form-data">
  <article class="post post-editable" id="<?php echo $article->id; ?>">
    <div class="post-header" id="postcolor" style="background:#<?php echo $article->col; ?>;">
      <div class="flex-row" style="flex-wrap:nowrap;">
        <h2 style="max-width:min(30rem,60vw);">
          <input type="text" name="title" placeholder="Title" required value="<?php echo htmlspecialchars($article->title); ?>">
        </h2>
        <?php echo userpreview($user); ?>
      </div>
      <span class="dim"><?php echo "By ".$article->author->handle().", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':''); ?></span>
      <br><input type="text" name="tags" placeholder="Tags" value="<?php echo htmlspecialchars(implode(', ', $article->tags)); ?>">
      <br>Colour:
      <input type="color" id="color" name="color" required value="#<?php echo $article->col; ?>">
      <br>Cover image:
      <input type="file" name="cover" id="cover" accept=".jpg,.jpeg,.png,.webp,.svg">
      <br>
      <div class="flex-row">
        <label for="hidden">Hidden:</label>&nbsp;
        <input type="checkbox" id="hidden" name="hidden" <?php echo ($article->hidden?'checked':''); ?>>
        <input type="submit" id="save" class="btn" style="margin-left:auto;" value="<?php echo ($article->hidden?'Save':'Publish'); ?>">
      </div>
      <img alt="<?php echo htmlspecialchars($article->title); ?> cover art" id="postcover" src="https://cdn.yiays.com/blog/<? echo $article->img; ?>">
    </div>
    <input type="hidden" name="contenthtml" id="submitcontent">
    <div class="post-content" id="postcontent"><?php echo $article->content; ?></div>
  </article>
</form>
<script src="https://cdn.yiays.com/ckeditor.js"></script>
<script>
  let editor;
  let postcontent = document.querySelector('#postcontent');
  let submitcontent = document.querySelector('#submitcontent');
  let savebtn = document.querySelector('#save');
  let hiddenchk = document.querySelector('#hidden');
  let colorinp = document.querySelector('#color');
  let post = document.querySelector('#postcolor');
  let coverfs = document.querySelector('#cover');
  let postcover = document.querySelector('#postcover');
  BalloonEditor
    .create(postcontent, {
      simpleUpload: {
        uploadUrl: '?upload'
      }
    })
    .then(newEditor => {editor = newEditor;})
    .catch(error => {
      console.error(error);
    });
  savebtn.addEventListener('click', (e)=>{
    removeEventListener('beforeunload', beforeunload, {capture: true});
    submitcontent.value = editor.getData();
  });
  hiddenchk.addEventListener('input', (e)=>{
    savebtn.value = (hiddenchk.checked==true)?'Save':'Publish';
  });
  colorinp.addEventListener('input', (e)=>{
    post.style.background = colorinp.value;
  });
  coverfs.addEventListener('input', (e)=>{
    if(coverfs.files[0]) postcover.src = URL.createObjectURL(coverfs.files[0]);
  });

  function beforeunload(event) {
    event.preventDefault();
    return event.returnValue = 'You have unsaved changes. Are you sure you want to exit?';
  }

  addEventListener('beforeunload', beforeunload, {capture: true});
</script>