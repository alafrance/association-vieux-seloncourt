
<!-- Articles -->
<section>
        <div class="center">
            <h1 class="titleArticle">Articles :</h1>
            <p class="admin">En tant qu'administrateur vous avez tout les droits ! Alors vous pouvez :  </p>
        </div>
        <div class="linkArticle iota">

            <div>
                <h2 class="center">Ajouter :</h2>
                <div class="buttons">
                    <a href="index.php?route=addArticle" class="btn btn-secondary">Un Article</a>
                    <a href="index.php?route=addExposition" class="btn btn-secondary">Une Exposition</a>
                </div>
            </div>

            <hr>

            <div>
                <h2 class="center">Gérer l'assemblée générale :</h2>
                <div class="buttons">
                    <a href="index.php?route=addAssembly" class="btn btn-secondary">Modifier l'Assemblée Génerale</a>
                    <a href="index.php?route=deleteAssembly" class="btn btn-tertiary">Supprimer l'Assemblée Génerale de l'Accueil</a>
                </div>
            </div>

            <hr>

            <div>
                <h2 class="center titleButton">Gérer le vide grenier :</h2>
                <div class="buttons">
                    <a href="index.php?route=addAssembly" class="btn btn-secondary">Modifier le vide grenier</a>
                    <a href="index.php?route=deleteAssembly" class="btn btn-tertiary">Supprimer le vide Grenier de l'Accueil</a>
                </div>
            </div>
        </div>

        <h2 class="titleTableArticle center">Vous pouvez voir ici tous les articles qui ont déja été écrit:</h2>
        <table>
            <tr>
                <td>Titre</td>
                <td>Contenu</td>
                <td>Ecrit le</td>
                <td>Ecrit par :</td>
                <td>Action</td>
            </tr>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?= $article->getTitle() ?></td>
                    <td><?= substr(strip_tags($article->getContent(), '<br>'), 0, 150); ?>...</td>
                    <td><?= $article->getDate() ?></td>
                    <td><?= $article->getAuthor() ?></td>
                    <td class="action iota">
                        <a href="index.php?route=article&id=<?= $article->getId(); ?>" class="btn btn-secondary">Y Accéder</a>
                        <a href="index.php?route=editArticle&id=<?= $article->getId(); ?>" class="btn btn-secondary">Modifier l'article</a>
                        <a href="index.php?route=editImageArticle&id=<?= $article->getId();?>" class="btn btn-secondary">Modifier l'image</a>
                        <a href="index.php?route=deleteArticle&id=<?= $article->getId(); ?>" class="btn btn-tertiary">Supprimer</a>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
</section>

<!-- Catégorie -->

<section class="center category">
        <h1 class="center">Et ici, toutes les catégories :</h1>
        <table >
            <?php foreach($categories as $category){?>
                <tr>
                    <td class="category">
                        <?= $category->getName(); ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <h2>Vous pouvez ajouter une catégorie d'article si vous le désirez : </h2>
        <form action='index.php?route=addCategory' method="post">
                <input type="text" name="category">
                <input type="submit" name="submit" value="Ajouter">
        </form>

</section>

<!-- Commentaires signalés -->

<section class="center">
    <h1>Commentaire(s) :</h1>
    <?php
        if (empty($comments)) {
            echo '<p>' . 'Aucun commentaire signalé' . '</p>';
        } else {
    ?>
    <h2>Voici tous les commentaires signalés</h2>
    <table class="table">
            <tr>
                <td>Pseudo</td>
                <td>Commentaire</td>
                <td>Date</td>
                <td>Actions</td>
            </tr>
            <?php
            foreach ($comments as $comment) {
            ?>
                <tr>
                    <td><?= htmlspecialchars($comment->getName()); ?></td>
                    <td><?= htmlspecialchars(substr($comment->getContent(), 0, 100)); ?></td>
                    <td><?= htmlspecialchars($comment->getDate()); ?></td>
                    <td class="iota">
                        <a href='index.php?route=unflagComment&commentId=<?= $comment->getId(); ?>' class="btn btn-secondary">Désignaler ce commentaire</a><br>
                        <a href='index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>' class="btn btn-tertiary">Supprimer ce commentaire</a>
                    </td>
                </tr>


        <?php
            }
        }
        ?>
        </table>
</section>

<!-- Utilisateurs-->

<section class="user">
    <h1 class="center">Utilisateurs : </h1>
    <table>
        <tr>
            <td>Nom</td>
            <td>Email</td>
            <td>Date de création</td>
            <td>Rôle</td>
            <td>Actions</td>
        </tr>
        <?php
        foreach ($users as $user) {
        ?>
            <tr>
                <td><?= htmlspecialchars($user->getName()); ?></td>
                <td><?= htmlspecialchars($user->getEmail()); ?></td>
                <td><?= htmlspecialchars($user->getDateCreated()); ?></td>
                <td><?php
                    if ($user->getRole() == 'admin'){
                        echo 'Administrateur';
                    }
                    else if ($user->getRole() == 'author'){
                        echo 'Auteur';
                    }
                    else{
                        echo 'Utilisateur';
                    }
                ?></td>
                <?php
                if ($user->getRole() != 'admin' && $user->getRole() != 'author' && $user->getEmail() != $this->session->get('email') ) {
                ?>
                    <td class="action iota">
                        <a href="index.php?route=right&userId=<?= $user->getId();?>" class="btn btn-secondary">Changer ses droits</a>
                        <a href="index.php?route=deleteUser&userId=<?= $user->getId();?>" class="btn btn-tertiary">Supprimer l'utilisateur</a>
                    </td>
            <?php
                } else {
                    echo '<td>Modification ou Suppresion impossible</td>';
                }
            }
            ?>
            </tr>
    </table>
</section>