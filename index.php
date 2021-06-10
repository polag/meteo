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
    <?php
    $file_content = file_get_contents("./data/city.list.json", FILE_USE_INCLUDE_PATH);
    $cities = json_decode($file_content);
    
    ?>
    <header>
      
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">happy weather</a>
    </header>
    <main>

        <h1 class="title">Weather forecast for:</h1>
        <form action="forecast.php" method="GET">

            <select id="city" name="city" required>
                <?php
                foreach ($cities as $city) {
                    if ($index > 100) {
                        break;
                    }
                    printf("<option value='%s'>'%s'</option>", $city->id, $city->name);
                    $index++;
                }

                ?>


            </select>
            <input type="submit" value="Show me the weather!" />

        </form>
    </main>

    <!-- Footer -->

    <footer class="white-section" id="footer">
        <div class="container-fluid">
            <i class="fab fa-twitter icon-footer"></i>
            <i class="fab fa-facebook-f icon-footer"></i>
            <i class="fab fa-instagram icon-footer"></i>
            <i class="fas fa-envelope icon-footer"></i>
            <p class="copyright">HappyWeather 2021 by Paula</p>
        </div>
    </footer>
</body>

</html>