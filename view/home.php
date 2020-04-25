<?php
$this->css = 'home';
$this->title = 'Accueil';
?>
<?= $this->session->showAlert('logout', 'normal');?>
<header class="slider flex-center">
    <nav class="navbar">
        <img src="img/logo.png" alt="logo les Amis du Vieux Seloncourt" class="logo">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?route=articles">Articles</a></li>
            <li><a href="index.php?route=contact">Contact</a></li>
        <?php if (isset($_SESSION['name'])){ ?>
            <li><a href="index.php?route=profile">Profil</a></li>
        <?php }else{ ?>
            <li><a href="index.php?route=login">Se connecter</a></li>
        <?php  } ?>
        </ul>
    </nav>


    <div class="flex-center top">
        <h1>Les Amis du Vieux Seloncourt</h1>
        <p>Association de sauvegarde du patrimoine historique, culturel et cultuel de Seloncourt</p>
        <div>
            <a href="#description" class="button light first">Qui sommes nous ?</a>
            <a href="index.php?route=contact" class="button light">Nous contacter</a>
        </div>
    </div>
    <img src="img/home/tvh.jpg" class="fond"></img>
</header>

<?php if (!empty($date->getId())){?>
    <section class="date container-fluid">
        <h1 class="center uppercase underline">Date à venir:</h1>
        <img src="img/home/old_book.jpg" alt="Image d'un vieux livre">
        <p class="center"><?= $date->getTitle()?> : le <?= $date->getDate();?> à <?=$date->getPlace(); ?> </p>
        <?php if (!empty($date->getContent())){?>
            <p class='underline'>Informations :</p>
            <?= $date->getContent()?>
        <?php }?>

    </section>
    <hr class="home">
<?php }?>
<section class="description container-fluid center" id="description">
    <h1 class="underline">Qui sommes nous ?</h1>
    <div class="row">
        <figure class="col-xl-5 col-lg-6 col-md-6 ">
            <img src="img/home/espace_kieffer_2_black.jpg" class="">
            <figcaption>Nos locaux à Seloncourt</figcaption>
        </figure>
        <div class="col-xl-7 col-lg-6 col-md-6 flex-center">
            <p>
                La création de  l’association de sauvegarde du patrimoine historique, culturel et cultuel, « les Amis du vieux Seloncourt » en 1984 est liée à l’histoire de la vieille église de la commune.<br>
                A cette époque, l’édifice, dont les parties anciennes datent du XIIe siècle, nécessitait des travaux importants, notamment la mise hors d’eau de la toiture et du clocher.<br>
                Cette restauration ne pouvant être assurée par la paroisse, propriétaire de l'édifice, quelques bénévoles se rassembleèrent pour créer l’association et assurer la renovation de la vieille église de 1985 à 1992.<br>
                10 ans après,  l’association ouvre l’espace « Charles Kieffer » consacré à la sauvegarde des traditions et de l’horlogerie, en hommage à un des membres fondateurs de l’association<br>
                Outre la rénovation de la vieille église, l’association a entrepris de nombreuses campagnes de sauvegarde. Citons par exemple la restauration du cimetière des Chevaliers de Cléric (1988) et celle de la vieille fontaine (1990).<br>
                En 1991, les Amis du vieux Seloncourt ont reconstitué une copie du tramway de la vallée d’Hérimoncourt (TVH) qui circula dans de nombreuses manifestations notamment pour commémorer le dernier voyage de ce moyen de transport (1932).<br>
                Pour signaler les lieux historiques de Seloncourt, l’association appose depuis 1993 de nombreuses plaques : vieille église, église Saint-Laurent, chapelle de tolérance, fonderie Cuvier, centre culturel de la Stauberie,<br>
                ancienne poste, station du TVH… En 2012, elle a participé à la restauration des orgues du temple de Seloncourt.
            </p>
            <div>
                <a href="index.php?route=contact" class="button dark first">En savoir plus sur nous</a>
                <a href="index.php?route=contact#contact" class="button dark first">Nous contacter</a>
            </div>
        </div>
    </div>
</section>

<hr>
<?php if ($exposition->getImage() != NULL && $exposition->getTitle() != NULL && $exposition->getContent() != NULL){?>
<section class="exposition flex-center container-fluid">
    <h1 class="underline center">Derniere Exposition : <?= $exposition->getTitle()?></h1>
    <p class="content center "><?= substr(strip_tags($exposition->getContent(), '<br>'), 0, 600) ?>...</p>
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
            <article class="col-xl-4 col-sm-12 col-lg-4 col-md-12">
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
    <div class="footer">
        <p>Pour voir tous nos articles : </p>
        <a href="index.php?route=articles" class="button dark">cliquer ici pour accéder à tous nos articles et expositions</a>
    </div>

</section>
<hr>

