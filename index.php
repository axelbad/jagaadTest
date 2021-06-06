<?php

require __DIR__ . '/vendor/autoload.php';

use App\Classes\Init;
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

$init = new Init();
$forecast_cities = $init->getCityForecast();

foreach ($forecast_cities as $forecast_city) {
        echo 'Processed city ' . $forecast_city['city'] . ' | ';
        echo $forecast_city['today_forecast'] . ' - ' . $forecast_city['tomorrow_forecast'] . '<br><br>';
}
?>
</body>

</html>
