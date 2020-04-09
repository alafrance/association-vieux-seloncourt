<?php
$this->css = 'profile';
$this->title = "Page profil";
$role = $this->session->get('role');
?>

<?= $this->session->show('modify'); ?>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('add_assembly'); ?>
<?= $this->session->show('edit_article'); ?>
<?= $this->session->show('edit_name'); ?>
<?= $this->session->show('edit_email'); ?>
<?= $this->session->show('edit_password'); ?>
<?= $this->session->show('delete_article'); ?>
<?= $this->session->show('delete_assembly'); ?>
<?= $this->session->show('change_right'); ?>



<!-- Page de profil commune -->
<section>
    <h1>Bienvenue sur le profil de <?= $this->session->get('name'); ?></h1>
    <p>Voici vos informations :</p>
    <ul>
        <li>Nom : <?= $this->session->get("name") ?></li>
        <li>Email : <?= $this->session->get("email") ?></li>
        <li>Avatar : Pas encore d'avatar</li>
        <li>Mot de passe : ********</li>
    </ul>
    <p>Pour changer ses informations, accéder à votre <a href="index.php?route=setting">paramètre</a></p>
</section>

<!-- Page de profil auteur -->
<?php
    if($role === 'author'){
        require 'administration/author.php';
    }
?>
<!-- Page de profil administrateur -->
<?php
    if($role === 'admin'){
        require 'administration/admin.php';
    }
?>
<a href="index.php?route=logout" class="logout">Se déconnecter</a>