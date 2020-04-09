<?php
$this->css = "base";
$this->title = $article->getTitle();
?>

<section>
    <h1><?= $article->getTitle(); ?></h1>
    <img src='img/articles/<?= $article->getImage();?>' alt= 'Image correspondant à $article->getTitle()'>
    <p><?= $article->getContent();?></p>
    <p><?= $article->getAuthor();?></p>
    <p> Crée le <?= $article->getDate();?></p>
    <p>Catégorie : <?= $article->getCategory();?></p>
</section>

<section>
    <h1>Commentaires</h1>
    <?php if(isset($_SESSION['name'])) {?>
        <h2>Ajouter un commentaire :</h2>
        <form action="index.php?route=addComment&articleId=<?= $articleId ?>" method="post">
            <input type="text" name="content">
            <input type="submit" name="submit" value="Ajouter">
        </form>
        <?= isset($errors['content']) ? $errors['content'] : '';?>
    <?php } else{ ?>
        <p>Si vous voulez ajouter un commentaire, veuillez vous <a href="index.php?route=login">connecter</a> ou vous <a href="index.php?route=register">inscrire</a></p>
    <?php  } ?>
    <?php foreach($comments as $comment){ ?>
        <h3><?= $comment->getName(); ?></h3>
        <p><?= $comment->getContent(); ?></p>
        <p>Ecrit le : <?= $comment->getDate(); ?></p>
        <p><?php
            if (isset($_SESSION['name'])){ ?>
            <a href="index.php?route=flagComment&commentId=<?= $comment->getId();?>">Signaler le commentaire</a>
        <?php } ?>
        </p>
    <?php } if (empty($comments)){ ?>
            <p>Aucun commentaire. Soyer le premier à écrire !</p>
    <?php }?>
</section>