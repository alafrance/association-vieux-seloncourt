<?php
$this->css = 'profile';
$this->title = "Page profil";
$role = $this->session->get('role');
?>





<!-- Page de profil commune -->
<section class="center">
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
    <h1 class="center title">Bienvenue sur votre page de profil</h1>
    <p>Vous pouvez voir ici vos informations :</p>
    <ul>
        <li>Nom : <?= $this->session->get("name") ?></li>
        <li>Email : <?= $this->session->get("email") ?></li>
        <li>Avatar : Pas encore d'avatar</li>
        <li>Mot de passe : ********</li>
    </ul>
    <p>Pour changer ses informations, accéder à votre <a href="index.php?route=setting">paramètre</a></p>
    <?php if ($role != 'author' && $role != 'admin'){?>
    <p>Grâce à votre inscription, vous pouvez ajouter des commentaires !</p>
    <?php }?>
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