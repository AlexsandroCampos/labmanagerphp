<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Computador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="computers.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light lvl0__bg box-shadow mb-5">
            <div class="d-flex justify-content-center align-items-center container">
                <a href="index" class="navbar-brand lvl1__bg p-2 px-3 m-0 rounded-4" asp-area="" asp-controller="Home" asp-action="Index">LabManager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/service/lab.php';
        $labCookie = unserialize($_COOKIE['lab-cookie']);

        foreach ($labCookie as $lab) {
            if ($lab->getId() == $_GET['id']) {
                $labData = $lab;
                break;
            }
        }

        $labId = $labData->getId();
        $name = $labData->getName();
        $number = $labData->getNumber();
        $block = $labData->getBlockId();
    ?>
    <div class="container d-flex justify-content-center align-items-center">
        <main role="main" class="pb-3">
            <form class="d-flex flex-column" action="/service/edit-lab.php" method="post">
                <label class="text-center my-2" for="name">
                  Nome do Laboratório
                  <input class="form-control" type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                </label>
                <label class="text-center my-2" for="number">
                  Numero do Laboratório
                  <input class="form-control" type="number" name="number" value="<?php echo isset($number) ? $number : ''; ?>">
                </label>
                <label class="text-center my-2" for="block_id">
                    ID do Bloco do laboratório
                  <input class="form-control" type="text" name="block_id" value="<?php echo isset($block) ? $block : ''; ?>">
                </label>
                <input type="hidden" name="entity" value="lab">
                <input type="hidden" name="id" value="<?php echo isset($labId) ? $labId : ''; ?>">
            
                <button type="submit" class="btn btn__submit lvl1__bg">Salvar</button>
            </form>
        </main>
    </div>

    <footer class="footer text-muted fixed-bottom pb-3 lvl0__bg pt-3">
        <div class="container">
            &copy; 2023 - LabManager - <a href="privacy">Privacidade</a>
        </div>
    </footer>
</body>
</html>