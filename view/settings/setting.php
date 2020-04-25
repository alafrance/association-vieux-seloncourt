<?php
$this->css = 'littlePage';
$this->title = "Paramètre";
?>
<section>
    <hr class="sep category" data-symbol="Paramètre:">
    <div class="all container-fluid">
        <h1 class="setting uppercase">Changer :</h1>
        <ul class="iota">
            <li><a href="index.php?route=updatePassword" class="btn btn-secondary">Mot de passe</a></li>
            <li><a href="index.php?route=updateEmail" class="btn btn-secondary">Email</a></li>
            <li><a href="index.php?route=updateName" class="btn btn-secondary">Nom</a></li>
        </ul>
        <hr>
        <ul class="iota">
            <li><a href="index.php?route=logout" class="btn btn-secondary">Se déconnecter</a></li>
        </ul>
        <ul class="iota">
            <li><a href="index.php?route=profile" class="btn btn-secondary">Retourner sur la page de profil</a></li>
        </ul>
        <ul class="iota">
            <li><a href="index.php?route=deleteAccount" class="btn btn-tertiary">Supprimer son compte</a></li>
        </ul>
    </div>
</section>
