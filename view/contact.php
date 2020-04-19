<?php
    $this->css = 'contact';
    $this->title = 'Contact'
?>

<section>
    <h1 class="center">Contactez nous !</h1>
<div class="container-fluid contact">
    <div class="row">
        <div class="info center col-xl-6">
            <address class="flex-center">
                <p>Adresse<br> Espace de sauvegarde Charles Kieffer, 6 rue d'Audincourt</p>
                <p>Télephone<br>  03 81 34 71 87</p>
                <p>Email<br> francois.hegwein@sfr.fr</p>
                <p>Horaire Ouverture<br> Mercredi de 14h et 17h et à la demande</p>
            </address>
        </div>
        <div class="form flex-center col-xl-6">
            <h2>Ou contacte nous directement ici</h2>
            <form action='index.php?route=contactMail' method='post' class="formulaire">
                <label for="prenom">Votre prénom</label>
                <input type="text" name="prenom" id="prenom">

                <label for="nom">Votre nom</label>
                <input type="text" name="nom" id="nom">

                <label for="email">Votre mail</label>
                <input type="email" name="email" id="email">

                <label for="message">Ton message</label>
                <textarea name="message" id="message"></textarea>

                <input type="submit" name="submit" value="Envoyer">
            </form>
        </div>
    </div>

</div>
</section>