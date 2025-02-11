<?php
    require 'config.php'; // Importa as configurações do site
?>

<style>
  .tra{
    color: #38AAF2;
  }
  footer {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

footer .footer-top {
    padding-top: 80px;
    padding-bottom: 40px;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 20px;
    padding-top: 20px;
}

footer .navbar-brand {
    color: #fff;
}

footer p {
    color: #ADB3B9;
}

footer .social-icons a {
    width: 50px;
    height: 50px;
    font-size: 20px;
    margin-left: 4px;
    margin-right: 4px;
    
   
}

.loader {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: red;
    z-index: 99999;
    position: fixed;
    left: 0;
    right: 0;
    
}

input.form-control {
    border-color: transparent;
    height: 44px;
}

.form-control {
    background-color: rgba(0, 0, 0, 0.04);
    border-color: rgba(0, 0, 0, 0.04);;
}

.form-control:focus {
    box-shadow: none;
    border-color: var(--brand);
} .embed-responsive {
    position: relative;
    display: block;
    width: 85%;
    padding: 0;
    overflow: hidden;
  }

  .embed-responsive::before {
    display: block;
    content: "";
  }

  .embed-responsive-16by9::before {
    padding-top: 56.25%;
  }

  .embed-responsive-item {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }
</style>
<link rel="stylesheet" href="./css/footer.css">
</div>
<footer class="text-center text-lg-start" style="color:white;background-color:#FFF8E7;">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0" style="text-align:left;">
        <div class="tra">
          <h3 style="color:#8B4513;text-decoration: underline;text-decoration-color: #8B4513;text-underline-offset: 30px;">Navegue</h3>
        </div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="produtos">
          <li class="nav-item">
            <a class="nav-link text-dark" style="text-decoration:none;" href="index.php">Home</a>
          </li>
          <?php
require 'dbcon.php';
$query = "SELECT DISTINCT id, funcao FROM estoque WHERE funcao IN ('Anestésicos', 'Antitóxicos', 'Antimicrobianos', 'Antibióticos');";
$query_run = mysqli_query($mysqli, $query);

$funcoes = array(); // Array para armazenar as funções únicas

if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $estoque) {
        // Verifica se a função já foi adicionada ao array
        if (!in_array($estoque['funcao'], $funcoes)) {
            $funcoes[] = $estoque['funcao']; // Adiciona a função única ao array
            ?>
            <li>
                <a class="nav-link text-dark" style="text-decoration:none;" href="produto.php?id=<?= $estoque['id']; ?>">
                    <?= $estoque['funcao']; ?>
                </a>
            </li>
            <?php
        }
    }
} else {
    echo "<h5>Nenhum aluno cadastrado</h5>";
}
?>
          <li class="nav-item">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"  style="color:#FFFF;background-color: #8B4513;border: #8B4513" class="btn btn-brand">Login</a>
          </li>
        </ul>
        
      </div>
        
      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0 text-left">
        <div class="tra">
          <h3 id="contato" style="color:#8B4513;text-decoration: underline;text-decoration-color: #8B4513;text-underline-offset: 20px;">Contato</h3>
        </div>
        <ul class="list-unstyled mb-0">
          
          <li>
            <a href="#!" class="text-light"> 
              <div class="single-cta">
                <a class="ri-map-pin-2-line icon" id=""  style="color:#8B4513;text-decoration: none" href="#"></a>
                <div class="cta-text">
                  <h4 class="text-dark">Vá para:</h4>
                  <span  class="text-dark">
                    <?php echo $CompanyAddress ; ?>
                  </span>
                </div>
              </div>
            </a>
          </li>
          
          <li>
            <a href="#!" class="text-light">
              <div class="single-cta">
                <a class="ri-phone-line icon" id=""  style="color:#8B4513;text-decoration: none" href="#"></a>
                <div class="cta-text">
                  <h4  class="text-dark">Ligue para:</h4>
                  <span class="text-dark">
                  <?php echo $CompanyTelephone ; ?>
                  </span>
                </div>
              </div>
            </a>
          </li>
          
          <li>
            <a href="#!" class="text-dark">
              <div class="single-cta">
                <a class="ri-mail-line icon" id=""   style="color:#8B4513;text-decoration: none" href="#"></a>
                <div class="cta-text">
                  <h4 class="text-dark">Envie-nos um e-mail:</h4>
                  <span class="text-dark">
                   <?php echo $CompanyEmailAddress ; ?>
                  </span>
                </div>
              </div>
            </a>
          </li>

        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
        <div class="tra">
          <h3 style="color:#8B4513;text-decoration: underline;text-decoration-color: #8B4513;text-underline-offset: 20px;">Localização</h3>
        </div>
        <div class="embed-responsive embed-responsive-16by9">
          <?php echo $IframeAddress; ?>
        </div>
          <div class="col footer-social-icon" style="text-align:center;">
            <a class="ri-whatsapp-line icon" id="zap" href="<?php echo $LinkZap ; ?>" style="text-decoration: none;" ></a>
            <a class="ri-instagram-line icon" id="insta" href="<?php echo $LinkInsta; ?>"></a>
            <a class="icon" href="<?php echo $LinkGoogle; ?>" style="position: relative; top: -12px;"><iconify-icon data-icon="mdi:google-my-business" style="color: #4285F4;"></iconify-icon></a>
          </div>


      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->
  <!-- Copyright -->
<div class="text-center text-light p-3" style="background-color: #632d08;">
    &copy; <span id="anoatual"></span> - <?php echo $CompanyName ; ?> - Todos os Direitos Reservados 
  </div>
</footer>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script>
  const dataAtual = new Date();
  const anoAtual = dataAtual.getFullYear();
  document.getElementById('anoatual').textContent = anoAtual;
</script>
