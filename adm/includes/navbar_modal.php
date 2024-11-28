    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <style>
        /* Navbar */
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
    </style>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
            <a class="navbar-brand" href="home.php"><img src="../img/logo.png" alt="" srcset="" style="width:30px;">Company  
                <span class="dot"  style="color: #8B4513;">
                    Name
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php" style="color:black;">Home</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal1"  aria-hidden="true" style="color:black;">Cad. estoque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal2"  aria-hidden="true" style="color:black;">Cad. cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="exibir_cliente.php" style="color:black;">Exibir cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="exibir.php" style="color:black;">Exibir estoque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="exibir_notasfiscais.php" style="color:black;">Exibir NF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gerar_nota_fiscal.php" style="color:black;">Gerar NF</a>
                    </li>
                    
                </ul>
                <a href="logout.php" style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">
                    Sair
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>

            </div>
        </div>
    </nav>

    <!-- Modal Cadastro Estoque -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container">
                    <h1 style="text-align:center;">Cadastro de Estoque
                        <a href="./" class="btn btn-danger float-end">VOLTAR</a>
                    </h1>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="preco">Valor de Compra:</label>
                                    <input type="text" class="form-control" id="valorcompra" name="valorcompra" placeholder="Digite o preço da compra">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="preco">Valor de Venda:</label>
                                    <input type="text" class="form-control" id="valorvenda" name="valorvenda" placeholder="Digite o preço da venda">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade:</label>
                                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Digite a quantidade">
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="funcao">Função:</label>
                                    <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Digite a funcao">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="detalhe">Detalhe:</label>
                                    <input type="text" class="form-control" id="detalhe" name="detalhe" placeholder="Digite o detalhe">
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="marca">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Digite a marca">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="peso">Peso:</label>
                                    <input type="text" class="form-control" id="peso" name="peso" placeholder="Digite o peso">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagem">imagem:</label>
                            <input type="file" class="form-control" id="imagem" name="imagem">
                        </div>

                        <div style="text-align:center;">
                            <br>
                            <button type="submit" name="save_estoque" class="btn btn-primary">Enviar</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


       <!-- Modal Cadastro Cliente -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="container">
                        <h1 style="text-align:center;">Cadastro de Cliente
                        <a href="./" class="btn btn-danger float-end">VOLTAR</a>
                        </h1>
                        <form action="code.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
                            </div>
                            <div class="form-group">
                                <label for="preco">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o cpf">
                            </div>
                            <div class="form-group">
                                <label for="preco">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Digite o email">
                            </div>
                            <div class="form-group">
                                <label for="preco">Telefone:</label>
                                <input type="text" class="form-control phone" id="telefone" name="telefone" placeholder="Digite o telefone">
                            </div>
                            <div style="text-align:center;">
                                <br>
                                <button type="submit" name="save_cliente" class="btn btn-primary">Enviar</button>
                            </div>

                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const dataAtual = new Date();
        const anoAtual = dataAtual.getFullYear();
        document.getElementById('anoAtual').innerHTML = anoAtual;
    </script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/app.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script>
        $(document).ready(function () { 
            var $seuCampoCpf = $("#cpf");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
        var behavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            }
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };
            $('.phone').mask(behavior, options);
    </script>