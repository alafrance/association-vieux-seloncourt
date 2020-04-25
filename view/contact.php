<?php
    $this->css = 'contact';
    $this->title = 'Contact'
?>
<section class="information center container">
    <h1>Notre association</h1>
    <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam tenetur et delectus quidem iure, harum quam tempora voluptatum quas facere doloribus atque. Nisi voluptatem, temporibus iusto incidunt placeat vero architecto.
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam tenetur et delectus quidem iure, harum quam tempora voluptatum quas facere doloribus atque. Nisi voluptatem, temporibus iusto incidunt placeat vero architecto.
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam tenetur et delectus quidem iure, harum quam tempora voluptatum quas facere doloribus atque. Nisi voluptatem, temporibus iusto incidunt placeat vero architecto.
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam tenetur et delectus quidem iure, harum quam tempora voluptatum quas facere doloribus atque. Nisi voluptatem, temporibus iusto incidunt placeat vero architecto.
    </p>
    <h2>Notre comité</h2>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda itaque totam cumque, nam aspernatur quos quis omnis harum natus recusandae nihil magni expedita quaerat porro, libero explicabo. Pariatur, reprehenderit consequatur.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda itaque totam cumque, nam aspernatur quos quis omnis harum natus recusandae nihil magni expedita quaerat porro, libero explicabo. Pariatur, reprehenderit consequatur.
    </p>
</section>
<section class="contact">
    <h1 class="center">Contactez nous !</h1>
<div class="container-fluid contact">
    <div class="row">
        <div class="info center col-xl-6 col-lg-6 col-sm-12 col-md-12">
            <address class="flex-center">
                <p>
                    <i class="fas fa-search-location"></i> Adresse<br>
                    <span>Espace de sauvegarde Charles Kieffer, 6 rue d'Audincourt</span>
                </p>
                <p>
                    <i class="fas fa-phone"></i> Télephone<br>
                    <span>06 80 54 53 91</span>
                </p>
                <p>
                    <i class="fas fa-envelope"></i> Email<br>
                    <span>bonnot.nicole@bbox.fr</span>
                </p>
                <p>
                    <i class="fas fa-clock"></i> Horaire Ouverture<br>
                    <span>Mercredi de 14h et 17h et à la demande</span>
                </p>
            </address>
        </div>
        <div class="form col-xl-6 col-lg-6 col-sm-12 col-md-12 flex-center">
            <h2>Ou contacter nous directement ici</h2>
            <form action='index.php?route=contactMail' method='post' class="formulaire">

                <div class="input-field">
                    <input type="text" name="prenom" id="prenom" class="validate">
                    <label for="prenom">Votre prénom</label>
                </div>

                <div class="input-field">
                    <input type="text" name="nom" id="nom">
                    <label for="nom">Votre nom</label>
                </div>

                <div class="input-field">
                    <input type="email" name="email" id="email">
                    <label for="email">Votre mail</label>
                </div>

                <div class="input-field">
                    <textarea name="message" id="message" class="materialize-textarea"></textarea>
                    <label for="message">Votre message</label>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action">
                    Envoyer <i class="fas fa-paper-plane"></i></i>
                </button>
            </form>
        </div>
    </div>

</div>
</section>