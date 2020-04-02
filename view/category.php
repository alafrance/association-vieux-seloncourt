<?php
$this->css = 'base';
$this->title = $category;
?>
<section>
    <?php foreach($articles as $article){?>
        <article>
            <h2><?= htmlspecialchars($article->getTitle());?></h2>
            <p><?= substr(strip_tags($article->getContent()), 0, 100);?></p>
            <a href="index.php?route=article&id=<?=$article->getId(); ?>">Lire plus</a>
            <p>Crée :<br>
            le : <?= htmlspecialchars($article->getDate());?><br>
            par : <?= htmlspecialchars($article->getAuthor());?>
            </p>
            <p>Catégorie : <?= $article->getCategory();?></p>
        </article>
    <?php }?>
</section>