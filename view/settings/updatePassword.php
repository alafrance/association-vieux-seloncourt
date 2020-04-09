<?php
$this->css = 'update';
$this->title = "Changer paramètre";
?>
<section>
    <h1>Pour modifier son mot de passe, veuillez remplir ce formulaire:</h1>
    <form action="index.php?route=updatePassword" method="post">
        <label for="oldPassword">Ancien mot de passe :</label>
        <input type="password" name="oldPassword" id="oldPassword">
        <?= isset($errors['passwordIsValid']) ? $errors['passwordIsValid'] : '' ?>

        <label for="newPassword">Nouveau mot de passe :</label>
        <input type="password" name="newPassword" id="newPassword">
        <?= isset($errors['newPassword']) ? $errors['newPassword'] : '' ?>

        <label for="newPassword2">Nouveau mot de passe :</label>
        <input type="password" name="newPassword2" id="newPassword2">
        <?= isset($errors['passwordEgal']) ? $errors['passwordEgal'] : '' ?>

        <input type="submit" value="Modifier mot de passe" name="submit">

    </form>
</section>
