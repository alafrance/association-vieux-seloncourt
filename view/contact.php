<?php
    $this->css = 'contact';
    $this->title = 'Contact'
?>
<section>
    <h1 class="center">Membre Association</h1>
    <div class="membre">
        <figure>
            <img src="../public/img/profile.png" alt="Portrait président Association">
            <figcaption>
                <h2>Président</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>Placeat non dolore exercitationem illo rem quod dignissimos cupiditate,<br> labore atque id nam facere! Quis reiciendis<br> rerum, aspernatur quod quaerat harum in.</p>
            </figcaption>
        </figure>
        <figure>
            <img src="../public/img/profile.png" alt="Portrait Secrétaire Association">
            <figcaption>
                <h2>Secrétaire</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>Placeat non dolore exercitationem illo rem quod dignissimos cupiditate,<br> labore atque id nam facere! Quis reiciendis<br> rerum, aspernatur quod quaerat harum in.</p>
            </figcaption>
        </figure>
        <figure>
            <img src="../public/img/profile.png" alt="Portrait Trésoriere Association">
            <figcaption>
                <h2>Trésoriere</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>Placeat non dolore exercitationem illo rem quod dignissimos cupiditate,<br> labore atque id nam facere! Quis reiciendis<br> rerum, aspernatur quod quaerat harum in.</p>
            </figcaption>
        </figure>
        <figure>
            <img src="../public/img/profile.png" alt="Portrait no sabe Association">
            <figcaption>
                <h2>No sabe quien es</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>Placeat non dolore exercitationem illo rem quod dignissimos cupiditate,<br> labore atque id nam facere! Quis reiciendis<br> rerum, aspernatur quod quaerat harum in.</p>
            </figcaption>
        </figure>
    </div>
</section>

<section>
    <h1 class="center">Contactez nous !</h1>
<div class="contact">
    <div class="info center">
        <h2>Information Association</h2>
        <p>Email : francois.hegwein@sfr.fr</p>
        <p>Télephone :  03 81 34 71 87</p>
        <p>Adresse : Espace de sauvegarde Charles Kieffer, 6 rue d'Audincourt</p>
        <p>Ouverture : Mercredi de 14h et 17h et à la demande</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2697.387324662489!2d6.856156516259603!3d47.462881205887285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47921a13779cba75%3A0x227cfaa7638e19b2!2s6%20Rue%20d&#39;Audincourt%2C%2025230%20Seloncourt!5e0!3m2!1sfr!2sfr!4v1585432406833!5m2!1sfr!2sfr" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <div class="form flex-center">
        <h2>Ou contacte nous directement ici</h2>
        <form action='index.php?route=contactMail' method='post'>
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
</section>