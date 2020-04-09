<?php
$this->title = "Nouvel article";
$this->css = "administration";
?>
<section>
    <form method="post" action="../public/index.php?route=addExposition" class="center" enctype="multipart/form-data">

        <div class="titleAndChapter">
            <div class="inputAndLabel">
                <label for="title">Titre de l'Exposition</label><br>
                <input type="text" id="title" name="title" value="<?= isset($post) ? htmlspecialchars($post->get('title')): ''; ?>"><br>
                <?= isset($errors['title']) ? $errors['title'] : ''; ?>
            </div>

            <div class="inputAndLabel">
                <label for='image'>Image principale de l'exposition</label><br>
                <input type="file" id="image" name="image">
                <div id="preview-file"></div>
                <?= isset($errors['image']) ? $errors['image'] : ''; ?>
            </div>
        </div>

        <label for="content">Contenu de l'Exposition :</label><br>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>
        <textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea><br>

        <input type="submit" value="Ajouter" id="submit" name="submit" class="button-secondary button">
    </form>
</section>
