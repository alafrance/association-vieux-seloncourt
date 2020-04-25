<?php
$this->css = 'articles';
$this->title = $category;
?>


<section class="container">
    <h1 class="center underline"><?= $category ?></h1>
    <div class="row">
        <div class="col-xl-9 col-lg-9 articles">
    <?php foreach ($articles as $article){ ?>
        <article class="center">
            <h2><?= htmlspecialchars($article->getTitle());?></h2>
            <p class="category"> Catégorie : <?= $article->getCategory();?></p>
            <a href="index.php?route=article&id=<?=$article->getId(); ?>"><img src='img/articles/<?= $article->getImage();?>' alt= 'Image correspondant à <?=$article->getTitle() ?>' class="col-xl-9"></a>
            <div>
                <p><?= substr(strip_tags($article->getContent()), 0, 700) ?>...</p>
                <a href="index.php?route=article&id=<?=$article->getId(); ?>" class="button dark">Lire plus</a>
            </div>
        </article>
    <?php } ?>
        </div>
        <aside class="col-xl-2 col-lg-2">
            <h2 class="center underline">Catégorie :</h2>
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
            <h3><a href="index.php">Accueil</a></h3>
            <h3><a href="index.php?route=contact">Contact</a></h3>
        </aside>
    </div>
</section>