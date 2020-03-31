<?php
$this->css = 'profile';
$this->title = "Page profil";
?>
<section>
    <h1>Bienvenue sur le profil de <?= $this->session->get('name'); ?></h1>
    <a href="index.php?route=setting">Accéder à ses paramètres</a>
    <p>Voici vos informations :</p>
    <ul>
        <li>Nom : <?= $this->session->get("name")?></li>
        <li>Email : <?= $this->session->get("email")?></li>
        <li>Avatar : Pas encore d'avatar</li>
        <li>Mot de passe : ********</li>
    </ul>
    <p>Pour changer ses informations, accéder à votre <a href="index.php?route=setting">paramètre</a></p>
    <a href="#">Se déconnecter</a>
</section>