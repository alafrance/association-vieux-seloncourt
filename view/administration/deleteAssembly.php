<?php
$this->title = "Supprimer  un article";
$this->css = "administration";
?>
<section>
        <form action="index.php?route=deleteAssembly" method="post">
                <input type="hidden" name="id" value="<?= $id?>">
                <div>
                    <input type="radio" name="deleteAccount" id='notDeleteAccount' value="no">
                    <label for="notDeleteAccount">NON, Je ne veux pas supprimer l'assemblée Générale</label>
                </div>

                <div>
                    <input type="radio" name="deleteAccount" id="deleteAccount" value="yes">
                    <label for="deleteAccount">Oui, je veux supprimer les informations relatives à l'Assemblée Générale</label>
                </div>

                <input type="submit" value="Suppresion" name="submit">
            </form>
            <a href="index.php?route=profile">Retourner à la page de profil</a>
</section>