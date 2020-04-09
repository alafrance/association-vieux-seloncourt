<?php
$this->css = 'update';
$this->title = "Changer paramètre";
?>
<section>
    <h1>Pour modifier son email, veuillez remplir ce formulaire:</h1>
    <form action="index.php?route=updateEmail" method="post">
        <label for="email">Nouveau mail :</label>
        <input type="text" name="email" id="email">
        <?= isset($errors['email']) ? $errors['email'] : '' ?>
        <?= isset($errors['alreadyExist']) ? $errors['alreadyExist'] : '' ?>
        <input type="submit" value="Modifier son email" name="submit">
    </form>
</section>