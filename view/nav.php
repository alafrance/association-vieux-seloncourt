<nav>
    <div class="navBarMobile">
    <a href="index.php"><img src="../public/img/logo.jpg"></a>
    <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

    <ul class="nav-links">
        <li class="logo"><a href="index.php" class="link"><img src="../public/img/logo.jpg"></a></li>
        <div>
                <li class="text"><a href="index.php" class="link">Accueil</a></li>
                <li class="text"><a href="index.php?route=articles" class="link">Actualité</a></li>
                <li class="text"><a href="index.php?route=contact" class="link">Contact</a></li>
<?php
        if (isset($_SESSION['name'])){
?>
                <li class="text"><a href='index.php?route=profile' class="link">Profil</a></li>
<?php
        }else{
?>
                <li class="text"><a href='index.php?route=login' class="link">Inscription / Connexion</a></li>
<?php
        }
?>
        </div>

    </ul>
</nav>
