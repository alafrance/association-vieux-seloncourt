<?php
    $this->css = 'base';
    $this->title = 'Changer les droits';
?>

<section>
    <h1>Quels droits voulez vous accorder à <?= $user->getName();?></h1>
    <div>
        <h2>Informations :</h2>
        <p>
            Administrateur : Il possède tous les droits. Il peut ajouter un article, modifier n'importe quel article, et aussi le supprimer. Il a aussi le droit de modifier l'Assemblée Générale.<br>
            Il peut aussi voir tous les commentaires signalés et utilisateurs sur le site.
            On ne peut supprimer son compte.<br>
            Vous devez être certain en lui donnant ces droits à cette personne.
        </p>
        <p>
            Auteur : Il peut ajouter un article. Il peut aussi modifier et supprimer ces propres articles, et modifier l'Assemblée Générale.<br>
            On ne peut supprimer son compte.<br>
            Vous devez être certain en lui donnant ces droits à cette personne.
        </p>
    </div>
    <form action="index.php?route=right&userId=<?= $userId?>" method="post">
        <label for="right"></label>
        <select name="right">
            <option value="">Veuillez séléctionnez un droit :</option>
            <option value="1">Administrateur</option>
            <option value="3">Auteur</option>
        </select>
        <input type="submit" value="Attribuer" name="submit">

    </form>
</section>