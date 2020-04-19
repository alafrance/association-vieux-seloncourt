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
            <a href="#description" class="button light first">Qui sommes nous ?</a>
            <a href="index.php?route=contact" class="button light">Nous contacter</a>
        </div>
    </div>
    <img src="img/home/tvh.jpg"></img>
</header>

<section class="description container-fluid center" id="description">
    <h1 class="underline">Notre mission</h1>
    <div class="row">
        <figure class="col-xl-5">
            <img src="img/home/espace_kieffer-black.jpg" class="">
            <figcaption>Nos locaux à Seloncourt</figcaption>
        </figure>
        <div class="col-xl-7 flex-center">
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, obcaecati maxime minima minus porro aliquid, sed doloremque omnis neque cumque sit, iste commodi ipsa doloribus vitae accusantium deleniti esse ipsum!
            </p>
        </div>
    </div>
    <div class="footer">
        <p>Pour en savoir plus sur nous,</p>
        <a href="index.php?route=articles" class="button light">cliquer ici pour accéder à tous nos articles et expositions</a>
    </div>
</section>

<hr>
<?php if ($exposition->getImage() != NULL && $exposition->getTitle() != NULL && $exposition->getContent() != NULL){?>
<section class="exposition flex-center container-fluid">
    <h1 class="underline center">Derniere Exposition : <?= $exposition->getTitle()?></h1>
    <p class="content center "><?= substr(strip_tags($exposition->getContent()), 0, 600) ?>...</p>
    <img src="img/articles/<?= $exposition->getImage()?>" alt="Image dernière exposition" class="col-xl-8 center">
    <a href="index.php?route=article&id=<?= $exposition->getId();?>" class="btn btn-gray">Voir l'exposition en entier</a>
</section>
<?php }?>
<hr>
<section class='articles container-fluid'>
    <h1 class="center underline">Les derniers articles</h1>
    <div class="row">

<?php
    foreach($articles as $article){
?>
            <article class="col-xl-4 col-sm-6 col-lg-4 col-md-6">
                <div class="title">
                    <h2 class="underline"><?= $article->getTitle();?></h2>
                </div>
                <a href="index.php?route=article&id=<?= $article->getId();?>">
                    <img src='img/articles/<?=$article->getImage()?>' alt='Image Article <?= $article->getTitle();?>'>
                </a>
                <div class="content">
                    <p><?= substr(strip_tags($article->getContent()), 0, 400) ?>...</p>
                    <a href="index.php?route=article&id=<?= $article->getId();?>" class="btn btn-gray">Lire la suite</a>
                </div>
            </article>
<?php
    }
?>
    </div>

</section>
<hr>

<?php if ($assembly->getDate() != NULL && $assembly->getPlace() != NULL && $assembly->getTime() != NULL){?>
    <section class="container-fluid center assembly">
        <h1>
            Assemblée Générale Prévu le <?= $assembly->getDate();?> à <?= $assembly->getTime()?><br>
            aura lieu à : <?= $assembly->getPlace();?>
        </h1>
        <p></p>
        <?php if (!empty($assembly->getContent())){?>
        <p>P.S :<?= $assembly->getContent();?></p>
        <?php }?>
    </section>
<?php }?>
<p class="explication">Pour plus d'informations veuillez nous <a href="index.php?route=contact">contacter</a></p>
