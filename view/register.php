<?php
    $this->css = 'register';
    $this->title = 'Page d\'inscription';
?>

<section class="register flex-center">
    <h1 class="center">Créer un compte :</h1>
    <form action="index.php?route=register" method="post">
        <label for="name">Ton prénom et nom :</label>
        <input type="text" name="name" id="name" value="<?= isset($post) ? htmlspecialchars($post->get('name')): ''; ?>">
        <?= isset($errors['name']) ? $errors['name'] : '';?>

        <label for="email">Ton addresse mail :</label>
        <input type="email" name="email" id="email" value="<?= isset($post) ? htmlspecialchars($post->get('email')): ''; ?>">
        <?= isset($errors['email']) ? $errors['email'] : '';?>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" >
        <?= isset($errors['password']) ? $errors['password'] : '';?>

        <label for="password2">Confirmer son mot de passe:</label>
        <input type="password" name="password2" id="password2" >
        <?= isset($errors['password']) ? $errors['password'] : '';?>

        <input type="submit" value="Créer un compte" name="submit">
    </form>
    <h2>Vous avez déja un compte ?</h2>
    <a href="index.php?route=login">Se connecter</a>
</section>

