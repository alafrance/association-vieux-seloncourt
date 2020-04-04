
<!-- Articles -->
<section>
        <a href="index.php?route=addArticle">Ajouter un article</a>
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
                    <td><?= substr($article->getContent(), 0, 150); ?></td>
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

<!-- Commentaires signalés -->

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

<!-- Utilisateurs-->

<section>
    <h2>Derniers utilisateurs inscrit</h2>
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
</section>