<section>
    <h2>Articles :</h2>
    <a href="index.php?route=addArticle">Ajouter un article</a>

    <h2>Vos articles :</h2>
    <table>
        <tr>
            <td>Titre</td>
            <td>Contenu</td>
            <td>Date :</td>
            <td>Actions :</td>
        </tr>
        <?php foreach($articles as $article){?>
                <tr>
                    <td><?= $article->getTitle();?></td>
                    <td><?= substr($article->getContent(), 0, 100);?></td>
                    <td><?= $article->getDate();?></td>
                    <td>
                        <a href="index.php?route=article&id=<?= $article->getId();?>">Accéder à l'article</a>
                        <a href="index.php?route=modifiyArticle&id=<?= $article->getId();?>">Modifier l'article</a>
                        <a href="index.php?route=deleteArticle&id=<?= $article->getId();?>">Supprimer l'article</a>
                    </td>
                </tr>
        <?php }?>
    </table>

</section>