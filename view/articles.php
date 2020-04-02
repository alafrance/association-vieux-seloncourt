<?php
    $this->css = 'base';
    $this->title = 'Actualités';
?>
<section>
<?php foreach ($articles as $article){ ?>
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