<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/i1vac04eruqfh6j3cqqaplbmyvmx3i9243xiqsbadqnssub6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script defer src='../public/js/tiny.js'></script>
    <script defer src='../public/js/fr_FR.js'></script>
    <!--  Navbar Animation-->
    <script defer src='public/js/nav.js'></script>
    <link rel="stylesheet" href="../public/css/<?=$css?>.css">
</head>
<body>
    <?php include '../view/nav.php'?>
    <?= $content ?>
    <?php include '../view/footer.php'; ?>

</body>
</html>

