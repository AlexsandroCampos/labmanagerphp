﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LabManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light lvl0__bg box-shadow mb-3">
            <div class="d-flex justify-content-center align-items-center container">
                <a href="index" class="navbar-brand lvl1__bg p-2 px-3 m-0 rounded-4" asp-area="" asp-controller="Home" asp-action="Index">Lab Manager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>
    <div class="container">
        <main role="main" class="pb-3">
            <section class="row m-auto justify-content-center">
                <div class="col-md-5">
                    <a href="campus.php" class="text-white text-decoration-none">
                        <div class="index__create-button lvl0__bg rounded-4 p-4 mb-2">
                            <h3 class="m-0 text-dark">Criar Campus &#43;</h3>
                        </div>
                    </a>
                    <a href="block.php" class="text-white text-decoration-none">
                        <div class="index__create-button lvl0__bg rounded-4 p-4 my-2">
                            <h3 class="m-0 text-dark">Criar Bloco &#43;</h3>
                        </div>
                    </a>
                    <a href="labs.php" class="text-white text-decoration-none">
                        <div class="index__create-button lvl0__bg rounded-4 p-4 my-2">
                            <h3 class="m-0 text-dark">Criar Laboratório &#43;</h3>
                        </div>
                    </a>
                    <a href="computers.php" class="text-white text-decoration-none">
                        <div class="index__create-button lvl0__bg rounded-4 p-4 mt-2">
                            <h3 class="m-0 text-dark">Criar Computador &#43;</h3>
                        </div>
                    </a>
                </div>
                <div class="col-auto">
                    <div class="vr rounded-5 h-100 bg-dark"></div>
                </div>
                
                <!-- Listagem -->
                <div class="col-md-6">
                    <div class="text-center"><small>Listagem dos Câmpus</small></div>
                    <div class="lvl0__bg p-3 rounded-4">
                        <?php
                            
                        ?>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <footer class="footer text-muted fixed-bottom lvl0__bg pb-3 pt-3">
        <div class="container">
            &copy; 2023 - LabManager - <a href="privacy">Privacidade</a>
        </div>
    </footer>
</body>
</html>