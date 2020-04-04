<?php
$route = isset($post) && $post->get('id') ? 'editArticle&id='.$post->get('id') : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
?>
<form method="post" action="../public/index.php?route=<?= $route; ?>" class="center" enctype="multipart/form-data">

    <div class="titleAndChapter">
        <div class="inputAndLabel">
            <label for="title">Titre de l'Article</label><br>
            <input type="text" id="title" name="title" value="<?= isset($post) ? htmlspecialchars($post->get('title')): ''; ?>"><br>
            <?= isset($errors['title']) ? $errors['title'] : ''; ?>
        </div>

        <div class="inputAndLabel">
            <label for="category">Catégorie de l'article</label><br>

            <select name="category" id="category">
                <option value="">Choisissez un article</option>
                <?php foreach($categories as $category){ ?>
                    <option value="<?= $category->getId();?>"><?= $category->getName();?></option>
                <?php }?>
            </select>

            <?= isset($errors['category']) ? $errors['category'] : ''; ?>
        </div>

       <?php if (isset($addArticle)){ ?>

        <div class="inputAndLabel">
            <label for='image'>Image correspondant à l'article</label><br>
            <input type="file" id="image" name="image">
            <div id="preview-file"></div>
            <?= isset($errors['image']) ? $errors['image'] : ''; ?>
        </div>

        <?php } ?>
    </div>

    <label for="content">Contenu</label><br>
    <?= isset($errors['content']) ? $errors['content'] : ''; ?>
    <textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea><br>

    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit" class="button-secondary button">
</form>