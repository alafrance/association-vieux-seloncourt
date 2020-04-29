<?php
    $this->css = 'articles';
    $this->title = 'Actualités';
?>

<section class="container">
    <h1 class="center">Tous les articles</h1>
    <div class="articles">
        <?php foreach ($articles as $article){ ?>
            <article class="center">
                <h2><?= htmlspecialchars($article->getTitle());?></h2>
                <p class="category"> Catégorie : <?= $article->getCategory();?></p>
                <a href="index.php?route=article&id=<?=$article->getId(); ?>"><img src='img/articles/<?= $article->getImage();?>' alt= 'Image correspondant à $article->getTitle()' class="col-xl-9"></a>
                <div>
                    <p><?= substr(strip_tags($article->getContent()), 0, 700) ?>...</p>
                    <a href="index.php?route=article&id=<?=$article->getId(); ?>" class="button dark">Lire plus</a>
                </div>

            </article>
        <?php } ?>
    </div>
</section>
<aside>
    <h2 class="center">Catégories</h2>
    <?php foreach($categories as $category){ ?>
        <h3><a href='index.php?route=category&id=<?= $category->getId();?>'><?= $category->getName(); ?></a></h3>
    <?php foreach ($articles as $article){
        if ($article->getCategory() == $category->getName()){ ?>
        <p><a href='index.php?route=article&id=<?= $article->getId();?>'><?= $article->getTitle();?></a></p>
    <?php
            }
        }
    }
    ?>
</aside>
