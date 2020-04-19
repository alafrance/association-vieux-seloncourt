<?php
$this->title = "Nouvel article";
$this->css = "administration";
?>
<section>
    <form method="post" action="../public/index.php?route=addArticle" class="center" enctype="multipart/form-data">

        <div class="titleAndChapter">
            <div class="inputAndLabel">
                <label for="title">Titre de l'Article</label><br>
                <input type="text" id="title" name="title" value="<?= isset($post) ? htmlspecialchars($post->get('title')): ''; ?>"><br>
                <?= isset($errors['title']) ? $errors['title'] : ''; ?>
            </div>

            <div class="inputAndLabel">
                <label for="category">Catégorie de l'article</label><br>

                <select name="category" id="category" multiple>
                    <option value="" disabled selected>Choisissez une catégorie</option>
                    <?php foreach($categories as $category){ ?>
                        <option value="<?= $category->getId();?>"><?= $category->getName();?></option>
                    <?php }?>
                </select>

                <?= isset($errors['category']) ? $errors['category'] : ''; ?>
            </div>

            <div class="inputAndLabel">
                <label for='image'>Image correspondant à l'article</label><br>
                <input type="file" id="image" name="image">
                <div id="preview-file"></div>
                <?= isset($errors['image']) ? $errors['image'] : ''; ?>
            </div>
        </div>

        <label for="content">Contenu</label><br>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>
        <textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea><br>

        <input type="submit" value="Ajouter" id="submit" name="submit" class="button-secondary button">
    </form>
</section>
