<?php
$this->title = "Modifier l'article";
$this->css = "administration";
?>
<section>
<form method="post" action="../public/index.php?route=editArticle&id=<?= $id?>" class="center" enctype="multipart/form-data">

<div class="titleAndChapter">
    <div class="inputAndLabel">
        <label for="title">Titre de l'Article</label><br>
        <input type="text" id="title" name="title" value="<?= $article->getTitle();?>"><br>
        <?= isset($errors['title']) ? $errors['title'] : ''; ?>
    </div>

    <div class="inputAndLabel">
        <label for="category">Catégorie de l'article</label><br>

        <select name="category" id="category">
            <option value="<?= $categoryId ?>"><?= $article->getCategory(); ?></option>
            <?php foreach($categories as $category){ ?>
                <?php if ($category->getName() != $article->getCategory()){ ?>
                <option value="<?= $category->getId();?>"><?= $category->getName();?></option>
            <?php
                    }
                }
            ?>
        </select>

        <?= isset($errors['category']) ? $errors['category'] : ''; ?>
    </div>
</div>

<label for="content">Contenu</label><br>
<?= isset($errors['content']) ? $errors['content'] : ''; ?>
<textarea id="content" name="content"><?= $article->getContent();?></textarea><br>

<input type="submit" value="Mettre à jour" id="submit" name="submit" class="button-secondary button">
</form>
</section>