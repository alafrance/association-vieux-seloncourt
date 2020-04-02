<?php
$this->css = 'profile';
$this->title = "Page profil";
$role = $this->session->get('role');
$i = 1;
?>
<?= $this->session->show('modify'); ?>
<section>
    <h1>Bienvenue sur le profil de <?= $this->session->get('name'); ?></h1>
    <p>Voici vos informations :</p>
    <ul>
        <li>Nom : <?= $this->session->get("name") ?></li>
        <li>Email : <?= $this->session->get("email") ?></li>
        <li>Avatar : Pas encore d'avatar</li>
        <li>Mot de passe : ********</li>
    </ul>
    <p>Pour changer ses informations, accéder à votre <a href="index.php?route=setting">paramètre</a></p>
</section>
<section>
    <?php if ($role === 'author' || $role === 'admin') { ?>
        <a href="index.php?route=addArticle">Ajouter un article</a>

    <?php }if ($role === 'admin') { ?>
        <h2>Articles:</h2>
        <table>
            <tr>
                <td>Titre</td>
                <td>Contenu</td>
                <td>Ecrit le</td>
                <td>Action</td>
            </tr>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?= $article->getTitle() ?></td>
                    <td><?= $article->getContent() ?></td>
                    <td><?= $article->getDate() ?></td>
                    <td>
                        <a href="index.php?route=article&id=<?= $article->getId(); ?>">Accéder à l'article</a>
                        <a href="index.php?route=editArticle&id=<?= $article->getId(); ?>">Modifier un article</a>
                        <a href="index.php?route=deleteArticle&id=<?= $article->getId(); ?>">Supprimer un article</a>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
</section>

<section>
    <h2>Commentaires signalés</h2>
    <?php
        if (empty($comments)) {
            echo '<p>' . 'Aucun commentaire signalé' . '</p>';
        } else {
    ?>
        <table>
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
                    <td><?= htmlspecialchars($comment->getPseudo()); ?></td>
                    <td><?= htmlspecialchars(substr($comment->getContent(), 0, 100)); ?></td>
                    <td><?= htmlspecialchars($comment->getDate()); ?></td>
                    <td>
                        <a href='index.php?route=unflagComment&commentId=<?= $comment->getId(); ?>' class="button-secondary button">Désignaler ce commentaire</a><br>
                        <a href='index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>' class="button-secondary button">Supprimer ce commentaire</a>
                    </td>
                </tr>


        <?php
            }
        }
        ?>
        </table>
</section>
<section>
    <h2> 20 derniers utilisateurs inscrit</h2>
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
                <td><?= htmlspecialchars($user->getRole()); ?></td>
                <?php
                if ($user->getRole() != 'admin' && $user->getRole() != 'author' && $user->getEmail() != $this->session->get('email') ) {
                ?>
                    <td><a href="../public/index.php?route=deleteUser&userId=<?= $user->getId(); ?>" class="button button-secondary">Supprimer</td>
            <?php
                } else {
                    echo '<td>Suppression impossible</td>';
                }
                $i++;
            }
            ?>
            </tr>
    </table>
<?php } ?>
<a href="index.php?route=logout">Se déconnecter</a>
</section>