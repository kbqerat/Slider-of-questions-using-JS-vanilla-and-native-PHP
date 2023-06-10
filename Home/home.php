<?php
include("../Connection/connection.php");
session_start();

// Retrieving the user id
$userId = $_SESSION['userId'];

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page
    header('Location: ../Connection/log-in.php');
    exit;
}

// Retrieve the current patient id
$userIdSql = "SELECT id FROM patients ORDER BY id DESC LIMIT 1";
$stmt = $con->prepare($userIdSql);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $patientId = $row['id'] + 1;
} else {
    $patientId = 1;
}


// Check if the user has already submitted data
$submissionExistsSql = "SELECT * FROM patients WHERE user_id = ?";
$stmt = $con->prepare($submissionExistsSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    header("location: alreadySubmitted.php");
    exit;
}



/* 
**********************************************************
WHEN THE USER CLICK VALIDER BUTTOM
**********************************************************
*/
if (isset($_POST['submit'])) {

    /* 
    **********************************************************
    RETRIEVE THE INPUTS FIELDS FROM ALL FORMS
    **********************************************************
    */

    // Retrieve the form1 inputs
    $lastName = isset($_POST["lName"]) ? $_POST["lName"] : null;
    $firstName = isset($_POST["fName"]) ? $_POST["fName"] : null;
    $age = isset($_POST["age"]) ? $_POST["age"] : null;
    $sexe = isset($_POST["gender"]) ? $_POST["gender"] : null;
    $origin = isset($_POST["origin"]) ? $_POST["origin"] : null;
    $socioEco = isset($_POST["socioEco"]) ? $_POST["socioEco"] : null;
    $statutMat = isset($_POST["statutMat"]) ? $_POST["statutMat"] : null;
    $job = isset($_POST["job"]) ? $_POST["job"] : null;

    // Retrieve the form2 inputs
    $MST = isset($_POST["MST"]) ? $_POST["MST"] : null;
    $mstValue = isset($_POST["mstValue"]) ? $_POST["mstValue"] : null;
    $contact = isset($_POST["contact"]) ? $_POST["contact"] : null;
    $priseM = isset($_POST["priseM"]) ? $_POST["priseM"] : null;
    $priseMValue = isset($_POST["priseMValue"]) ? $_POST["priseMValue"] : null;
    $persAutres = isset($_POST["persAutres"]) ? $_POST["persAutres"] : null;
    $antUv = isset($_POST["antUv"]) ? $_POST["antUv"] : null;
    $antUvValue = isset($_POST["antUvValue"]) ? $_POST["antUvValue"] : null;
    $famAutres = isset($_POST["famAutres"]) ? $_POST["famAutres"] : null;
    $tox = isset($_POST["tox"]) ? $_POST["tox"] : null;
    $toxValue = isset($_POST["toxValue"]) ? $_POST["toxValue"] : null;

    // Retrieve the form3 inputs
    $larm = isset($_POST["larm"]) ? $_POST["larm"] : null;
    $photophobie = isset($_POST["photophobie"]) ? $_POST["photophobie"] : null;
    $blepha = isset($_POST["blepha"]) ? $_POST["blepha"] : null;
    $dlPerio = isset($_POST["dlPerio"]) ? $_POST["dlPerio"] : null;
    $rgOculaire = isset($_POST["rgOculaire"]) ? $_POST["rgOculaire"] : null;
    $dmVisuelle = isset($_POST["dmVisuelle"]) ? $_POST["dmVisuelle"] : null;
    $myio = isset($_POST["myio"]) ? $_POST["myio"] : null;
    $meta = isset($_POST["meta"]) ? $_POST["meta"] : null;
    $cepha = isset($_POST["cepha"]) ? $_POST["cepha"] : null;
    $flVisuel = isset($_POST["flVisuel"]) ? $_POST["flVisuel"] : null;
    $ATCD = isset($_POST["ATCD"]) ? $_POST["ATCD"] : null;
    $cliniqueSoAutres = isset($_POST["cliniqueSoAutres"]) ? $_POST["cliniqueSoAutres"] : null;
    $allergie = isset($_POST["allergie"]) ? $_POST["allergie"] : null;
    $signesRh = isset($_POST["signesRh"]) ? $_POST["signesRh"] : null;
    $herpes = isset($_POST["herpes"]) ? $_POST["herpes"] : null;
    $vitiligo = isset($_POST["vitiligo"]) ? $_POST["vitiligo"] : null;
    $poliose = isset($_POST["poliose"]) ? $_POST["poliose"] : null;
    $erytheme = isset($_POST["erytheme"]) ? $_POST["erytheme"] : null;
    $pseudoFoll = isset($_POST["pseudoFoll"]) ? $_POST["pseudoFoll"] : null;
    $aphtoseB = isset($_POST["aphtoseB"]) ? $_POST["aphtoseB"] : null;
    $aphtoseG = isset($_POST["aphtoseG"]) ? $_POST["aphtoseG"] : null;
    $signesNeuro = isset($_POST["signesNeuro"]) ? $_POST["signesNeuro"] : null;
    $signesPulmo = isset($_POST["signesPulmo"]) ? $_POST["signesPulmo"] : null;
    $signesORL = isset($_POST["signesORL"]) ? $_POST["signesORL"] : null;
    $signesCardio = isset($_POST["signesCardio"]) ? $_POST["signesCardio"] : null;
    $signesGyneco = isset($_POST["signesGyneco"]) ? $_POST["signesGyneco"] : null;
    $signesGastro = isset($_POST["signesGastro"]) ? $_POST["signesGastro"] : null;

    // Retrieve the form4 inputs
    $modeInsta = isset($_POST["modeInsta"]) ? $_POST["modeInsta"] : null;
    $local = isset($_POST["local"]) ? $_POST["local"] : null;
    $localPost = isset($_POST["localPost"]) ? $_POST["localPost"] : null;
    $Oatteint = isset($_POST["Oatteint"]) ? $_POST["Oatteint"] : null;

    // Retrieve the form5 inputs
    $avAtteint = isset($_POST["avAtteint"]) ? $_POST["avAtteint"] : null;
    $diminueValue = isset($_POST["diminueValue"]) ? $_POST["diminueValue"] : null;
    $diminueValueSurDix = isset($_POST["diminueValueSurDix"]) ? $_POST["diminueValueSurDix"] : null;
    $avAdelphe = isset($_POST["avAdelphe"]) ? $_POST["avAdelphe"] : null;
    $adelpheDiminueValue = isset($_POST["adelpheDiminueValue"]) ? $_POST["adelpheDiminueValue"] : null;
    $adelpheDiminueValueSurDix = isset($_POST["adelpheDiminueValueSurDix"]) ? $_POST["adelpheDiminueValueSurDix"] : null;
    $hyperLacry = isset($_POST["hyperLacry"]) ? $_POST["hyperLacry"] : null;
    $hyperConj = isset($_POST["hyperConj"]) ? $_POST["hyperConj"] : null;
    $cerclePeri = isset($_POST["cerclePeri"]) ? $_POST["cerclePeri"] : null;
    $preciRetrod = isset($_POST["preciRetrod"]) ? $_POST["preciRetrod"] : null;
    $keratite = isset($_POST["keratite"]) ? $_POST["keratite"] : null;
    $tyndall = isset($_POST["tyndall"]) ? $_POST["tyndall"] : null;
    $hypopion = isset($_POST["hypopion"]) ? $_POST["hypopion"] : null;
    $fibrine = isset($_POST["fibrine"]) ? $_POST["fibrine"] : null;
    $hypoema = isset($_POST["hypoema"]) ? $_POST["hypoema"] : null;
    $synIri = isset($_POST["synIri"]) ? $_POST["synIri"] : null;
    $nodules = isset($_POST["nodules"]) ? $_POST["nodules"] : null;
    $heterochromie = isset($_POST["heteroChromie"]) ? $_POST["heteroChromie"] : null;
    $atrophie = isset($_POST["atrophie"]) ? $_POST["atrophie"] : null;
    $transparent = isset($_POST["transparent"]) ? $_POST["transparent"] : null;
    $cataracte = isset($_POST["cataracte"]) ? $_POST["cataracte"] : null;
    $normo = isset($_POST["normo"]) ? $_POST["normo"] : null;
    $hypo = isset($_POST["hypo"]) ? $_POST["hypo"] : null;
    $hyper = isset($_POST["hyper"]) ? $_POST["hyper"] : null;
    $goniosy = isset($_POST["goniosy"]) ? $_POST["goniosy"] : null;
    $vitreHyalitel = isset($_POST["vitreHyalitel"]) ? $_POST["vitreHyalitel"] : null;
    $oeufsFourmi = isset($_POST["oeufsFourmi"]) ? $_POST["oeufsFourmi"] : null;
    $foyers = isset($_POST["foyers"]) ? $_POST["foyers"] : null;
    $maculaire = isset($_POST["maculaire"]) ? $_POST["maculaire"] : null;
    $vascularite = isset($_POST["vascularite"]) ? $_POST["vascularite"] : null;
    $papillite = isset($_POST["papillite"]) ? $_POST["papillite"] : null;
    $sclerite = isset($_POST["sclerite"]) ? $_POST["sclerite"] : null;
    $resteExamenClinique = isset($_POST["resteExamen-clinique"]) ? $_POST["resteExamen-clinique"] : null;

    // Retrieve the form6 inputs
    $champVisuel = isset($_POST["champVisuel"]) ? $_POST["champVisuel"] : null;
    $textCouleur = isset($_POST["textCouleur"]) ? $_POST["textCouleur"] : null;
    $echoOculaire = isset($_POST["echoOculaire"]) ? $_POST["echoOculaire"] : null;
    $erg = isset($_POST["erg"]) ? $_POST["erg"] : null;
    $papille = isset($_POST["papille"]) ? $_POST["papille"] : null;
    $retine = isset($_POST["retine"]) ? $_POST["retine"] : null;
    $EOG = isset($_POST["EOG"]) ? $_POST["EOG"] : null;
    $PEV = isset($_POST["PEV"]) ? $_POST["PEV"] : null;
    $PCA = isset($_POST["PCA"]) ? $_POST["PCA"] : null;
    $angiographie = isset($_POST["angiographie"]) ? $_POST["angiographie"] : null;
    $vertIndocyanine = isset($_POST["vertIndocyanine"]) ? $_POST["vertIndocyanine"] : null;
    $nfs = isset($_POST["nfs"]) ? $_POST["nfs"] : null;
    $nfsValue = isset($_POST["nfsValue"]) ? $_POST["nfsValue"] : null;
    $glycemie = isset($_POST["glycemie"]) ? $_POST["glycemie"] : null;
    $vs = isset($_POST["vs"]) ? $_POST["vs"] : null;
    $vsValue = isset($_POST["vsValue"]) ? $_POST["vsValue"] : null;
    $crp = isset($_POST["crp"]) ? $_POST["crp"] : null;
    $crpValue = isset($_POST["crpValue"]) ? $_POST["crpValue"] : null;
    $epp = isset($_POST["epp"]) ? $_POST["epp"] : null;
    $eppValue = isset($_POST["eppValue"]) ? $_POST["eppValue"] : null;
    $eca = isset($_POST["eca"]) ? $_POST["eca"] : null;
    $ecaValue = isset($_POST["ecaValue"]) ? $_POST["ecaValue"] : null;
    $bilanCalcique = isset($_POST["bilanCalcique"]) ? $_POST["bilanCalcique"] : null;
    $bilanCalciqueValue = isset($_POST["bilanCalciqueValue"]) ? $_POST["bilanCalciqueValue"] : null;
    $anca = isset($_POST["anca"]) ? $_POST["anca"] : null;
    $aan = isset($_POST["aan"]) ? $_POST["aan"] : null;
    $hla = isset($_POST["hla"]) ? $_POST["hla"] : null;
    $fr = isset($_POST["fr"]) ? $_POST["fr"] : null;
    $idr = isset($_POST["idr"]) ? $_POST["idr"] : null;
    $bilanRenal = isset($_POST["bilanRenal"]) ? $_POST["bilanRenal"] : null;
    $hvb = isset($_POST["hvb"]) ? $_POST["hvb"] : null;
    $hvc = isset($_POST["hvc"]) ? $_POST["hvc"] : null;
    $tpha = isset($_POST["tpha"]) ? $_POST["tpha"] : null;
    $serologie = isset($_POST["serologie"]) ? $_POST["serologie"] : null;
    $serologieToxo = isset($_POST["serologieToxo"]) ? $_POST["serologieToxo"] : null;
    $serologieCmv = isset($_POST["serologieCmv"]) ? $_POST["serologieCmv"] : null;
    $bgsa = isset($_POST["bgsa"]) ? $_POST["bgsa"] : null;
    $pathergy = isset($_POST["pathergy"]) ? $_POST["pathergy"] : null;
    $rxSinus =isset($_POST["rxSinus"]) ? $_POST["rxSinus"] : null;
    $rxSinusValue = isset($_POST["rxSinusValue"]) ? $_POST["rxSinusValue"] : null;
    $rxBassin = isset($_POST["rxBassin"]) ? $_POST["rxBassin"] : null;
    $rxBassinValue = isset($_POST["rxBassinValue"]) ? $_POST["rxBassinValue"] : null;
    $rxRachis = isset($_POST["rxRachis"]) ? $_POST["rxRachis"] : null;
    $rxRachisValue = isset($_POST["rxRachisValue"]) ? $_POST["rxRachisValue"] : null;
    $rxSacro = isset($_POST["rxSacro"]) ? $_POST["rxSacro"] : null;
    $rxSacroValue = isset($_POST["rxSacroValue"]) ? $_POST["rxSacroValue"] : null;
    $thoracique = isset($_POST["thoracique"]) ? $_POST["thoracique"] : null;
    $thoraciqueValue = isset($_POST["thoraciqueValue"]) ? $_POST["thoraciqueValue"] : null;
    $investigationsAutres = isset($_POST["investigationsAutres"]) ? $_POST["investigationsAutres"] : null;

    // Retrieve the form7 inputs
    $maladieSys = isset($_POST["maladieSys"]) ? $_POST["maladieSys"] : null;
    $maladieSysValue = isset($_POST["maladieSysValue"]) ? $_POST["maladieSysValue"] : null;
    $infectieuse = isset($_POST["infectieuse"]) ? $_POST["infectieuse"] : null;
    $infectieuseValue = isset($_POST["infectieuseValue"]) ? $_POST["infectieuseValue"] : null;
    $etiologieAutres = isset($_POST["etiologieAutres"]) ? $_POST["etiologieAutres"] : null;
    $argEtiologie = isset($_POST["argEtiologie"]) ? $_POST["argEtiologie"] : null;

    // Retrieve the form8 inputs
    $corticotherapie = isset($_POST["corticotherapie"]) ? $_POST["corticotherapie"] : null;
    $cortiLocale = isset($_POST["cortiLocale"]) ? $_POST["cortiLocale"] : null;
    $cortiGenerale = isset($_POST["cortiGenerale"]) ? $_POST["cortiGenerale"] : null;
    $bolus = isset($_POST["bolus"]) ? $_POST["bolus"] : null;
    $voieOrale = isset($_POST["voieOrale"]) ? $_POST["voieOrale"] : null;
    $doseInitialValue = isset($_POST["doseInitialValue"]) ? $_POST["doseInitialValue"] : null;
    $immunosuppresseur = isset($_POST["immunosuppresseur"]) ? $_POST["immunosuppresseur"] : null;
    $cyclophosphamide = isset($_POST["cyclophosphamide"]) ? $_POST["cyclophosphamide"] : null;
    $azathioprine = isset($_POST["azathioprine"]) ? $_POST["azathioprine"] : null;
    $ciclosporine = isset($_POST["ciclosporine"]) ? $_POST["ciclosporine"] : null;
    $tnfx = isset($_POST["tnfx"]) ? $_POST["tnfx"] : null;
    $immunAutres = isset($_POST["immunAutres"]) ? $_POST["immunAutres"] : null;
    $antiInfec = isset($_POST["antiInfec"]) ? $_POST["antiInfec"] : null;
    $antiInfecValue = isset($_POST["antiInfecValue"]) ? $_POST["antiInfecValue"] : null;
    $antiInfecAutres = isset($_POST["antiInfecAutres"]) ? $_POST["antiInfecAutres"] : null;
    $biotherapie = isset($_POST["biotherapie"]) ? $_POST["biotherapie"] : null;
    $interferon = isset($_POST["interferon"]) ? $_POST["interferon"] : null;
    $immunoglobulines = isset($_POST["immunoglobulines"]) ? $_POST["immunoglobulines"] : null;
    $proteines = isset($_POST["proteines"]) ? $_POST["proteines"] : null;
    $biotherapieAutres = isset($_POST["biotherapieAutres"]) ? $_POST["biotherapieAutres"] : null;

    // Retrieve the form9 inputs
    $remissionComplete = isset($_POST["remissionComplete"]) ? $_POST["remissionComplete"] : null;
    $remissionPartielle = isset($_POST["remissionPartielle"]) ? $_POST["remissionPartielle"] : null;
    $resistance = isset($_POST["resistance"]) ? $_POST["resistance"] : null;
    $recidive = isset($_POST["recidive"]) ? $_POST["recidive"] : null;
    $sequelles = isset($_POST["sequelles"]) ? $_POST["sequelles"] : null;
    $complication = isset($_POST["complication"]) ? $_POST["complication"] : null;
    $complicationValue = isset($_POST["complicationValue"]) ? $_POST["complicationValue"] : null;
    $recul = isset($_POST["recul"]) ? $_POST["recul"] : null;

    /* 
    **********************************************************
    EXECUTE THE SQL STATEMENT
    **********************************************************
    */

    // insert into patients
    $patientsSql = "insert into `patients` values(NULL, '$lastName','$firstName','$age', '$sexe', '$origin', '$socioEco',
    '$statutMat', '$job', '$userId')";
    $stmt = $con->prepare($patientsSql);
    $stmt->execute();

    // insert into personnels
    $personnelSql = "insert into `personnels` values(NULL, '$MST','$mstValue','$contact', '$priseM', '$priseMValue',
    '$persAutres', 1, '$patientId')";
    $stmt = $con->prepare($personnelSql);
    $stmt->execute();

    // insert into familiaux
    $famSql = "insert into `familiaux` values(NULL, '$antUv','$antUvValue','$famAutres', 2, '$patientId')";
    $stmt = $con->prepare($famSql);
    $stmt->execute();

    // insert into toxiques
    $toxSql = "insert into `toxiques` values(NULL, '$tox','$toxValue', 3, '$patientId')";
    $stmt = $con->prepare($toxSql);
    $stmt->execute();

    // insert into signes_dappel_oculaires
    $sgocSql = "insert into `signes_dappel_oculaires` values(NULL, '$larm','$photophobie', '$blepha', '$dlPerio',
    '$rgOculaire', '$dmVisuelle', '$myio', '$meta', '$cepha', '$flVisuel', '$ATCD', '$cliniqueSoAutres', 1, 
    '$patientId')";
    $stmt = $con->prepare($sgocSql);
    $stmt->execute();

    // insert into signes_dappel_extra_oculaires
    $sgExocSql = "insert into `signes_dappel_extra_oculaires` values(NULL, '$allergie','$signesRh', '$herpes', '$vitiligo',
    '$poliose', '$erytheme', '$pseudoFoll', '$aphtoseB', '$aphtoseG', '$signesNeuro', '$signesPulmo', '$signesORL',
    '$signesCardio', '$signesGyneco', '$signesGastro', 2, '$patientId')";
    $stmt = $con->prepare($sgExocSql);
    $stmt->execute();

    // insert into consultation
    $consultationSql = "insert into `consultations` values(NULL, '$modeInsta','$local', '$localPost', '$Oatteint',
    '$patientId')";
    $stmt = $con->prepare($consultationSql);
    $stmt->execute();

    // insert into av_atteint
    $avAtteintSql = "insert into `av_atteint` values(NULL, '$avAtteint','$diminueValue', '$diminueValueSurDix', 1,
    '$patientId')";
    $stmt = $con->prepare($avAtteintSql);
    $stmt->execute();

    // insert into av_adelphe
    $avAdelpheSql = "insert into `av_adelphe` values(NULL, '$avAdelphe','$adelpheDiminueValue', '$adelpheDiminueValueSurDix', 
    '$hyperLacry', '$hyperConj', '$cerclePeri', '$preciRetrod', '$keratite', '$tyndall', '$hypopion', '$fibrine', 
    '$hypoema', '$synIri','$nodules', '$heterochromie', '$atrophie', '$transparent', '$cataracte', '$normo', '$hypo' ,
    '$hyper', '$goniosy', '$vitreHyalitel', '$oeufsFourmi', '$foyers', '$maculaire', '$vascularite', '$papillite',
    '$sclerite', '$resteExamenClinique', 2, '$patientId')";
    $stmt = $con->prepare($avAdelpheSql);
    $stmt->execute();

    // insert into etiologique
    $etiologiqueSql = "insert into `investigations_etiologique` values(NULL, '$champVisuel','$textCouleur', '$echoOculaire',
    '$erg', '$papille', '$retine', '$EOG', '$PEV', '$PCA', '$angiographie', '$vertIndocyanine', 1, '$patientId')";
    $stmt = $con->prepare($etiologiqueSql);
    $stmt->execute();

    // insert into investigations_biologique
    $biologiqueSql = "insert into `investigations_biologique` values(NULL, '$nfs','$nfsValue', '$glycemie', '$vs', '$vsValue',
    '$crp', '$crpValue', '$epp', '$eppValue','$eca', '$ecaValue', '$bilanCalcique', '$bilanCalciqueValue', '$anca',
    '$aan', '$hla', '$fr', '$idr', '$bilanRenal', '$hvb', '$hvc', '$tpha', '$serologie', '$serologieToxo',
    '$serologieCmv', '$bgsa', '$pathergy', 2, '$patientId')";
    $stmt = $con->prepare($biologiqueSql);
    $stmt->execute();

    // insert into investigations_radiologiques
    $radiologiqueSql = "insert into `investigations_radiologiques` values(NULL, '$rxSinus','$rxSinusValue', '$rxBassin', 
    '$rxBassinValue', '$rxRachis', '$rxRachisValue', '$rxSacro', '$rxSacroValue', '$thoracique','$thoraciqueValue',
    '$investigationsAutres', 3, '$patientId')";
    $stmt = $con->prepare($radiologiqueSql);
    $stmt->execute();

    // insert into etiologie_retenue
    $etiologieRetSql = "insert into `etiologie_retenue` values(NULL, '$maladieSys','$maladieSysValue', '$infectieuse',
    '$infectieuseValue', '$etiologieAutres', '$argEtiologie', '$patientId')";
    $stmt = $con->prepare($etiologieRetSql);
    $stmt->execute();

    // insert into corticothérapie
    $corticotherapieSql = "insert into `corticothérapie` values(NULL, '$corticotherapie','$cortiLocale', '$cortiGenerale',
    '$bolus', '$voieOrale', '$doseInitialValue', 1, '$patientId')";
    $stmt = $con->prepare($corticotherapieSql);
    $stmt->execute();

    // insert into immunosuppresseur
    $immunSql = "insert into `immunosuppresseur` values(NULL, '$immunosuppresseur','$cyclophosphamide', '$azathioprine',
    '$ciclosporine', '$tnfx', '$immunAutres', 2, '$patientId')";
    $stmt = $con->prepare($immunSql);
    $stmt->execute();

    // insert into anti_infectieux
    $antiInfectieuxSql = "insert into `anti_infectieux` values(NULL, '$antiInfec','$antiInfecValue', '$antiInfecAutres',
    3, '$patientId')";
    $stmt = $con->prepare($antiInfectieuxSql);
    $stmt->execute();

    // insert into biothérapie
    $biotherapieSql = "insert into `biothérapie` values(NULL, '$biotherapie','$interferon', '$immunoglobulines',
    '$proteines', '$biotherapieAutres', 4, '$patientId')";
    $stmt = $con->prepare($biotherapieSql);
    $stmt->execute();

    // insert into evolutions
    $evolutionsSql = "insert into `evolutions` values(NULL, '$remissionComplete','$remissionPartielle', '$resistance',
    '$recidive', '$sequelles', '$complication', '$complicationValue', '$recul', '$patientId')";
    $stmt = $con->prepare($evolutionsSql);
    $stmt->execute();


    /* 
    **********************************************************
    CLOSE THE CONNECTION
    **********************************************************
    */
    $stmt->close();
    $con->close();

    /* 
    **********************************************************
    DISPLAY A SUCCESS MESSAGE
    **********************************************************
    */
    header("Location: success.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- adding css files -->
    <link rel="stylesheet" href="../css/global-rules.css">
    <link rel="stylesheet" href="../css/home.css">
    <!-- adding inline style -->
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center
        }
    </style>
    <!-- adding google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300&display=swap"
        rel="stylesheet">
    <!-- adding fonts-awesome library -->
    <script src="https://kit.fontawesome.com/687c4d88d6.js" crossorigin="anonymous"></script>
    <title>Accueil</title>
</head>

<body>
    <div class="container">
        <h2 class="usernameText">Bienvenue,
            <span style="color: var(--blue-jeans); margin-left: 10px;">
                <?php echo $_SESSION['username'] ?>
            </span>
        </h2>
        <form method="POST" onsubmit="return validateform()">
            <div class="formDiv" name="mainForm">

                <!-- start identite -->
                <div class="form identite active" name="form1" method="POST">
                    <h2 class="main-title">Identite du patient</h2>
                    <div class="identiteInput">

                        <label for="lName">Nom
                            <input type="text" name="lName" id="lName">
                        </label>

                        <label for="fName">Prénom
                            <input type="text" name="fName" id="fName">
                        </label>


                        <label for="age">Age
                            <input type="number" name="age" id="age">
                        </label>

                        <label class="sexe radioFlex">Sexe
                            <label for="homme" class="answer">
                                <input type="radio" name="gender" id="homme" value="Homme">
                                Homme
                            </label>
                            <label for="femme" class="answer">
                                <input type="radio" name="gender" id="femme" value="Femme" >
                                Femme
                            </label>
                        </label>

                        <label for="origin">Origine géographique
                            <input type="text" name="origin" id="origin" >
                        </label>

                        <label for="haut" class="radioFlex">Niveau socio-économique
                            <label for="haut" class="answer">
                                <input type="radio" name="socioEco" id="haut" value="Haut" >
                                Haut
                            </label>
                            <label for="moyen" class="answer">
                                <input type="radio" name="socioEco" id="moyen" value="Moyen" >
                                Moyen
                            </label>
                            <label for="bas" class="answer">
                                <input type="radio" name="socioEco" id="bas" value="Bas" >
                                Bas
                            </label>
                        </label>

                        <label for="married" class="radioFlex">Statut matrimonial
                            <label for="married" class="answer">
                                <input type="radio" name="statutMat" id="married" value="Marié" >
                                Marié
                            </label>
                            <label for="single" class="answer">
                                <input type="radio" name="statutMat" id="single" value="Célibataire" >
                                Célibataire
                            </label>
                            <label for="divorced" class="answer">
                                <input type="radio" name="statutMat" id="divorced" value="Divorcé" >
                                Divorcé
                            </label>
                            <label for="veuf" class="answer">
                                <input type="radio" name="statutMat" id="veuf" value="Veuf" >
                                Veuf
                            </label>
                        </label>

                        <label for="job">Profession
                            <input type="text" name="job" id="job" >
                        </label>
                    </div>
                </div>

                <!-- start antecedent -->
                <div class="form antecedents" name="form2" method="POST">
                    <h2 class="main-title">Antecedents</h2>

                    <div class="anteInput">

                        <h3 class="alt-title">1) Personnels</h3>
                        <span class="special">Mode de vie</span>

                        <label for="mstOui" class="radioFlex">MST
                            <label for="mstOui" class="answer">
                                <input type="radio" name="MST" id="mstOui" value="Oui" >
                                Oui
                            </label>
                            <label for="mstNon" class="answer">
                                <input type="radio" name="MST" id="mstNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="mstValue" class="mstValueLabel hidden">Laquelle?
                            <input type="text" name="mstValue" id="mstValue" class="hidden">
                        </label>


                        <label for="contactOui" class="radioFlex">Contact avec les chats
                            <label for="contactOui" class="answer">
                                <input type="radio" name="contact" id="contactOui" value="Oui" >
                                Oui
                            </label>
                            <label for="contactNon" class="answer">
                                <input type="radio" name="contact" id="contactNon" value="Non" >
                                Non
                            </label>
                        </label>


                        <label for="priseOui" class="radioFlex">Prise médicamenteuse
                            <label for="priseOui" class="answer">
                                <input type="radio" name="priseM" id="priseOui" value="Oui" >
                                Oui
                            </label>
                            <label for="priseNon" class="answer">
                                <input type="radio" name="priseM" id="priseNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="priseMValue" class="priseMValueLabel hidden">Préciser
                            <input type="text" name="priseMValue" id="priseMValue" class="hidden">
                        </label>



                        <label for="persAutres">Autres
                            <input type="text" name="persAutres" id="persAutres">
                        </label>


                        <h3 class="alt-title">2) Familiaux</h3>
                        <label for="antUvOui" class="radioFlex">Antécédent d’uvéite
                            <label for="antUvOui" class="answer">
                                <input type="radio" name="antUv" id="antUvOui" value="Oui" >
                                Oui
                            </label>
                            <label for="antUvNon" class="answer">
                                <input type="radio" name="antUv" id="antUvNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="antUvValue" class="antUvValueLabel hidden">Chez qui?
                            <input type="text" name="antUvValue" id="antUvValue">
                        </label>


                        <label for="famAutres">Autres
                            <input type="text" name="famAutres" id="famAutres">
                        </label>


                        <h3 class="alt-title">3) Toxiques</h3>
                        <label for="toxOui" class="radioFlex">Toxiques
                            <label for="toxOui" class="answer">
                                <input type="radio" name="tox" id="toxOui" value="Oui" >
                                Oui
                            </label>
                            <label for="toxNon" class="answer">
                                <input type="radio" name="tox" id="toxNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="toxValue" class="toxValueLabel hidden">Lequel?
                            <input type="text" name="toxValue" id="toxValue">
                        </label>
                    </div>
                </div>

                <!-- start clinique -->
                <div class="form clinique" name="form3" method="POST">
                    <h2 class="main-title">Clinique</h2>

                    <div class="cliniqueInput">
                        <span class="special">Signes d’appel oculaires</span>

                        <label for="larmOui" class="radioFlex">Larmoiement
                            <label for="larmOui" class="answer">
                                <input type="radio" name="larm" id="larmOui" value="Oui" >
                                Oui
                            </label>
                            <label for="larmNon" class="answer">
                                <input type="radio" name="larm" id="larmNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="photoOui" class="radioFlex">Photophobie
                            <label for="photoOui" class="answer">
                                <input type="radio" name="photophobie" id="photoOui" value="Oui" >
                                Oui
                            </label>
                            <label for="photoNon" class="answer">
                                <input type="radio" name="photophobie" id="photoNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="blephaOui" class="radioFlex">Blépharospasme
                            <label for="blephaOui" class="answer">
                                <input type="radio" name="blepha" id="blephaOui" value="Oui" >
                                Oui
                            </label>
                            <label for="blephaNon" class="answer">
                                <input type="radio" name="blepha" id="blephaNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="dlPerioOui" class="radioFlex">Douleurs périorbitaire
                            <label for="dlPerioOui" class="answer">
                                <input type="radio" name="dlPerio" id="dlPerioOui" value="Oui" >
                                Oui
                            </label>
                            <label for="dlPerioNon" class="answer">
                                <input type="radio" name="dlPerio" id="dlPerioNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="rgOculaireOui" class="radioFlex">Rougeur oculaire
                            <label for="rgOculaireOui" class="answer">
                                <input type="radio" name="rgOculaire" id="rgOculaireOui" value="Oui" >
                                Oui
                            </label>
                            <label for="rgOculaireNon" class="answer">
                                <input type="radio" name="rgOculaire" id="rgOculaireNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="dmVisuelleOui" class="radioFlex">Diminution de l’acuité visuelle
                            <label for="dmVisuelleOui" class="answer">
                                <input type="radio" name="dmVisuelle" id="dmVisuelleOui" value="Oui" >
                                Oui
                            </label>
                            <label for="dmVisuelleNon" class="answer">
                                <input type="radio" name="dmVisuelle" id="dmVisuelleNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="myioOui" class="radioFlex">Myiodésopsie
                            <label for="myioOui" class="answer">
                                <input type="radio" name="myio" id="myioOui" value="Oui" >
                                Oui
                            </label>
                            <label for="myioNon" class="answer">
                                <input type="radio" name="myio" id="myioNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="metaOui" class="radioFlex">Métamorphopsie
                            <label for="metaOui" class="answer">
                                <input type="radio" name="meta" id="metaOui" value="Oui" >
                                Oui
                            </label>
                            <label for="metaNon" class="answer">
                                <input type="radio" name="meta" id="metaNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cephaOui" class="radioFlex">Céphalées
                            <label for="cephaOui" class="answer">
                                <input type="radio" name="cepha" id="cephaOui" value="Oui" >
                                Oui
                            </label>
                            <label for="cephaNon" class="answer">
                                <input type="radio" name="cepha" id="cephaNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="flVisuelOui" class="radioFlex">Flou visuel
                            <label for="flVisuelOui" class="answer">
                                <input type="radio" name="flVisuel" id="flVisuelOui" value="Oui" >
                                Oui
                            </label>
                            <label for="flVisuelNon" class="answer">
                                <input type="radio" name="flVisuel" id="flVisuelNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="ATCDoui" class="radioFlex">ATCD d’uvéite
                            <label for="ATCDoui" class="answer">
                                <input type="radio" name="ATCD" id="ATCDoui" value="Oui" >
                                Oui
                            </label>
                            <label for="ATCDnon" class="answer">
                                <input type="radio" name="ATCD" id="ATCDnon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cliniqueSoAutres">Autres
                            <input type="text" name="cliniqueSoAutres" id="cliniqueSoAutres">
                        </label>

                        <span class="special" style="margin-top: 20px;">Signes d’appel extra-oculaires</span>
                        <label for="allergieOui" class="radioFlex">Allergie
                            <label for="allergieOui" class="answer">
                                <input type="radio" name="allergie" id="allergieOui" value="Oui" >
                                Oui
                            </label>
                            <label for="allergieNon" class="answer">
                                <input type="radio" name="allergie" id="allergieNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesRhOui" class="radioFlex">Signes rhumatologiques
                            <label for="signesRhOui" class="answer">
                                <input type="radio" name="signesRh" id="signesRhOui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesRhNon" class="answer">
                                <input type="radio" name="signesRh" id="signesRhNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="herpesOui" class="radioFlex">Herpès
                            <label for="herpesOui" class="answer">
                                <input type="radio" name="herpes" id="herpesOui" value="Oui" >
                                Oui
                            </label>
                            <label for="herpesNon" class="answer">
                                <input type="radio" name="herpes" id="herpesNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Signes dermatologiques</h3>
                        <label for="vitiligoOui" class="radioFlex">Vitiligo
                            <label for="vitiligoOui" class="answer">
                                <input type="radio" name="vitiligo" id="vitiligoOui" value="Oui" >
                                Oui
                            </label>
                            <label for="vitiligoNon" class="answer">
                                <input type="radio" name="vitiligo" id="vitiligoNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="polioseOui" class="radioFlex">Poliose
                            <label for="polioseOui" class="answer">
                                <input type="radio" name="poliose" id="polioseOui" value="Oui" >
                                Oui
                            </label>
                            <label for="polioseNon" class="answer">
                                <input type="radio" name="poliose" id="polioseNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="erythemeOui" class="radioFlex">Erythème noueux
                            <label for="erythemeOui" class="answer">
                                <input type="radio" name="erytheme" id="erythemeOui" value="Oui" >
                                Oui
                            </label>
                            <label for="erythemeNon" class="answer">
                                <input type="radio" name="erytheme" id="erythemeNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="pseudoFollOui" class="radioFlex">Pseudo folliculite
                            <label for="pseudoFollOui" class="answer">
                                <input type="radio" name="pseudoFoll" id="pseudoFollOui" value="Oui" >
                                Oui
                            </label>
                            <label for="pseudoFollNon" class="answer">
                                <input type="radio" name="pseudoFoll" id="pseudoFollNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="aphtoseBOui" class="radioFlex">Aphtose buccale
                            <label for="aphtoseBOui" class="answer">
                                <input type="radio" name="aphtoseB" id="aphtoseBOui" value="Oui" >
                                Oui
                            </label>
                            <label for="aphtoseBNon" class="answer">
                                <input type="radio" name="aphtoseB" id="aphtoseBNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="aphtoseGOui" class="radioFlex">Aphtose génitale
                            <label for="aphtoseGOui" class="answer">
                                <input type="radio" name="aphtoseG" id="aphtoseGOui" value="Oui" >
                                Oui
                            </label>
                            <label for="aphtoseGNon" class="answer">
                                <input type="radio" name="aphtoseG" id="aphtoseGNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesNeuroOui" class="radioFlex">Signes neurologiques
                            <label for="signesNeuroOui" class="answer">
                                <input type="radio" name="signesNeuro" id="signesNeuroOui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesNeuroNon" class="answer">
                                <input type="radio" name="signesNeuro" id="signesNeuroNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesPulmoOui" class="radioFlex">Signes pulmonaires
                            <label for="signesPulmoOui" class="answer">
                                <input type="radio" name="signesPulmo" id="signesPulmoOui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesPulmoNon" class="answer">
                                <input type="radio" name="signesPulmo" id="signesPulmoNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesORLoui" class="radioFlex">Signes ORL (surdité de perception)
                            <label for="signesORLoui" class="answer">
                                <input type="radio" name="signesORL" id="signesORLoui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesORLnon" class="answer">
                                <input type="radio" name="signesORL" id="signesORLnon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesCardioOui" class="radioFlex">Signes cardio vasculaires
                            <label for="signesCardioOui" class="answer">
                                <input type="radio" name="signesCardio" id="signesCardioOui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesCardioNon" class="answer">
                                <input type="radio" name="signesCardio" id="signesCardioNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesGynecoOui" class="radioFlex">Signes gynéco urinaires
                            <label for="signesGynecoOui" class="answer">
                                <input type="radio" name="signesGyneco" id="signesGynecoOui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesGynecoNon" class="answer">
                                <input type="radio" name="signesGyneco" id="signesGynecoNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="signesGastroOui" class="radioFlex">Signes gastro intestinaux
                            <label for="signesGastroOui" class="answer">
                                <input type="radio" name="signesGastro" id="signesGastroOui" value="Oui" >
                                Oui
                            </label>
                            <label for="signesGastroNon" class="answer">
                                <input type="radio" name="signesGastro" id="signesGastroNon" value="Non" >
                                Non
                            </label>
                        </label>
                    </div>
                </div>

                <!-- start consultation -->
                <div class="form consultation" name="form4" method="POST">
                    <h2 class="main-title">Delai de consultation</h2>

                    <div class="consultationInput">
                        <span class="special">Mode Evolutif</span>
                        <label for="modeInstaAigu" class="radioFlex smaller">Mode d’installation
                            <label for="modeInstaAigu" class="answer smaller">
                                <input type="radio" name="modeInsta" id="modeInstaAigu" value="Aigu" >
                                Aigu
                            </label>
                            <label for="modeInstaPro" class="answer smaller">
                                <input type="radio" name="modeInsta" id="modeInstaPro" value="Progressif" >
                                Progressif
                            </label>
                        </label>

                        <label for="localUni" class="radioFlex smaller">Localisation
                            <label for="localUni" class="answer smaller">
                                <input type="radio" name="local" id="localUni" value="Unilatérale" >
                                Unilatérale
                            </label>
                            <label for="localBil" class="answer smaller">
                                <input type="radio" name="local" id="localBil" value="Bilatérale" >
                                Bilatérale
                            </label>
                            <label for="localBas" class="answer smaller">
                                <input type="radio" name="local" id="localBas" value="À bascule" >
                                À bascule
                            </label>
                        </label>

                        <label for="localPostAnt" class="radioFlex smaller">Localisation antéro post
                            <label for="localPostAnt" class="answer smaller">
                                <input type="radio" name="localPost" id="localPostAnt" value="Antérieure" >
                                Antérieure
                            </label>
                            <label for="localPostInter" class="answer smaller">
                                <input type="radio" name="localPost" id="localPostInter" value="Intermédiaire" >
                                Intermédiaire
                            </label>
                            <label for="localPostPost" class="answer smaller">
                                <input type="radio" name="localPost" id="localPostPost" value="Postérieure" >
                                Postérieure
                            </label>
                            <label for="localPostTot" class="answer smaller">
                                <input type="radio" name="localPost" id="localPostTot" value="Totale" >
                                Totale
                            </label>
                        </label>

                        <label for="OatteintOD" class="radioFlex smaller">Œil atteint
                            <label for="OatteintOD" class="answer smaller">
                                <input type="radio" name="Oatteint" id="OatteintOD" value="OD" >
                                OD
                            </label>
                            <label for="OatteintOG" class="answer smaller">
                                <input type="radio" name="Oatteint" id="OatteintOG" value="OG" >
                                OG
                            </label>
                            <label for="OatteintODOG" class="answer smaller">
                                <input type="radio" name="Oatteint" id="OatteintODOG" value="OD+OG" >
                                OD+OG
                            </label>
                        </label>

                    </div>
                </div>

                <!-- start examen-clinique -->
                <div class="form examen-clinique" name="form5" method="POST">
                    <h2 class="main-title">Examen-clinique</h2>

                    <div class="examen-cliniqueInput">
                        <span class="special">Examen ophtalmologique</span>
                        <label for="avAtteintNormal" class="radioFlex">AV pour l’œil atteint
                            <label for="avAtteintNormal" class="answer">
                                <input type="radio" name="avAtteint" id="avAtteintNormal" value="Normal" >
                                Normal
                            </label>
                            <label for="avAtteintDiminue" class="answer">
                                <input type="radio" name="avAtteint" id="avAtteintDiminue" value="Diminué" >
                                Diminué
                            </label>
                        </label>
                        <div class="avAtteintDiminue hidden">
                            <label for="diminueValuePL" class="answer">
                                <input type="radio" name="diminueValue" id="diminueValuePL" value="PL+">
                                PL+
                            </label>
                            <label for="diminueValueMDD" class="answer">
                                <input type="radio" name="diminueValue" id="diminueValueMDD" value="MDD">
                                MDD
                            </label>
                            <label for="diminueValueCLD" class="answer">
                                <input type="radio" name="diminueValue" id="diminueValueCLD" value="CLD">
                                CLD
                            </label>
                        </div>
                        <label for="diminueValueSurDix" class="diminueValueSurDixLabel hidden">Sur 10
                            <input type="number" name="diminueValueSurDix" id="diminueValueSurDix">
                        </label>

                        <label for="avAdelpheNormal" class="radioFlex">AV pour l’œil adelphe
                            <label for="avAdelpheNormal" class="answer">
                                <input type="radio" name="avAdelphe" id="avAdelpheNormal" value="Normal" >
                                Normal
                            </label>
                            <label for="avAdelpheDiminue" class="answer">
                                <input type="radio" name="avAdelphe" id="avAdelpheDiminue" value="Diminué" >
                                Diminué
                            </label>
                        </label>
                        <div class="avAdelpheDiminue hidden">
                            <label for="adelpheDiminueValuePL" class="answer">
                                <input type="radio" name="adelpheDiminueValue" id="adelpheDiminueValuePL" value="PL+">
                                PL+
                            </label>
                            <label for="adelpheDiminueValueMDD" class="answer">
                                <input type="radio" name="adelpheDiminueValue" id="adelpheDiminueValueMDD" value="MDD">
                                MDD
                            </label>
                            <label for="adelpheDiminueValueCDD" class="answer">
                                <input type="radio" name="adelpheDiminueValue" id="adelpheDiminueValueCDD" value="CLD">
                                CLD
                            </label>
                        </div>
                        <label for="adelpheDiminueValueSurDix" class="adelpheDiminueValueSurDixLabel hidden">Sur 10
                            <input type="number" name="adelpheDiminueValueSurDix" id="adelpheDiminueValueSurDix">
                        </label>

                        <label for="hyperLacryOui" class="radioFlex">Hypertrophie des glandes lacrymales
                            <label for="hyperLacryOui" class="answer">
                                <input type="radio" name="hyperLacry" id="hyperLacryOui" value="Oui" >
                                Oui
                            </label>
                            <label for="hyperLacryNon" class="answer">
                                <input type="radio" name="hyperLacry" id="hyperLacryNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Conjonctive : OD OG</h3>
                        <label for="hyperConjOui" class="radioFlex">Hyperhémie conjonctivale
                            <label for="hyperConjOui" class="answer">
                                <input type="radio" name="hyperConj" id="hyperConjOui" value="Oui" >
                                Oui
                            </label>
                            <label for="hyperConjNon" class="answer">
                                <input type="radio" name="hyperConj" id="hyperConjNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cerclePeriOui" class="radioFlex">Cercle périkératique
                            <label for="cerclePeriOui" class="answer">
                                <input type="radio" name="cerclePeri" id="cerclePeriOui" value="Oui" >
                                Oui
                            </label>
                            <label for="cerclePeriNon" class="answer">
                                <input type="radio" name="cerclePeri" id="cerclePeriNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Cornée : OD OG</h3>
                        <label for="preciRetrodOui" class="radioFlex">Précipités rétrodescémétique
                            <label for="preciRetrodOui" class="answer">
                                <input type="radio" name="preciRetrod" id="preciRetrodOui" value="Oui" >
                                Oui
                            </label>
                            <label for="preciRetrodNon" class="answer">
                                <input type="radio" name="preciRetrod" id="preciRetrodNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="keratiteOui" class="radioFlex">Kératite
                            <label for="keratiteOui" class="answer">
                                <input type="radio" name="keratite" id="keratiteOui" value="Oui" >
                                Oui
                            </label>
                            <label for="keratiteNon" class="answer">
                                <input type="radio" name="keratite" id="keratiteNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Chambre Ant : OD OG</h3>
                        <label for="tyndallOui" class="radioFlex">Tyndall
                            <label for="tyndallOui" class="answer">
                                <input type="radio" name="tyndall" id="tyndallOui" value="Oui" >
                                Oui
                            </label>
                            <label for="tyndallNon" class="answer">
                                <input type="radio" name="tyndall" id="tyndallNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="hypopionOui" class="radioFlex">hypopion
                            <label for="hypopionOui" class="answer">
                                <input type="radio" name="hypopion" id="hypopionOui" value="Oui" >
                                Oui
                            </label>
                            <label for="hypopionNon" class="answer">
                                <input type="radio" name="hypopion" id="hypopionNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="fibrineOui" class="radioFlex">fibrine
                            <label for="fibrineOui" class="answer">
                                <input type="radio" name="fibrine" id="fibrineOui" value="Oui" >
                                Oui
                            </label>
                            <label for="fibrineNon" class="answer">
                                <input type="radio" name="fibrine" id="fibrineNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="hypoemaOui" class="radioFlex">hypoéma
                            <label for="hypoemaOui" class="answer">
                                <input type="radio" name="hypoema" id="hypoemaOui" value="Oui" >
                                Oui
                            </label>
                            <label for="hypoemaNon" class="answer">
                                <input type="radio" name="hypoema" id="hypoemaNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Iris : OD OG</h3>
                        <label for="synIriOui" class="radioFlex">Synéchies iridocristalinienne
                            <label for="synIriOui" class="answer">
                                <input type="radio" name="synIri" id="synIriOui" value="Oui" >
                                Oui
                            </label>
                            <label for="synIriNon" class="answer">
                                <input type="radio" name="synIri" id="synIriNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="nodulesOui" class="radioFlex">Nodules
                            <label for="nodulesOui" class="answer">
                                <input type="radio" name="nodules" id="nodulesOui" value="Oui" >
                                Oui
                            </label>
                            <label for="nodulesNon" class="answer">
                                <input type="radio" name="nodules" id="nodulesNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="heterochromieOui" class="radioFlex">Hétérochromie
                            <label for="heterochromieOui" class="answer">
                                <input type="radio" name="heterochromie" id="heterochromieOui" value="Oui" >
                                Oui
                            </label>
                            <label for="heterochromieNon" class="answer">
                                <input type="radio" name="heterochromie" id="heterochromieNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="atrophieOui" class="radioFlex">Atrophie
                            <label for="atrophieOui" class="answer">
                                <input type="radio" name="atrophie" id="atrophieOui" value="Oui" >
                                Oui
                            </label>
                            <label for="atrophieNon" class="answer">
                                <input type="radio" name="atrophie" id="atrophieNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Cristallin : OD OG</h3>
                        <label for="transparentOui" class="radioFlex">Transparent
                            <label for="transparentOui" class="answer">
                                <input type="radio" name="transparent" id="transparentOui" value="Oui" >
                                Oui
                            </label>
                            <label for="transparentNon" class="answer">
                                <input type="radio" name="transparent" id="transparentNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cataracteOui" class="radioFlex">Cataracte
                            <label for="cataracteOui" class="answer">
                                <input type="radio" name="cataracte" id="cataracteOui" value="Oui" >
                                Oui
                            </label>
                            <label for="cataracteNon" class="answer">
                                <input type="radio" name="cataracte" id="cataracteNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Tonus oculaire : OD OG</h3>
                        <label for="normoOui" class="radioFlex">Normo
                            <label for="normoOui" class="answer">
                                <input type="radio" name="normo" id="normoOui" value="Oui" >
                                Oui
                            </label>
                            <label for="normoNon" class="answer">
                                <input type="radio" name="normo" id="normoNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="hypoOui" class="radioFlex">Hypo
                            <label for="hypoOui" class="answer">
                                <input type="radio" name="hypo" id="hypoOui" value="Oui" >
                                Oui
                            </label>
                            <label for="hypoNon" class="answer">
                                <input type="radio" name="hypo" id="hypoNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="hyperOui" class="radioFlex">Hyper
                            <label for="hyperOui" class="answer">
                                <input type="radio" name="hyper" id="hyperOui" value="Oui" >
                                Oui
                            </label>
                            <label for="hyperNon" class="answer">
                                <input type="radio" name="hyper" id="hyperNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Oniroscopie : OD OG</h3>
                        <label for="goniosyOui" class="radioFlex">goniosynéchie
                            <label for="goniosyOui" class="answer">
                                <input type="radio" name="goniosy" id="goniosyOui" value="Oui" >
                                Oui
                            </label>
                            <label for="goniosyNon" class="answer">
                                <input type="radio" name="goniosy" id="goniosyNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Vitré : OD OG</h3>
                        <label for="vitreHyalitelOui" class="radioFlex">hyalite
                            <label for="vitreHyalitelOui" class="answer">
                                <input type="radio" name="vitreHyalitel" id="vitreHyalitelOui" value="Oui" >
                                Oui
                            </label>
                            <label for="vitreHyalitelNon" class="answer">
                                <input type="radio" name="vitreHyalitel" id="vitreHyalitelNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="oeufsFourmiOui" class="radioFlex">œufs de fourmi
                            <label for="oeufsFourmiOui" class="answer">
                                <input type="radio" name="oeufsFourmi" id="oeufsFourmiOui" value="Oui" >
                                Oui
                            </label>
                            <label for="oeufsFourmiNon" class="answer">
                                <input type="radio" name="oeufsFourmi" id="oeufsFourmiNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <h3 class="alt-title">Rétine : OD OG</h3>
                        <label for="foyersOui" class="radioFlex">foyers choriorétinites
                            <label for="foyersOui" class="answer">
                                <input type="radio" name="foyers" id="foyersOui" value="Oui" >
                                Oui
                            </label>
                            <label for="foyersNon" class="answer">
                                <input type="radio" name="foyers" id="foyersNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="maculaireOui" class="radioFlex">œdème maculaire
                            <label for="maculaireOui" class="answer">
                                <input type="radio" name="maculaire" id="maculaireOui" value="Oui" >
                                Oui
                            </label>
                            <label for="maculaireNon" class="answer">
                                <input type="radio" name="maculaire" id="maculaireNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="vasculariteOui" class="radioFlex">Vascularite
                            <label for="vasculariteOui" class="answer">
                                <input type="radio" name="vascularite" id="vasculariteOui" value="Oui" >
                                Oui
                            </label>
                            <label for="vasculariteNon" class="answer">
                                <input type="radio" name="vascularite" id="vasculariteNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="papilliteOui" class="radioFlex">Papillite
                            <label for="papilliteOui" class="answer">
                                <input type="radio" name="papillite" id="papilliteOui" value="Oui" >
                                Oui
                            </label>
                            <label for="papilliteNon" class="answer">
                                <input type="radio" name="papillite" id="papilliteNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="scleriteOui" class="radioFlex">Sclérite
                            <label for="scleriteOui" class="answer">
                                <input type="radio" name="sclerite" id="scleriteOui" value="Oui" >
                                Oui
                            </label>
                            <label for="scleriteNon" class="answer">
                                <input type="radio" name="sclerite" id="scleriteNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="resteExamen-clinique">Reste de l’examen clinique
                            <input type="text" name="resteExamen-clinique" id="resteExamen-clinique">
                        </label>

                    </div>
                </div>

                <!-- start investigation -->
                <div class="form investigations" name="form6" method="POST">
                    <h2 class="main-title">INVESTIGATIONS PARACLINIQUES</h2>

                    <div class="investigationsInput">
                        <span class="special">A visée étiologiques</span>

                        <label for="champVisuel">Champ visuel
                            <input type="text" name="champVisuel" id="champVisuel" >
                        </label>

                        <label for="textCouleur">Text couleur
                            <input type="text" name="textCouleur" id="textCouleur" >
                        </label>

                        <label for="echoOculaire">Echo oculaire
                            <input type="text" name="echoOculaire" id="echoOculaire" >
                        </label>

                        <label for="erg">ERG
                            <input type="text" name="erg" id="erg" >
                        </label>

                        <h3 class="alt-title">OCT :</h3>
                        <label for="papille">Papille
                            <input type="text" name="papille" id="papille" >
                        </label>

                        <label for="retine">Rétine
                            <input type="text" name="retine" id="retine" >
                        </label>

                        <label for="EOG">EOG
                            <input type="text" name="EOG" id="EOG" >
                        </label>

                        <label for="PEV">PEV
                            <input type="text" name="PEV" id="PEV" >
                        </label>

                        <label for="PCA">PCA
                            <input type="text" name="PCA" id="PCA" >
                        </label>

                        <label for="angiographie">Angiographie
                            <input type="text" name="angiographie" id="angiographie" >
                        </label>

                        <label for="vertIndocyanine">Vert d’indocyanine
                            <input type="text" name="vertIndocyanine" id="vertIndocyanine" >
                        </label>

                        <span class="special">Bilans biologiques</span>
                        <label for="nfsNormal" class="radioFlex">NFS
                            <label for="nfsNormal" class="answer">
                                <input type="radio" name="nfs" id="nfsNormal" value="Normal" >
                                Normal
                            </label>
                            <label for="nfsAnormale" class="answer">
                                <input type="radio" name="nfs" id="nfsAnormale" value="Anormale" >
                                Anormale
                            </label>
                        </label>
                        <label for="nfsValue" class="nfsValueLabel hidden">Laquelle?
                            <input type="text" name="nfsValue" id="nfsValue">
                        </label>

                        <label for="glycemieNormale" class="radioFlex">Glycémie
                            <label for="glycemieNormale" class="answer">
                                <input type="radio" name="glycemie" id="glycemieNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="glycemieElevee" class="answer">
                                <input type="radio" name="glycemie" id="glycemieElevee" value="Elevée" >
                                Elevée
                            </label>
                        </label>

                        <label for="vsNormale" class="radioFlex">VS
                            <label for="vsNormale" class="answer">
                                <input type="radio" name="vs" id="vsNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="vsElevee" class="answer">
                                <input type="radio" name="vs" id="vsElevee" value="Elevée" >
                                Elevée
                            </label>
                        </label>
                        <label for="vsValue" class="vsValueLabel hidden">A combien?
                            <input type="text" name="vsValue" id="vsValue">
                        </label>

                        <label for="crpNormale" class="radioFlex">CRP
                            <label for="crpNormale" class="answer">
                                <input type="radio" name="crp" id="crpNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="crpElevee" class="answer">
                                <input type="radio" name="crp" id="crpElevee" value="Elevée" >
                                Elevée
                            </label>
                        </label>
                        <label for="crpValue" class="crpValueLabel hidden">A combien?
                            <input type="text" name="crpValue" id="crpValue">
                        </label>

                        <label for="eppNormale" class="radioFlex">EPP
                            <label for="eppNormale" class="answer">
                                <input type="radio" name="epp" id="eppNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="eppAnormale" class="answer">
                                <input type="radio" name="epp" id="eppAnormale" value="Elevée" >
                                Elevée
                            </label>
                        </label>
                        <label for="eppValue" class="eppValueLabel hidden">Laquelle?
                            <input type="text" name="eppValue" id="eppValue">
                        </label>

                        <label for="ecaNormal" class="radioFlex">ECA
                            <label for="ecaNormal" class="answer">
                                <input type="radio" name="eca" id="ecaNormal" value="Normale" >
                                Normal
                            </label>
                            <label for="ecaAnormal" class="answer">
                                <input type="radio" name="eca" id="ecaAnormal" value="Elevé" >
                                Elevé
                            </label>
                        </label>
                        <label for="ecaValue" class="ecaValueLabel hidden">A combien?
                            <input type="text" name="ecaValue" id="ecaValue">
                        </label>

                        <label for="bilanCalciqueNormal" class="radioFlex">Bilan calcique
                            <label for="bilanCalciqueNormal" class="answer">
                                <input type="radio" name="bilanCalcique" id="bilanCalciqueNormal" value="Normal" >
                                Normal
                            </label>
                            <label for="bilanCalciqueEleve" class="answer">
                                <input type="radio" name="bilanCalcique" id="bilanCalciqueEleve" value="Elevé" >
                                Elevé
                            </label>
                        </label>
                        <label for="bilanCalciqueValue" class="bilanCalciqueValueLabel hidden">A combien?
                            <input type="text" name="bilanCalciqueValue" id="bilanCalciqueValue">
                        </label>

                        <label for="ancaPositif" class="radioFlex">ANCA
                            <label for="ancaPositif" class="answer">
                                <input type="radio" name="anca" id="ancaPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="ancaPositifNegatif" class="answer">
                                <input type="radio" name="anca" id="ancaPositifNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="aanPositif" class="radioFlex">AAN
                            <label for="aanPositif" class="answer">
                                <input type="radio" name="aan" id="aanPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="aanNegatif" class="answer">
                                <input type="radio" name="aan" id="aanNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="hlaPositif" class="radioFlex">HLA B27
                            <label for="hlaPositif" class="answer">
                                <input type="radio" name="hla" id="hlaPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="hlaNegatif" class="answer">
                                <input type="radio" name="hla" id="hlaNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="frPositif" class="radioFlex">FR
                            <label for="frPositif" class="answer">
                                <input type="radio" name="fr" id="frPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="frNegatif" class="answer">
                                <input type="radio" name="fr" id="frNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="idrPositif" class="radioFlex">IDR
                            <label for="idrPositif" class="answer">
                                <input type="radio" name="idr" id="idrPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="idrNegatif" class="answer">
                                <input type="radio" name="idr" id="idrNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="bilanRenalNormal" class="radioFlex">Bilan rénal et hépatique
                            <label for="bilanRenalNormal" class="answer">
                                <input type="radio" name="bilanRenal" id="bilanRenalNormal" value="Normal" >
                                Normal
                            </label>
                            <label for="bilanRenalPerturbe" class="answer">
                                <input type="radio" name="bilanRenal" id="bilanRenalPerturbe" value="Perturbé" >
                                Perturbé
                            </label>
                        </label>

                        <label for="hvbPositif" class="radioFlex">HVB
                            <label for="hvbPositif" class="answer">
                                <input type="radio" name="hvb" id="hvbPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="hvbNegatif" class="answer">
                                <input type="radio" name="hvb" id="hvbNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="hvcPositif" class="radioFlex">HVC
                            <label for="hvcPositif" class="answer">
                                <input type="radio" name="hvc" id="hvcPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="hvcNegatif" class="answer">
                                <input type="radio" name="hvc" id="hvcNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <label for="tphaPositif" class="radioFlex">TPHA / VDRL
                            <label for="tphaPositif" class="answer">
                                <input type="radio" name="tpha" id="tphaPositif" value="Positive" >
                                Positive
                            </label>
                            <label for="tphaNegatif" class="answer">
                                <input type="radio" name="tpha" id="tphaNegatif" value="Négative" >
                                Négative
                            </label>
                        </label>

                        <label for="serologiePositive" class="radioFlex">Sérologie VIH
                            <label for="serologiePositive" class="answer">
                                <input type="radio" name="serologie" id="serologiePositive" value="Positive" >
                                Positive
                            </label>
                            <label for="serologieNegative" class="answer">
                                <input type="radio" name="serologie" id="serologieNegative" value="Négative" >
                                Négative
                            </label>
                        </label>

                        <label for="serologieToxoPositive" class="radioFlex">Sérologie toxoplasmose
                            <label for="serologieToxoPositive" class="answer">
                                <input type="radio" name="serologieToxo" id="serologieToxoPositive" value="Positive" >
                                Positive
                            </label>
                            <label for="serologieToxoNegative" class="answer">
                                <input type="radio" name="serologieToxo" id="serologieToxoNegative" value="Négative" >
                                Négative
                            </label>
                        </label>

                        <label for="serologieCmvPositive" class="radioFlex">Sérologie de CMV
                            <label for="serologieCmvPositive" class="answer">
                                <input type="radio" name="serologieCmv" id="serologieCmvPositive" value="Positive" >
                                Positive
                            </label>
                            <label for="serologieCmvNegative" class="answer">
                                <input type="radio" name="serologieCmv" id="serologieCmvNegative" value="Négative" >
                                Négative
                            </label>
                        </label>

                        <label for="bgsaPositive" class="radioFlex">BGSA
                            <label for="bgsaPositive" class="answer">
                                <input type="radio" name="bgsa" id="bgsaPositive" value="Positive" >
                                Positive
                            </label>
                            <label for="bgsaNegative" class="answer">
                                <input type="radio" name="bgsa" id="bgsaNegative" value="Négative" >
                                Négative
                            </label>
                        </label>

                        <label for="pathergyPositif" class="radioFlex">Pathergy test
                            <label for="pathergyPositif" class="answer">
                                <input type="radio" name="pathergy" id="pathergyPositif" value="Positif" >
                                Positif
                            </label>
                            <label for="pathergyNegatif" class="answer">
                                <input type="radio" name="pathergy" id="pathergyNegatif" value="Négatif" >
                                Négatif
                            </label>
                        </label>

                        <span class="special">Bilans radiologiques</span>
                        <label for="rxSinusNormale" class="radioFlex">RX des sinus
                            <label for="rxSinusNormale" class="answer">
                                <input type="radio" name="rxSinus" id="rxSinusNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="rxSinusAnormale" class="answer">
                                <input type="radio" name="rxSinus" id="rxSinusAnormale" value="Anormale" >
                                Anormale
                            </label>
                        </label>
                        <label for="rxSinusValue" class="rxSinusValueLabel hidden">Quelle anomalie?
                            <input type="text" name="rxSinusValue" id="rxSinusValue">
                        </label>

                        <label for="rxBassinNormale" class="radioFlex">RX du bassin
                            <label for="rxBassinNormale" class="answer">
                                <input type="radio" name="rxBassin" id="rxBassinNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="rxBassinAnormale" class="answer">
                                <input type="radio" name="rxBassin" id="rxBassinAnormale" value="Anormale" >
                                Anormale
                            </label>
                        </label>
                        <label for="rxBassinValue" class="rxBassinValueLabel hidden">Quelle anomalie?
                            <input type="text" name="rxBassinValue" id="rxBassinValue">
                        </label>

                        <label for="rxRachisNormale" class="radioFlex">Rx du rachis lombaire
                            <label for="rxRachisNormale" class="answer">
                                <input type="radio" name="rxRachis" id="rxRachisNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="rxRachisAnormale" class="answer">
                                <input type="radio" name="rxRachis" id="rxRachisAnormale" value="Anormale" >
                                Anormale
                            </label>
                        </label>
                        <label for="rxRachisValue" class="rxRachisValueLabel hidden">Quelle anomalie?
                            <input type="text" name="rxRachisValue" id="rxRachisValue">
                        </label>

                        <label for="rxSacroNormale" class="radioFlex">Rx des sacro iliaques
                            <label for="rxSacroNormale" class="answer">
                                <input type="radio" name="rxSacro" id="rxSacroNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="rxSacroAnormale" class="answer">
                                <input type="radio" name="rxSacro" id="rxSacroAnormale" value="Anormale" >
                                Anormale
                            </label>
                        </label>
                        <label for="rxSacroValue" class="rxSacroValueLabel hidden">Quelle anomalie?
                            <input type="text" name="rxSacroValue" id="rxSacroValue">
                        </label>

                        <label for="thoraciqueNormale" class="radioFlex">TDM thoracique
                            <label for="thoraciqueNormale" class="answer">
                                <input type="radio" name="thoracique" id="thoraciqueNormale" value="Normale" >
                                Normale
                            </label>
                            <label for="thoraciqueAnormale" class="answer">
                                <input type="radio" name="thoracique" id="thoraciqueAnormale" value="Anormale" >
                                Anormale
                            </label>
                        </label>
                        <label for="thoraciqueValue" class="thoraciqueValueLabel hidden">Quelle anomalie?
                            <input type="text" name="thoraciqueValue" id="thoraciqueValue">
                        </label>

                        <label for="investigationsAutres">Autres
                            <input type="text" name="investigationsAutres" id="investigationsAutres">
                        </label>
                    </div>
                </div>

                <!-- start etiologie -->
                <div class="form etiologie" name="form7" method="POST">
                    <h2 class="main-title">Etiologie Retenue</h2>

                    <div class="etiologieInput">
                        <label for="maladieSysOui" class="radioFlex">Maladie systémique
                            <label for="maladieSysOui" class="answer">
                                <input type="radio" name="maladieSys" id="maladieSysOui" value="Oui" >
                                Oui
                            </label>
                            <label for="maladieSysNon" class="answer">
                                <input type="radio" name="maladieSys" id="maladieSysNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="maladieSysValue" class="maladieSysValueLabel hidden">Laquelle?
                            <input type="text" name="maladieSysValue" id="maladieSysValue">
                        </label>

                        <label for="infectieuseOui" class="radioFlex">Infectieuse
                            <label for="infectieuseOui" class="answer">
                                <input type="radio" name="infectieuse" id="infectieuseOui" value="Oui" >
                                Oui
                            </label>
                            <label for="infectieuseNon" class="answer">
                                <input type="radio" name="infectieuse" id="infectieuseNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="infectieuseValue" class="infectieuseValueLabel hidden">Laquelle?
                            <input type="text" name="infectieuseValue" id="infectieuseValue">
                        </label>


                        <label for="etiologieAutres">autres
                            <input type="text" name="etiologieAutres" id="etiologieAutres">
                        </label>

                        <label for="argEtiologie">Arguments en faveur de d'etiologie
                            <textarea name="argEtiologie" id="argEtiologie"></textarea>
                        </label>
                    </div>
                </div>

                <!-- start traitement -->
                <div class="form traitement" name="form8" method="POST">
                    <h2 class="main-title">traitement</h2>

                    <div class="traitementInput">
                        <h3 class="alt-title">Corticothérapie</h3>
                        <label for="corticotherapieOui" class="radioFlex">Corticothérapie
                            <label for="corticotherapieOui" class="answer">
                                <input type="radio" name="corticotherapie" id="corticotherapieOui" value="Oui" >
                                Oui
                            </label>
                            <label for="corticotherapieNon" class="answer">
                                <input type="radio" name="corticotherapie" id="corticotherapieNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cortiLocaleOui" class="radioFlex">Locale
                            <label for="cortiLocaleOui" class="answer">
                                <input type="radio" name="cortiLocale" id="cortiLocaleOui" value="Oui" >
                                Oui
                            </label>
                            <label for="cortiLocaleNon" class="answer">
                                <input type="radio" name="cortiLocale" id="cortiLocaleNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cortiGeneraleOui" class="radioFlex">Générale
                            <label for="cortiGeneraleOui" class="answer">
                                <input type="radio" name="cortiGenerale" id="cortiGeneraleOui" value="Oui" >
                                Oui
                            </label>
                            <label for="cortiGeneraleNon" class="answer">
                                <input type="radio" name="cortiGenerale" id="cortiGeneraleNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="bolusOui" class="radioFlex">Bolus
                            <label for="bolusOui" class="answer">
                                <input type="radio" name="bolus" id="bolusOui" value="Oui" >
                                Oui
                            </label>
                            <label for="bolusNon" class="answer">
                                <input type="radio" name="bolus" id="bolusNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="voieOraleOui" class="radioFlex">Voie orale
                            <label for="voieOraleOui" class="answer">
                                <input type="radio" name="voieOrale" id="voieOraleOui" value="Oui" >
                                Oui
                            </label>
                            <label for="voieOraleNon" class="answer">
                                <input type="radio" name="voieOrale" id="voieOraleNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="doseInitialValue" class="radioFlex">Dose initial(mg/kg)
                            <input type="text" name="doseInitialValue" id="doseInitialValue">
                        </label>

                        <h3 class="alt-title">Immunosuppresseur</h3>
                        <label for="immunosuppresseurOui" class="radioFlex">Immunosuppresseur
                            <label for="immunosuppresseurOui" class="answer">
                                <input type="radio" name="immunosuppresseur" id="immunosuppresseurOui" value="Oui" >
                                Oui
                            </label>
                            <label for="immunosuppresseurNon" class="answer">
                                <input type="radio" name="immunosuppresseur" id="immunosuppresseurNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="cyclophosphamideOui" class="radioFlex">Cyclophosphamide
                            <label for="cyclophosphamideOui" class="answer">
                                <input type="radio" name="cyclophosphamide" id="cyclophosphamideOui" value="Oui" >
                                Oui
                            </label>
                            <label for="cyclophosphamideNon" class="answer">
                                <input type="radio" name="cyclophosphamide" id="cyclophosphamideNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="azathioprineOui" class="radioFlex">Azathioprine
                            <label for="azathioprineOui" class="answer">
                                <input type="radio" name="azathioprine" id="azathioprineOui" value="Oui" >
                                Oui
                            </label>
                            <label for="azathioprineNon" class="answer">
                                <input type="radio" name="azathioprine" id="azathioprineNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="ciclosporineOui" class="radioFlex">Ciclosporine
                            <label for="ciclosporineOui" class="answer">
                                <input type="radio" name="ciclosporine" id="ciclosporineOui" value="Oui" >
                                Oui
                            </label>
                            <label for="ciclosporineNon" class="answer">
                                <input type="radio" name="ciclosporine" id="ciclosporineNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="tnfxOui" class="radioFlex">Anti TNFx
                            <label for="tnfxOui" class="answer">
                                <input type="radio" name="tnfx" id="tnfxOui" value="Oui" >
                                Oui
                            </label>
                            <label for="tnfxNon" class="answer">
                                <input type="radio" name="tnfx" id="tnfxNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="immunAutres">Autres
                            <input type="text" name="immunAutres" id="immunAutres">
                        </label>

                        <h3 class="alt-title">Anti infectieux</h3>
                        <label for="antiInfecOui" class="radioFlex">Anti infectieux
                            <label for="antiInfecOui" class="answer">
                                <input type="radio" name="antiInfec" id="antiInfecOui" value="Oui" >
                                Oui
                            </label>
                            <label for="antiInfecNon" class="answer">
                                <input type="radio" name="antiInfec" id="antiInfecNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="antiInfecValue" class="antiInfecValueLabel hidden">Lequel?
                            <input type="text" name="antiInfecValue" id="antiInfecValue">
                        </label>

                        <label for="antiInfecAutres">Autres
                            <input type="text" name="antiInfecAutres" id="antiInfecAutres">
                        </label>

                        <h3 class="alt-title">Biothérapie</h3>
                        <label for="biotherapieOui" class="radioFlex">Biothérapie
                            <label for="biotherapieOui" class="answer">
                                <input type="radio" name="biotherapie" id="biotherapieOui" value="Oui" >
                                Oui
                            </label>
                            <label for="biotherapieNon" class="answer">
                                <input type="radio" name="biotherapie" id="biotherapieNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="interferonOui" class="radioFlex">Interféron
                            <label for="interferonOui" class="answer">
                                <input type="radio" name="interferon" id="interferonOui" value="Oui" >
                                Oui
                            </label>
                            <label for="interferonNon" class="answer">
                                <input type="radio" name="interferon" id="interferonNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="immunoglobulinesOui" class="radioFlex">Immunoglobulines intraveineuses
                            <label for="immunoglobulinesOui" class="answer">
                                <input type="radio" name="immunoglobulines" id="immunoglobulinesOui" value="Oui" >
                                Oui
                            </label>
                            <label for="immunoglobulinesNon" class="answer">
                                <input type="radio" name="immunoglobulines" id="immunoglobulinesNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="proteinesOui" class="radioFlex">Protéines de fusion ( anakinra , Tocilizumab ,
                            Rituximab )
                            <label for="proteinesOui" class="answer">
                                <input type="radio" name="proteines" id="proteinesOui" value="Oui" >
                                Oui
                            </label>
                            <label for="proteinesNon" class="answer">
                                <input type="radio" name="proteines" id="proteinesNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="biotherapieAutres" class="biotherapieAutresLabel hidden">Laquelle?
                            <input type="text" name="biotherapieAutres" id="biotherapieAutres">
                        </label>
                    </div>
                </div>

                <!-- start evolution -->
                <div class="form evolution" name="form9" method="POST">
                    <h2 class="main-title">Evolution</h2>

                    <div class="evolutionInput">
                        <label for="remissionCompleteOui" class="radioFlex">Rémission complète
                            <label for="remissionCompleteOui" class="answer">
                                <input type="radio" name="remissionComplete" id="remissionCompleteOui" value="Oui" >
                                Oui
                            </label>
                            <label for="remissionCompleteNon" class="answer">
                                <input type="radio" name="remissionComplete" id="remissionCompleteNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="remissionPartielleOui" class="radioFlex">Rémission partielle
                            <label for="remissionPartielleOui" class="answer">
                                <input type="radio" name="remissionPartielle" id="remissionPartielleOui" value="Oui" >
                                Oui
                            </label>
                            <label for="remissionPartielleNon" class="answer">
                                <input type="radio" name="remissionPartielle" id="remissionPartielleNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="resistanceOui" class="radioFlex">Résistance
                            <label for="resistanceOui" class="answer">
                                <input type="radio" name="resistance" id="resistanceOui" value="Oui" >
                                Oui
                            </label>
                            <label for="resistanceNon" class="answer">
                                <input type="radio" name="resistance" id="resistanceNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="recidiveOui" class="radioFlex">Récidive
                            <label for="recidiveOui" class="answer">
                                <input type="radio" name="recidive" id="recidiveOui" value="Oui" >
                                Oui
                            </label>
                            <label for="recidiveNon" class="answer">
                                <input type="radio" name="recidive" id="recidiveNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="sequellesOui" class="radioFlex">Séquelles
                            <label for="sequellesOui" class="answer">
                                <input type="radio" name="sequelles" id="sequellesOui" value="Oui" >
                                Oui
                            </label>
                            <label for="sequellesNon" class="answer">
                                <input type="radio" name="sequelles" id="sequellesNon" value="Non" >
                                Non
                            </label>
                        </label>

                        <label for="complicationOui" class="radioFlex">Complication iatrogène
                            <label for="complicationOui" class="answer">
                                <input type="radio" name="complication" id="complicationOui" value="Oui" >
                                Oui
                            </label>
                            <label for="complicationNon" class="answer">
                                <input type="radio" name="complication" id="complicationNon" value="Non" >
                                Non
                            </label>
                        </label>
                        <label for="complicationValue" class="complicationValueLabel hidden">Laquelle?
                            <input type="text" name="complicationValue" id="complicationValue">
                        </label>

                        <label for="recul">Recul (ans)
                            <input type="number" name="recul" id="recul">
                        </label>
                    </div>
                </div>

                <!-- start slider -->
                <div class="slider">
                    <i class="fa-solid fa-arrow-left"></i>
                    <button type="submit" class="submit-button disabled" name="submit">Valider</button>
                    <i class="fa-solid fa-arrow-right">
                    </i>
                </div>

            </div>
        </form>
    </div>
    <script>
        
    </script>
    <script src="../js/home.js"></script>
</body>

</html>