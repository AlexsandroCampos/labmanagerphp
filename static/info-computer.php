<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhes do Computador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="info-computer.css">
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
    <div class="container">
        <main role="main" class="pb-3">
            <section class="row m-auto justify-content-center">
                <div class="col-12">
                    <?php
                        require_once $_SERVER['DOCUMENT_ROOT'].'/service/computer.php';

                        if(!isset($_COOKIE['computer-cookie']))
                        {
                            header("Location: ../static/computers.php");
                            die();
                        } else {
                            $computerCookie = unserialize($_COOKIE['computer-cookie']);
                            foreach ($computerCookie as $computer) {
                                if ($computer->getId() == $_GET['id']) {
                                    $computerData = $computer;
                                    break;
                                }
                            }

                            $computerId = $computerData->getId();
                            $computerLabId = $computerData->getLabId();
                            $computerCPU = $computerData->getCpu();
                            $computerRAM = $computerData->getRam();
                            $computerLabName = "";

                            require_once $_SERVER['DOCUMENT_ROOT'].'/service/lab.php';

                            if(!isset($_COOKIE['lab-cookie'])) {
                                header("Location: labs.php");
                                die();
                            } else {
                                $labCookie = unserialize($_COOKIE['lab-cookie']);
                                foreach ($labCookie as $lab) {
                                    if ($lab->getId() == $computerLabId) {
                                        $computerLabName = $lab->getName();
                                        break;
                                    }
                                }
                            }
                        }
                        echo '<h3 class="text-center mb-3">Detalhes do Computador</h3>';

                        echo '
                            <p class="text-center fw-bold rounded-4 p-2 px-3 lvl0__bg">ID: ' . $computerId . '</p>
                            <div class="lvl0__bg rounded-4 p-2 mb-2 px-3">
                                <h3 class="text-center fw-semibold m-0">CPU: ' . $computerCPU . '</h3>
                                <h6 class="text-center text-muted m-0">RAM: ' . $computerRAM . '</h6>
                            </div>
                            <p class="text-center rounded-4 p-2 px-3 lvl0__bg">Lab: ' . $computerLabName . '</p>
                        ';
                        
                        echo '<div class="text-center"><a href="edit-computers.php?id=' . $computerData->getId() . '" class="btn btn__submit lvl1__bg">Editar</a></div>'

                    ?>
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