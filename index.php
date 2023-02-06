<?php


require './includes/db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];


    $juisteData = checkData($id);

    if (isset($_GET["meterstand"])) {
        $meterstand = $_GET["meterstand"];
        $vorigemeterstand = previousMeterstand($id);


        if ($vorigemeterstand == false) {
            sendData($meterstand, $id);
            echo "Danku voor het invullen van u meterstand";
        } else {
            if (intval($meterstand) > intval($vorigemeterstand["meterstand"])) {
                sendData($meterstand, $id);

                echo "Vorige meterstand = " . ($vorigemeterstand["meterstand"]);

                echo " <br> Bedankt voor het invullen van u meterstand , uw verbruik dit jaar bedraagt = " . (intval($meterstand) - intval($vorigemeterstand["meterstand"]));
            } else echo "Meterstand is niet correct ingevuld";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meterstand</title>
</head>

<body>

    <h1>Meterstand</h1>

    <form action="index.php" method="GET">

        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="text" disabled name="Voornaam" placeholder="Voornaam" value="<?php echo $juisteData["Voornaam"] ?>">
        <input type="text" disabled name="naam" value="<?php echo $juisteData["Naam"] ?>">
        <input type="text" disabled="disabled" name="straatnaam" value="<?php echo $juisteData["Straatnaam"] ?>">
        <input type="text" disabled="disabled" name="Nummerbus" value="<?php echo $juisteData["Nummberbus"] ?>">
        <input type="text" disabled="disabled" name="postcode" value="<?php echo $juisteData["Postcode"] ?>">
        <input type="text" disabled="disabled" name="locatie" value="<?php echo $juisteData["Locatie"] ?>">
        <input type="text" pattern="\d*" maxlength="6" name="meterstand" placeholder="Meterstand" value="">
        <button type="submit">Send</button>


    </form>


    </div>
</body>

</html>