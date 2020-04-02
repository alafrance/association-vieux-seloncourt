<?php
$this->css = "base";
$this->title = $article->getTitle();
?>

<section>
    <h1><?= $article->getTitle(); ?></h1>
    <p><?= $article->getContent();?></p>
    <p><?= $article->getAuthor();?></p>
    <p> Crée le <?= $article->getDate();?></p>
    <p>Catégorie : <?= $article->getCategory();?></p>
</section>