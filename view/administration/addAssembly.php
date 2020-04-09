<?php
$this->title = "Nouvel article";
$this->css = "administration";
?>
<section>
    <form method="post" action="../public/index.php?route=addAssembly" class="center" enctype="multipart/form-data">

            <div class="inputAndLabel">
                <label for="date">Date : Jour / Mois / Année </label><br>
                <input type="date" id="date" name="date" value="<?= isset($post) ? htmlspecialchars($post->get('date')): ''; ?>"><br>
                <?= isset($errors['date']) ? $errors['date'] : ''; ?>
                <div class="inputAndLabel">

            <div class="inputAndLabel">
                <p>Horaire :</p>
                <input type='number 'id="hours" name="hours" value="<?= isset($post) ? htmlspecialchars($post->get('hours')): ''; ?>"></input>
                <label for="hours">Heures</label><br>
                <?= isset($errors['hours']) ? $errors['hours'] : ''; ?>

                <input type='number 'id="minutes" name="minutes" value="<?= isset($post) ? htmlspecialchars($post->get('minutes')): ''; ?>"></input>
                <label for="minutes">Minute(s)</label><br>
                <?= isset($errors['minutes']) ? $errors['minutes'] : ''; ?>

            <div class="inputAndLabel">

            <div class="inputAndLabel">
                <label for="place">Lieu</label><br>
                <input type='text 'id="place" name="place" value="<?= isset($post) ? htmlspecialchars($post->get('place')): ''; ?>"></input><br>
                <?= isset($errors['place']) ? $errors['place'] : ''; ?>
            <div class="inputAndLabel">

            <div>
                <label for="content">Info en plus : (facultatif)</label><br>
                <?= isset($errors['content']) ? $errors['content'] : ''; ?>
                <textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea><br>
            </div>

        <input type="submit" value="Ajouter assemblée Générale" id="submit" name="submit" class="button-secondary button">
    </form>
</section>
