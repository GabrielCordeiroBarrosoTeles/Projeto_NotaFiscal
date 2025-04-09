<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$LinkZap = $_ENV['LINK_ZAP'];
$LinkInsta = $_ENV['LINK_INSTA'];
$LinkGoogle = $_ENV['LINK_GOOGLE'];
$CompanyName = $_ENV['COMPANY_NAME'];

// Lógica para manipular a última palavra do nome da empresa
$palavras = explode(" ", $CompanyName);
$UltimaPalavra = array_pop($palavras);
$PrimeiraParte = implode(" ", $palavras);

$CompanyTelephone = $_ENV['COMPANY_TELEPHONE'];
$CompanyEmailAddress = $_ENV['COMPANY_EMAIL'];
$CompanyCNPJ = $_ENV['COMPANY_CNPJ'];
$CompanyAddress = $_ENV['COMPANY_ADDRESS'];
$IframeAddress = $_ENV['IFRAME_ADDRESS'];
$MessageToSendToTheCompany = $_ENV['MESSAGE_TO_SEND'];
$MessageTheCompanyWantsToPresent = $_ENV['MESSAGE_PRESENT'];
$LogoImagePath = $_ENV['LOGO_PATH'];
?>