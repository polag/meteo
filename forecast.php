<?php
$apiKey = "d8a4825c354251b847d00374efaeb215";

$cityId = $_GET['city'];

$openWeatherMapUrl = "http://api.openweathermap.org/data/2.5/forecast?id={$cityId}&appid={$apiKey}&units=metric";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $openWeatherMapUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Weather</title>
    <!-- Styles -->
    <link rel="stylesheet" href="./style/forecast.style.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300&family=Dancing+Script&family=Montserrat:wght@400;500;600&family=Quicksand:wght@400;500&family=Reenie+Beanie&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/402cc49e6e.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <!--   <div class="brand">
            <span class="brand-title">happy weather</span>
            <a class="go-back" href="/meteo">HOME</a>
        </div>
 -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">happy weather</a>
            <a class="go-back" href="/meteo">HOME</a>

    </header>
    <main>

        <div class="weather-card today">
            <div class="weather-title">
                <img class='weather-icon' src="<?php echo "http://openweathermap.org/img/wn/{$data->list[0]->weather[0]->icon}@2x.png" ?>" alt="<?php echo $data->list[0]->weather[0]->description; ?>" title="<?php echo $data->list[0]->weather[0]->description; ?>" />
                <div class="main-weather">
                    <h2 class="title"><?php echo  $data->city->name; ?></h2>

                    <p><?php echo date("l G:i", $currentTime); ?> - <?php echo date("jS F, Y", $currentTime); ?></p>
                </div>
            </div>
            <div class="weather-today">
                <div class="row">
                    <?php
                    //$time = date("H", $currentTime);
                    $date = $data->list[0]->dt_txt;
                    $time = substr($date, 11, 2);
                    

                    if ($time <= 15) {
                        $restOfDay = 3;
                        $message = "Forecast for today: ";
                    } else if ($time <= 18) {
                        $restOfDay = 2;
                        $message = "Forecast for today: ";
                    } else if ($time <= 21) {
                        $restOfDay = 1;
                        $message = "Forecast for today: ";
                    } else if ($time <= 24) {
                        $restOfDay = 0;
                        $message = "The day is over! Please see the forecast for tomorrow. ";
                    }

                    ?><h3><?php echo $message ?></h3> <?php
                                                        for ($i = 0; $i < $restOfDay; $i++) {
                                                            $date = $data->list[$i]->dt_txt;
                                                            $timeData = substr($date, 11, 2);
                                                        ?>
                        <div class="col">
                            <h4><?php echo $timeData ?>:00</h4>
                            <h4><?php echo ucwords($data->list[$i]->weather[0]->description); ?></h4>
                            <div class="row">
                                <div class="col">
                                    <span><i class="fas fa-temperature-high"></i>Max Temp: <?php echo $data->list[$i]->main->temp_max; ?>km/h<br /></span>
                                    <span><i class="fas fa-temperature-low"></i>Min Temp: <?php echo $data->list[$i]->main->temp_min; ?>C°<br /></span>
                                </div>
                                <div class="col">
                                    <span><i class="fas fa-wind"></i>Wind <?php echo $data->list[$i]->wind->speed; ?>C°<br /></span>
                                    <span><i class="fas fa-tint"></i>Min Temp: <?php echo $data->list[$i]->main->humidity; ?>%<br /></span>
                                </div>


                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="weather-card">
            <div class="weather-forecast">
                <div class="row">
                    <?php $day = date("j", $currentTime);
                    $long = count($data->list);

                    for ($i = 0; $i < $long; $i++) {
                        $dateData = $data->list[$i]->dt_txt;
                        $dayData = substr($dateData, 8, 2);
                        $dateDataTime = strtotime($dateData);
                        if ($dayData > $day) {
                    ?>
                            <div class="col">
                                <h3><?php echo date("l j", $dateDataTime); ?></h3>
                                <h4><?php echo ucwords($data->list[$i]->weather[0]->description); ?></h4>
                                <span><i class="fas fa-temperature-high"></i>Max Temp: <?php echo $data->list[$i]->main->temp_max; ?>C°<br /></span>
                                <span><i class="fas fa-temperature-low"></i>Min Temp: <?php echo $data->list[$i]->main->temp_min; ?>C°<br /></span>
                                <span><i class="fas fa-wind"></i>Wind <?php echo $data->list[$i]->wind->speed; ?>C°<br /></span>
                                <span><i class="fas fa-tint"></i>Min Temp: <?php echo $data->list[$i]->main->humidity; ?>%<br /></span>
                            </div>
                    <?php
                            $day = $dayData;
                        }
                    }  ?>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div class="container-fluid">
            <i class="fab fa-twitter icon-footer"></i>
            <i class="fab fa-facebook-f icon-footer"></i>
            <i class="fab fa-instagram icon-footer"></i>
            <i class="fas fa-envelope icon-footer"></i>
            <p class="copyright">HappyWeather 2021 by Paula</p>
        </div>
    </footer>

</body>