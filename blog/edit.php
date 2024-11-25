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
  //assert($user instanceof passport\User);
  $article = new Article(
    author: $user->username,
    title: str_replace('-', ' ', ucfirst($params[2])),
    urlid: $params[2],
    tags: [],
    img: 'default.svg',
    col: '004461',
    date: new DateTime(),
    editdate: null,
    hidden: true
  );
  $article->content = 'Click here to edit the article content.';
}else{
  if($article->hidden && (!$user || !$user->username == 'yiays')) {
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
  $article->content = $_POST['contenthtml'];
  $article->save();
  http_response_code(403);
  header("location: /blog/$article->urlid");
}

$title = "Editing ".$article->title;
$desc = strip_tags($ParseDown->text(explode("\n", $article->content)[0]));
$keywords = implode(', ', $article->tags);
$image = "https://cdn.yiays.com/blog/$article->img";
require($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');

?>
<form method="POST" enctype="multipart/form-data">
  <article class="post post-editable">
    <div class="post-header hero" id="postcolor" style="background:#<?php echo $article->col; ?>;">
      <div class="flex-row" style="flex-wrap:nowrap;">
        <h2 style="max-width:min(30rem,60vw);">
          <input type="text" name="title" placeholder="Title" required value="<?php echo htmlspecialchars($article->title); ?>">
        </h2>
        <?php echo userpreview($user); ?>
      </div>
      <span class="dim"><?php echo "By ".$article->author.", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':''); ?></span>
      <br><input type="text" name="tags" placeholder="Tags" value="<?php echo htmlspecialchars(implode(', ', $article->tags)); ?>">
      <br><label for="color">Colour:</label>
      <input type="color" id="color" name="color" required value="#<?php echo $article->col; ?>">
      <br><label for="cover">Cover image:</label>
      <input type="file" name="cover" id="cover" accept=".jpg,.jpeg,.png,.webp,.svg" value="<?php echo $article->img; ?>">
      <br>
      <div class="flex-row">
        <label for="hidden">Hidden:</label>&nbsp;
        <input type="checkbox" id="hidden" name="hidden" <?php echo ($article->hidden?'checked':''); ?>>
        <input type="submit" id="save" class="btn" style="margin-left:auto;" value="<?php echo ($article->hidden?'Save':'Publish'); ?>">
      </div>
      <img alt="<?php echo htmlspecialchars($article->title); ?> cover art" id="postcover" src="https://cdn.yiays.com/blog/<?php echo $article->img; ?>">
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