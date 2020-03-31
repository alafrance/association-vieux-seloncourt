<?php
    $this->css = 'login';
    $this->title = 'Page de connexion';
?>

<section class="login flex-center">
<?= $this->session->showAlert('error_login', 'error');?>
<?= $this->session->showAlert('need_login', 'error');?>
    <h1 class="center">Connecter vous :</h1>
    <form action="index.php?route=login" method="post">

        <label for="email">Ton addresse mail</label>
        <input type="email" name="email" id="email">

        <label for="password">Ton mot de passe</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Se connecter" name="submit">
    </form>
    <h2>Vous n'avez pas de compte ?</h2>
    <a href="index.php?route=register">Créer un compte</a>
</section>
