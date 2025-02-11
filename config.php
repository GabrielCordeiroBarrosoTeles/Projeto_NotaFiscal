<?php
    $LinkZap = "https://wa.me/seunumero";
    $LinkInsta="https://instagram.com/seuusuario";
    $LinkGoogle = "https://www.google.com/maps/@-3.6550574,-38.5317037,14z?entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D";
    $CompanyName = "Rancho Star Horse";

    // Logica que divide a string em palavras para manipular a última palavra separadamente e depois juntar tudo novamente com a última palavra em outra cor 
    $palavras = explode(" ", $CompanyName); // Divide as palavras em um array
    $UltimaPalavra = array_pop($palavras); // Remove a última palavra
    $PrimeiraParte = implode(" ", $palavras); // Junta as palavras restantes

    $CompanyTelephone = "(88) 98117-5695";
    $CompanyEmailAddress = "alinenogueira395@gmail.com";
    $CompanyCNPJ = "00.000.000/0000-00";
    // Coloquei uma localização aleatoria
    $CompanyAddress = "Rua sla, 36 - Fortaleza - CE";
    $IframeAddress = "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.3872213515647!2d-38.49223209611422!3d-3.7254579999999886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c748713a15dacd%3A0xbe7146a773ff5307!2sJardim%20Japon%C3%AAs!5e0!3m2!1spt-BR!2sbr!4v1739305245786!5m2!1spt-BR!2sbr' width='220' height='120' style='border:0; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
    $MessageToSendToTheCompany = "Olá, vim do site..."; // Mensagem predefinida que o usuario vai te mandar
    $MessageTheCompanyWantsToPresent = "Orçamento por whattsapp";
    $LogoImagePath = "img/logo.png";
?>