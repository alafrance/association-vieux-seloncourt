<?php
$this->title = "Supprimer  un article";
$this->css = "administration";
?>
<section>
        <form action="index.php?route=deleteArticle" method="post">
                <input type="hidden" name="id" value="<?= $id?>">
                <div>
                    <input type="radio" name="deleteAccount" id='notDeleteAccount' value="no">
                    <label for="notDeleteAccount">NON, Je ne veux surtout pas supprimer cet article</label>
                </div>

                <div>
                    <input type="radio" name="deleteAccount" id="deleteAccount" value="yes">
                    <label for="deleteAccount">Oui, je veux supprimer cet article</label>
                </div>

                <input type="submit" value="Suppresion" name="submit">
            </form>
            <a href="index.php?route=profile">Retourner à la page de profil</a>
</section>