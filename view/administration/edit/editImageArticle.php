<?php
$this->css = 'administration';
$this->title = 'Modification image Article';
?>
<section>
    <h1>Vous voulez modifier l'image de l'article <?= $article->getTitle(); ?> ?</h1>
    <p>Ancienne image :</p>
    <img src="img/articles/<?= $article->getImage();?>" class="imgPreview"></img>
    <p>Nouvelle image :</p>
    <div id='preview-file'></div>

    <form action="index.php?route=editImageArticle&id=<?= $articleId ?>" method='post' enctype="multipart/form-data" class="changeImg">
        <input type="file" name="image">
        <input type="submit" value="Changer" name="submit">
    </form>
    <?= isset($errors) ? $errors : '';?>

</section>
