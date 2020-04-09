<?php
    $this->css = 'base';
    $this->title = 'Actualités';
?>
<section>
<?php foreach ($articles as $article){ ?>
    <article>
        <h2><?= htmlspecialchars($article->getTitle());?></h2>
        <p>Catégorie : <?= $article->getCategory();?></p>
        <img src='img/articles/<?= $article->getImage();?>' alt= 'Image correspondant à $article->getTitle()'>
        <a href="index.php?route=article&id=<?=$article->getId(); ?>">Lire plus</a>

    </article>
<?php } ?>
</section>
<hr>
<aside>
    <?php foreach($categories as $category){ ?>
        <h2><a href='index.php?route=category&id=<?= $category->getId();?>'><?= $category->getName(); ?></a></h2>
        <?php foreach ($articles as $article){
            if ($article->getCategory() == $category->getName()){ ?>
                <p><a href='index.php?route=article&id=<?= $article->getId();?>'><?= $article->getTitle();?></a></p>
            <?php
            }
     }
    }
    ?>
</aside>