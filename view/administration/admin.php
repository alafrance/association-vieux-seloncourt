<hr class="sep article" data-symbol="Articles :">
<!-- Articles -->
<section class="container">
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
                <h2 class="center">Date importante sur la page d'Accueil</h2>
                <div class="buttons">
                    <a href="index.php?route=addDate" class="btn btn-secondary">Ajouter ou modifier une date</a>
                    <a href="index.php?route=deleteDate" class="btn btn-tertiary">Supprimer la date</a>
                </div>
            </div>

            <hr>
        </div>
</section>
<section>
        <h2 class="titleTableArticle center">Tous les articles :</h2>
        <table data-toggle="table" data-pagination="true" data-search="true" data-locale="fr-FR">
            <thead>
				<tr>
					<th>Titre</th>
					<th>Contenu</th>
					<th>Ecrit le</th>
					<th>Ecrit par :</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
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
			</tbody>
        </table>
</section>

<!-- Catégorie -->
<hr class="sep category" data-symbol="Catégories :">

<section class="center category container">
        <div class="row iota">
            <?php foreach($categories as $category){?>
                <?php if($category->getId() == 1){?>
                    <p class="col-8"><?= $category->getName(); ?></p>
                    <p class="col-4">Impossible de le supprimer</p>

                <?php }else{ ?>

                <p class="col-8"><?= $category->getName(); ?></p>
                <p class="col-4"><a href="#" class="btn btn-tertiary supCategory">Supprimer</a></p>
                <?php }
            } ?>
        </div>
        <form action='index.php?route=addCategory' method="post" class="iota row">
            <div class="col-8">
                <input type="text" name="category" id="category" class="category">
            </div>
            <button class="btn btn-secondary col-4" type="submit" name="action">Ajouter</button>
        </form>

</section>

<!-- Commentaires signalés -->
<hr class="sep commentary" data-symbol="Commentaire(s) :">

<section class="center flex-center commentary">
    <?php
        if (empty($comments)) {
            echo '<p>' . 'Aucun commentaire signalé' . '</p>';
        } else {
    ?>
    <h2>Commentaires signalés :</h2>
    <table data-toggle="table" data-pagination="true" data-search="true" data-locale="fr-FR">
		<thead>
            <tr>
                <th>Pseudo</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Actions</th>
			</tr>
		</thead>
		<tbody>
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
		</tbody>
        </table>
</section>

<!-- Utilisateurs-->
<hr class="sep user" data-symbol="Utilisateurs :">

<section class="user">
    <table data-toggle="table" data-pagination="true" data-search="true" >
		<thead>
			<tr>
				<th>Nom</th>
				<th>Email</th>
				<th>Date de création</th>
				<th>Rôle</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
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
		</tbody>
    </table>
</section>