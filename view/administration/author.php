<section class="center">
    <h1>Article :</h1>
    <div class="linkArticle">
        <h2>Vous pouvez ajouter :</h2>
        <div class="iota buttons author">
            <a href="index.php?route=addArticle" class="btn btn-secondary">Ajouter un article</a>
            <a href="index.php?route=addExposition" class="btn btn-secondary">Ajouter une exposition</a>
        </div>
    </div>
   
    <h2 class="titleAllArticleAuthor">Et voici tous les articles que vous avez déja écrit :</h2>
    <?php if($articles == NULL){?>
        <div>
            <p>Vous n'avez écrit encore aucun article ! Ecrivez en un : <a href="index.php?route=addArticle" class="btn btn-secondary">Ecrire un article</a></p>
        </div>
    <?php }else{?>
    <table class="author">
        <tr>
            <td>Titre</td>
            <td>Contenu</td>
            <td>Date :</td>
            <td>Actions :</td>
        </tr>
        <?php foreach($articles as $article){?>
                <tr>
                    <td><?= $article->getTitle();?></td>
                    <td><?= substr(strip_tags($article->getContent()), 0, 100);?>...</td>
                    <td><?= $article->getDate();?></td>
                    <td class="actions iota">
                        <a href="index.php?route=article&id=<?= $article->getId();?>" class="btn btn-secondary">Accéder à l'article</a>
                        <a href="index.php?route=editArticle&id=<?= $article->getId();?>" class="btn btn-secondary">Modifier l'article</a>
                        <a href="index.php?route=editImageArticle&id=<?= $article->getId();?>" class="btn btn-secondary">Modifier l'image</a>
                        <a href="index.php?route=deleteArticle&id=<?= $article->getId();?>" class="btn btn-tertiary">Supprimer l'article</a>
                    </td>
                </tr>
        <?php }
        }?>
    </table>

</section>