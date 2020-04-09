<?php
$this->css = 'update';
$this->title = "Changer paramètre";
?>
<section>
    <h1>vous Voulez modifier votre nom, autre qu'à la mairie et uniquement sur ce site ? C'est ici :</h1>
    <form action="index.php?route=updateName" method="post">
        <label for="name">Nouveau nom :</label>
        <input type="text" name="name" id="name">

        <input type="submit" value="Changer de nom" name="submit">
    </form>
</section>
