<?php

ob_start();

?>

    <div id="dashbord"></div>
    <div id="container-accueil">

        <!-- EN TETE -->
        <div class="container-accueil-head">
            <div class="head-left" id="head-left-hidden">
                <img src="<?=URL.$_SESSION['avatar']?>" alt="<?=$_SESSION['avatar']?>">
                <p><?=$_SESSION['prenom']. ' '.$_SESSION['nom']?></p>
            </div>
            <div class="head-center">
                <h3>créer et paramétrer vos quizz</h3>
            </div>
            <div class="head-right">
                <form action="" method="POST">
                    <input type="submit" value="Déconnexion" name="deconnexion">
                </form>
            </div>
        </div>

        <!-- CORPS -->
        <div class="container-accueil-corps">
            <div class="container-accueil-corps-menu">
                <div class="top">
                    <img src="<?=URL.$_SESSION['avatar']?>" alt="<?=$_SESSION['avatar']?>">
                    <p><?=ucfirst($_SESSION['prenom'])?></p>
                    <p class="nom"><?=strtoupper($_SESSION['nom'])?></p>
                </div>
                <div class="bottom">
                    <!-- MENU -->
                    <?php
                    include "views/commons/menu.php";
                    ?>
                </div>
            </div>
            <div id="container-dashboard-corps">

                <!-- ACCUEIL NOMBRE QUESTIONS -->
                <div class="accueil-nbre-question">

                        <label class="titre-lbl">Tableau de board</label>

                </div>

                <!-- ACCUEIL-LIST-QUESTION-->


                <div id="dashboard-top">
                    <div id="dashboard-top-left">
                        <p><span><?=(isset($nbre_admin) ? $nbre_admin : "NULL")?> admins</span><br>enregistrés</p>
                        <img src="<?=URL?>public/source/images/icones/avat-admin.png">
                    </div>
                    <div id="dashboard-top-right">
                        <p><span><?=(isset($nbre_joueur) ? $nbre_joueur : "NULL")?> Joueurs</span><br>enregistrés</p>
                        <img src="<?=URL?>public/source/images/icones/avat-techno.png">
                    </div>
                </div>


                <div id="dashboard-center">
                    <div id="dashboard-center-left">
                        <canvas id="graph1"></canvas>
                    </div>
                    <div id="dashboard-center-right">
                        <canvas id="graph2"></canvas>
                        <p>Représentation des questions par type</p>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <script type="text/javascript">

        let container_corps = document.getElementById("container-accueil-corps");
        container_corps.style.overflow = "scroll";

    </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>

<script>
    function chartTopScore()
    {
        //On récupère le contexte
        let ctx = document.getElementById('graph1').getContext('2d');
        //On définie la config

        let data = {
            //Insertion des logins
            labels: <?php echo json_encode($logins); ?>,

            datasets:
                [{
                    label: "Top 5 des meilleurs performences",
                    //Insertion des données
                    data : <?php echo json_encode($scores); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        };
        let options;

        let config  = {
            type: 'bar',
            data: data,
            options: options
        };
        //On définie notre graphique
        var graph1 = new Chart(ctx,config);
    }
    chartTopScore();

    function chartTypeQuestion()
    {
        //On récupère le contexte
        let ctx = document.getElementById('graph2').getContext('2d');
        //On définie la config

        let data = {

            datasets: [{
                    data : <?php echo json_encode($nbre_type_question_json); ?>,
                    backgroundColor : [ '#44a3d1',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)']
            }],

            labels: [
                'Texte',
                'Simple',
                'Multiple'
            ]
        };
        let options = {
            responsive:true,
            maintainAspectRatio: false
        };

        let config  = {
            type: 'pie',
            data: data,
            options: options
        };
        //On définie notre graphique
        var graph2 = new Chart(ctx,config);
    }
    chartTypeQuestion();



</script>
