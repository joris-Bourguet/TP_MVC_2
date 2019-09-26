<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.resto.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url" => "./?action=recherche&critere=nom", "label" => "Recherche par nom");
$menuBurger[] = Array("url" => "./?action=recherche&critere=adresse", "label" => "Recherche par adresse");

// critere de recherche par defaut
$critere = "nom";
if (isset($_GET["critere"])) {
    $critere = $_GET["critere"];
}
// recuperation des donnees GET, POST, et SESSION
// recherche par nom
if (isset($_POST["nomR"])) { $nomR = $_POST["nomR"]; }
// recherche par adresse
$voieAdrR = "";
$cpR = "";
$villeR = "";

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
// Si on provient du formulaire de recherche : $critere indique le type de recherche à effectuer
if (!empty($_POST)) {
    switch ($critere) {
        case 'nom':
            // recherche par nom
            $listeRestos = getRestoByNameU($nomR);

            break;
        case 'adresse':
            // recherche par adresse
            $listeRestos = getRestoByAdresse($voieAdrR,$cpR,$villeR);

            break;
    }
}

// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Recherche d'un restaurant";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueRechercheResto.php";
include "$racine/vue/pied.html.php";
?>