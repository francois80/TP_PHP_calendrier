<?php
$mois = [1 => "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre",
    "octobre", "novembre", "décembre"];
$jourSemaine = ["Sunday" => "dimanche", "Monday" => "lundi", "Tuesday" => "mardi", "Wednesday" => "mercredi", "Thursday" => "jeudi", "Friday" => "vendredi", "Saturday" => "samedi"];
$monthFR = ["January" => "janvier", "February" =>  "février", "March" => "mars", "April" => "avril", "May" => "mai", "June" => "juin", "July" => "juillet", "August" =>  "août", "September" => "septembre",
    "October" => "octobre", "November" => "novembre", "December" => "décembre"];
$envoi = false; //permet de savoir si envoi du formulaire pour affichage du calendrier
//vérification si champs de formulaire != ""
if (isset($_POST["mois"]) && isset($_POST["annee"])) {
    $monthChoice = $_POST["mois"]; //form mois
    $yearChoice = $_POST["annee"]; // form annee
    $timeNow = time(); //timsestamps du jour
    //si les variables qui réccupèrent le mois et l'annéé ne sont pas vide on crée la variable date avec le timestamps correspondant
    if ($monthChoice != "" && $yearChoice != "") {
        $envoi = true; //si true affichage du calendrier
        $date = mktime(0, 0, 0, $monthChoice, 1, $yearChoice); //création du timestamps choisi
        $day = getdate($date); //construction du tableau getdate avec le timestamps de la date recherchée
        $monthChoice = $day["month"]; // réccupération du mois de l'année (january, february...)
        $nbDayinMonthChoice = date("t", $date); //réccupération du nb de jour dans le mois
    }
}
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 bg-secondary">
                    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                        <fieldset>
                            <legend class="text-white">Séléctionnez un mois et une année dans les listes déroulantes</legend>
                            <div class="row justify-content-center">
                                <div class="form-group">
                                    <label for="mois" class="text-white">Mois</label>
                                    <select id="mois" name="mois">
                                        <option value=""> -- Sélection -- </option>
                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $mois[$i] ?> </option>
                                            <?php
                                            ;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="annee" class="text-white">Année</label>
                                    <select id="mois" name="annee">
                                        <option value=""> -- Sélection -- </option>
                                        <?php for ($i = 1970; $i <= 2050; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?> </option>
                                            <?php
                                            ;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Envoyez" name="submit" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- Calendrier  -->    
            <?php
            //affichage du calendrier
            if ($envoi) {
                ?>
                <div class="row justify-content-center">
                    <div class="col-md-12 bg-secondary">
                        <?php
                        for ($i = 1; $i <= $nbDayinMonthChoice; $i++) {
                            $date1 = "";
                            $day1 = "";
                            $date1 = mktime(0, 0, 0, (int) $_POST["mois"], $i, (int) $yearChoice);
                            $day1 = getdate($date1);
                            $dayWeek = date("l", $date1);
                            $dayMonth = date("F", $date1);
                            //var_dump($day1);
                            ?>
                            <div class="card text-white bg-primary mb-3 d-inline-block" style="max-width: 10rem; max-height: 8rem;">
                                <div class="card-header"><?= $jourSemaine[$dayWeek] ?> <?= $i ?> <?= $monthFR[$dayMonth] ?></div>                
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>  