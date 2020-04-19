<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/i1vac04eruqfh6j3cqqaplbmyvmx3i9243xiqsbadqnssub6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script defer src='js/tiny.js'></script>
    <script defer src='js/fr_FR.js'></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!--  Navbar Animation-->
    <script defer src='js/nav.js'></script>
    <link rel="stylesheet" href="../public/css/<?=$css?>.css">

    <!-- Materialize -->
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="materialize-src/sass/materialize.css">

        <!-- Compiled and minified JavaScript -->
        <script src="materialize-src/js/bin/materialize.js"></script>
</head>
<body>
    <?php include '../view/nav.php'?>
    <?= $content ?>
    <?php include '../view/footer.php'; ?>

</body>
</html>

