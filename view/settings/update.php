<?php
$this->css = 'update';
$this->title = "Changer paramètre";
?>
<?php
    if ($param === 'password'){
?>
        <section>
            <h1>Pour modifier son mot de passe, veuillez remplir ce formulaire:</h1>
            <form action="index.php?route=modifyParameter&param=password" method="post">
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
<?php
    }else if($param === 'email'){
?>
        <section>
            <h1>Pour modifier son email, veuillez remplir ce formulaire:</h1>
            <form action="index.php?route=modifyParameter&param=email" method="post">
                <label for="email">Nouveau mail :</label>
                <input type="text" name="email" id="email">
                <?= isset($errors['email']) ? $errors['email'] : '' ?>
                <?= isset($errors['alreadyExist']) ? $errors['alreadyExist'] : '' ?>
                <input type="submit" value="Modifier son email" name="submit">
            </form>
        </section>
<?php
    }else if($param === 'name'){
?>
        <section>
            <h1>vous Voulez modifier votre nom, autre qu'à la mairie et uniquement sur ce site ? C'est ici :</h1>
            <form action="index.php?route=modifyParameter&param=name" method="post">
                <label for="name">Nouveau nom :</label>
                <input type="text" name="name" id="name">

                <input type="submit" value="Changer de nom" name="submit">
            </form>
        </section>
<?php
    }else if($param === 'deleteAccount'){
?>
        <section>
            <h1>Etre vous sur de vouloir supprimer votre compte ? Ceci est DEFINITIF !</h1>
            <form action="index.php?route=deleteAccount" method="post">
                <div>
                    <input type="radio" name="deleteAccount" id='notDeleteAccount' value="no">
                    <label for="notDeleteAccount">NON, je ne veux surtout pas supprimer mon compte</label>
                </div>

                <div>
                    <input type="radio" name="deleteAccount" id="deleteAccount" value="yes">
                    <label for="deleteAccount">Oui, je veux supprimer mon compte</label>
                </div>

                <input type="submit" value="Suppresion" name="submit">
            </form>
            <h2>Retourner à la page de profil</h2>
            <a href="index.php?route=profile">Page de profil</a>
        </section>
<?php
    }else{
?>
    <h1>Erreur ! vous n'avez choisi aucun paramètre. Veuillez retourner sur la page de profil.</h1>
    <a href="index.php?route=profile">Retour page de profil</a>
<?php
    }
