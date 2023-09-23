<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhes do Bloco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="info-block.css">
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
                <div class="col-md-4">
                    <?php
                        require_once '../service/block.php';

                        if(!isset($_COOKIE['block-cookie']))
                        {
                            header("Location: block.php");
                            die();
                        } else {
                            $blockCookie = unserialize($_COOKIE['block-cookie']);
                            foreach ($blockCookie as $block) {
                                if ($block->getId() == $_GET['id']) {
                                    $blockData = $block;
                                    break;
                                }
                            }

                            $blockName = $blockData->getName();
                            $blockCampusId = $blockData->getCampusId();
                            $blockCampusSigla = "";

                            require_once '../service/campus.php';

                            if(!isset($_COOKIE['campus-cookie'])) {
                                header("Location: campus.php");
                                die();
                            } else {
                                $campusCookie = unserialize($_COOKIE['campus-cookie']);
                                foreach ($campusCookie as $campus) {
                                    if ($campus->getId() == $blockCampusId) {
                                        $blockCampusSigla = $campus->getAcronym();
                                        break;
                                    }
                                }
                            }
                        }

                        echo '<h3 class="text-center">' . $blockName . '</h3>';
                        echo '<h5 class="text-center text-muted">Câmpus: ' . $blockCampusSigla . '</h5>';
                    ?>
                </div>
                <div class="col-auto">
                    <div class="vr rounded-5 h-100 bg-dark"></div>
                </div>
                
                <!-- Listagem (labs) -->
                <div class="col-md-7">
                    <div class="text-center"><small>Listagem dos Laboratórios</small></div>
                    <div class="lvl0__bg p-3 rounded-4">
                        <?php
                            require_once '../service/lab.php';

                            if (!isset($_COOKIE['lab-cookie'])) {
                                echo '
                                    <div class="lvl1__bg p-3 rounded-4 mb-3">
                                        <h5 class="text-center">Nenhum laboratório cadastrado</h5>
                                        <div class="text-center"><a href="labs.php" class="btn btn__submit lvl2__bg">Criar um</a></div>
                                    </div> 
                                ';
                            } else {
                                $labCookie = unserialize($_COOKIE['lab-cookie']);
                                
                                foreach ($labCookie as $lab) {
                                    if ($lab->getBlockId() == $_GET['id']) {
                                        echo '
                                            <div class="lvl1__bg p-3 rounded-4 mb-3">
                                                <h5 class="text-center">' . $lab->getName() . '</h5>
                                                <div class="text-center"><a href="info-lab.php?id=' . $lab->getId() . '" class="btn btn__submit lvl2__bg">Ver mais</a></div>
                                            </div>
                                        ';
                                    }
                                }
                            }
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