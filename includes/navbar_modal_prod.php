<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"><!--Importante, faz os icons aparecerem no footrer-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


<style>
    /* navbar */
.top-nav {
    background-color: var(--brand);
    color: #fff;
    padding-top: 5px;
    padding-bottom: 5px;
}

.top-nav p {
    display: inline-block;
    margin-bottom: 0;
    margin-right: 10px;
}

.top-nav span,
.top-nav i {
    vertical-align: middle;
}

.navbar {
    box-shadow: var(--shadow);
}

.social-icons a {
    width: 28px;
    height: 28px;
    display: inline-flex;
    color: #fff;
    background-color: rgba(255, 255, 255, 0.25);
    text-decoration: none;
    align-items: center;
    justify-content: center;
    border-radius: 100px;
}

.social-icons a:hover {
    background-color: #fff;
    color: var(--brand);
}

.navbar .navbar-nav .nav-link {
    color: var(--dark);
}

.navbar .navbar-nav .nav-link:hover {
    color: var(--brand);
}

.navbar .navbar-nav .nav-link.active {
    color: var(--brand);
}

.navbar-brand {
    font-size: 28px;
    font-weight: 700;
}

.navbar-brand .dot {
    color: var(--brand);
}

.bg-cover {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.nav-item{
    margin:0 25px;
    font-weight:500;
}
.link{
    color:#000;
    transition:0.5s;
}
.link:hover{
    color:#696969;
}
.botao{
    color:#FFFF;
    background-color: #8B4513;
    border: #8B4513;
    padding:7px 19px;
    border-radius:5px;
    text-decoration:none;
    transition:0.2s
}
.botao:hover{
    color:#fff;
    text-decoration:none;
    background:#A0522D;
}



</style>

<link rel="stylesheet" href="css/cadastro.css">

<!-- Navbar 1 -->
<div class="top-nav" id="home" style="background-color: #8B4513;">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="col-auto">
                <p class="contact-info mb-0"><i class='bx bxs-envelope'></i> companyname@gmail.com</p>
                <p class="contact-info mb-0"><i class='bx bxs-phone-call'></i> (85) 9.9999-9999</p>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 576px) {
        .contact-info {
            font-size: 0.8rem;
        }
    }
</style>



<!-- Navbar 2 -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top" style="border-bottom: 0%; z-index: 100;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="font-size: 23px; display: flex; justify-content: center; align-items: center;">
            <img src="./img/logo.png" alt="" srcset="" style="width: 35px; margin-right: 15px">Company
            <span class="dot" style="color: #8B4513;">&nbsp;Name</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <p class="p">
                        <a class="link" style="text-decoration: none;  margin-bottom: 10px;" href="index.php">Home</a>
                    </p>
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
                            <li class="nav-item">
                                <p class="p">
                                    <a class="link" style="text-decoration: none;" href="produto.php?id=<?= $estoque['id']; ?>">
                                        <?= $estoque['funcao']; ?>
                                    </a>
                                </p>
                            </li>
                            <?php
                        }
                    }
                } else {
                    echo "<h5>Nenhum aluno cadastrado</h5>";
                }
                ?>

                <li> 
                    <a href="index.php" class="link botao" style="background-color:red;">
                        <span class="me-2">VOLTAR</span> <!-- Adicionando margem à direita para espaçar o texto -->
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<!-- Modal Login-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-4 col-sm-12 bg-cover" style="background-image: url('img/img1.png'); min-height: 250px;"></div>
                        <div class="col-lg-8">
                            <form class="p-lg-5 col-12 row g-3" action="receber_login.php" method="post">
                                <div>
                                    <h1>Login
                                        <a href="./" class="btn btn-danger float-end">VOLTAR</a>
                                    </h1>
                                    <p>Registre aqui seu login no sistema</p>
                                </div>
                                <div class="col-lg-12">
                                    <label for="userName" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="login" id="userName" aria-describedby="emailHelp">
                                </div>
                                <div class="col-12">
                                    <label for="userPassword" class="form-label">Senha</label>
                                    <input type="password" class="form-control" name="senha" id="userPassword" aria-describedby="emailHelp">
                                </div>   
                                <div class="col-12">
                                    <button type="submit" class="btn btn-brand text-light" style="background-color: #8B4513;border: #8B4513">Logar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

