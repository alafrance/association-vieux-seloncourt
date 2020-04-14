<?php
$this->css = 'home';
$this->title = 'Accueil';
?>
<?= $this->session->show('logout');?>
<header class="slider flex-center">
    <div class="flex-center top">
        <h1>Les Amis du Vieux Seloncourt</h1>
        <p>Association sur la sauvegarde du patrimoine historique et culturel de Seloncourt </p>
        <div>
            <a href="#description" class="button first">Qui sommes nous ?</a>
            <a href="index.php?route=contact" class="button">Nous contacter</a>
        </div>
    </div>
    <img src="img/home/tvh.jpg"></img>
</header>

<section class="description flex-center" id="description">
    <h1 class="underline">Notre mission</h1>
    <img src="img/home/espace_kieffer-black.jpg">
    <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
    </p>
</section>
<section class='articles container-fluid'>
    <h1 class="center underline">Les derniers articles</h1>
    <div class="row">

<?php
    foreach($articles as $article){
?>
            <article class="col-xl-4 col-sm-6 col-lg-4 col-md-6">
                <a href="index.php?route=article&id=<?= $article->getId();?>" id="linkArticle">
                    <img src='img/articles/<?=$article->getImage()?>' alt='Image Article <?= $article->getTitle();?>'>
                    <h2 class="underline"><?= $article->getTitle();?></h2>
                    <button class="btn btn-black"><?= $article->getCategory();?></button>
                    <p><?= substr(strip_tags($article->getContent()), 0, 400) ?></p>
                </a>
            </article>
<?php
    }
?>
    </div>

</section>

<?php if ($exposition->getImage() != NULL && $exposition->getTitle() != NULL && $exposition->getContent() != NULL){?>
<section class="exposition flex-center container-fluid">
    <h1 class="underline titleExposition">Derniere Exposition</h1>
    <p class="introExposition">L'exposition nous tient très à coeur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet vero asperiores provident magni distinctio itaque saepe eos ratione. In fuga delectus eum consequuntur voluptatibus laboriosam molestiae enim ipsam dolorem aliquid?</p>
    <div class="row">
        <img src="img/articles/<?= $exposition->getImage()?>" alt="Image dernière exposition" class="col-xl-6">
        <div class="col-xl-6 flex-center center">
            <h2 class=""><?= $exposition->getTitle()?></h2>
            <p><?= substr(strip_tags($exposition->getContent()), 0, 500)?></p>
            <a href="index.php?route=article&id=<?= $exposition->getId();?>">Voir l'exposition en entier</a>
        </div>
    </div>
    
</section>
<?php }?>

<?php if ($assembly->getDate() != NULL && $assembly->getPlace() != NULL && $assembly->getTime() != NULL){?>
    <section class="center">
        <h1>Assemblée Générale Prévu !</h1>
        <img src="img/home/assembly.jpg" alt="Assemblée Générale">
        <p>Horaire: <?= $assembly->getDate();?> à <?= $assembly->getTime()?> </p>
        <p>Lieu: <?= $assembly->getPlace();?></p>
        <?php if (!empty($assembly->getContent())){?>
        <p>P.S. : <?= $assembly->getContent();?></p>
        <?php }?>
    </section>
<?php }?>