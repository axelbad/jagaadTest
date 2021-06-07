<?php

require __DIR__ . '/vendor/autoload.php';

use App\Classes\Init;

$init = new Init();
$cities_forecast = $init->getCityForecast();

$isCli = false;
if ($init->isCli()) {
    echo $cities_forecast;
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jagaad Test</title>
</head>

<body>
<?php
    echo $cities_forecast;
?>
</body>

</html>