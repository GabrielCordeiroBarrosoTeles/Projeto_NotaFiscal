<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Certifique-se de que este caminho está correto
require_once __DIR__ . '/../config/database.php';

use App\Routing\Router;
use Dotenv\Dotenv; // Import Dotenv

// Load environment variables from .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Debugging: Ensure PHP is running
if (!function_exists('phpinfo')) {
    die("Erro: O PHP não está sendo interpretado corretamente. Verifique a configuração do servidor.");
}

// Set the base URL dynamically
$baseUrl = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = rtrim($baseUrl, '/');
echo "<base href='{$baseUrl}/'>";

// Define the company name
$CompanyName = getenv('COMPANY_NAME');

if (!$CompanyName) {
    error_log("Warning: 'COMPANY_NAME' not found in .env file. Using default value.");
    $CompanyName = 'Default Company Name'; // Fallback to a default value if not set
}

$router = new Router($baseUrl); // Pass the correct base path
require_once __DIR__ . '/../routes/web.php';

try {
    $router->dispatch();
} catch (Exception $e) {
    http_response_code(404);
    echo "404 Not Found - A rota '" . htmlspecialchars($_SERVER['REQUEST_URI']) . "' não foi encontrada.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Home - <?php echo $CompanyName; ?> </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"><!--Importante, faz os icons aparecerem no footrer-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"><!--Importante, faz os icons aparecerem no footrer-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <style>
            ::-webkit-scrollbar{
                width: 10px;
            }::-webkit-scrollbar-track{
                background: #E7DFDD;
                border-radius: 30px;
            }::-webkit-scrollbar-thumb{
                background: #000000;
                border-radius: 30px;
            }
        </style>
    </head>
    <body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70" onload="carregar()">

        <?php include './includes/navbarmodal1.php'?><!--Navbar-->

        <?php include './includes/carousel.php'?><!--Carousel-->

        <?php include './includes/zap.php'?><!--WhatsApp-->
        
        <?php include './includes/cards.php'?><!--Cards-->
     
        <?php include './includes/carouselmarca.php'?><!--CarouselMarca-->

        <?php include './includes/footer.php'?><!--Footer-->

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            function carregar() {
                const dataAtual = new Date();
                const anoAtual = dataAtual.getFullYear();
                document.getElementById('anoatual').textContent = anoAtual;
            }
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
