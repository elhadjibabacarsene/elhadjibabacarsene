<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- INCLUSION DU CSS -->
    <link rel="stylesheet" href="<?= URL ?>/public/style/main.css<?php echo "?".rand();?>">
    <link rel="stylesheet" media="screen and (min-width:768px) and (max-width:1023px)" href="<?= URL ?>/public/style/tablette.css<?php echo "?".rand();?>">
    <link rel="stylesheet" media="screen and (max-width:767px)" href="<?= URL ?>/public/style/mobile.css<?php echo "?".rand();?>"@>
    <!-- INCLUSION DES FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <title><?=$title?></title>
</head>
<body>
    <div id="color-overlay"></div>
    <!-- DEBUT HEADER -->
            <div class="header">
                <div class="logo">
                    <a href="index.php"><img src="<?= URL ?>/public/source/images/logo-QuizzSA.png" alt="logo-sa-quizz"></a>
                </div>
                <div class="titre">
                    <h2>Le plaisir de jouer</h2>
                </div>
            </div>
    <!-- FIN HEADER -->


        <!-- DEBUT CONTENU -->
                <div class="container">

                        <?=$content;?>

                </div>

        <!-- FIN CONTENU -->


    <!-- INCLUSION DES FICHIERS JS -->
    <script text="type/javascript" src="<?URL?>public/js/config.js"></script>
</body>
</html>