<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhes do Câmpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="info-campus.css">
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
                <div class="col-md-4 d-flex align-items-center justify-content-center flex-column">
                    <?php
                        require_once $_SERVER['DOCUMENT_ROOT'].'/service/campus.php';

                        if(!isset($_COOKIE['campus-cookie']))
                        {
                            header("Location: campus.php");
                            die();
                        } else {
                            $campusCookie = unserialize($_COOKIE['campus-cookie']);

                            foreach ($campusCookie as $campus) {
                                if ($campus->getId() == $_GET['id']) {
                                    $campusData = $campus;
                                    break;
                                }
                            }

                            $campusId = $campusData->getId();
                            $campusName = $campusData->getName();
                            $campusAddress = $campusData->getAddress();
                            $campusAcronym = $campusData->getAcronym();
                        }

                        echo '
                            <p class="text-center fw-bold rounded-4 p-2 px-3 lvl0__bg">ID: ' . $campusId . '</p>
                            <div class="lvl0__bg rounded-4 p-2 mb-2 px-3">
                                <h3 class="text-center fw-semibold m-0">' . $campusAcronym . '</h3>
                                <h6 class="text-center text-muted m-0">' . $campusName . '</h6>
                            </div>
                            <p class="text-center rounded-4 p-2 px-3 lvl0__bg">' . $campusAddress . '</p>
                        ';

                        echo '<div class="text-center"><a href="edit-campuses.php?id=' . $campusData->getId() . '" class="btn btn__submit lvl1__bg">Editar</a></div>'
                    ?>
                </div>
                <div class="col-auto">
                    <div class="vr rounded-5 h-100 bg-dark"></div>
                </div>
                
                <!-- Listagem (Blocos) -->
                <div class="col-md-7">
                    <div class="text-center fw-bold mb-3"><small class="rounded-4 p-2 px-3 lvl0__bg">Listagem dos Blocos</small></div>
                    <div class="lvl0__bg p-3 rounded-4">
                        <?php
                            require_once $_SERVER['DOCUMENT_ROOT'].'/service/block.php';

                            function hasChild($cookieType, $id) {
                                if (isset($_COOKIE["$cookieType-cookie"])) {
                                    require_once $_SERVER['DOCUMENT_ROOT']."/service/$cookieType.php";
                                    $openedCookie = unserialize($_COOKIE["$cookieType-cookie"]);

                                    foreach ($openedCookie as $cookieUnit) {
                                        if ($cookieUnit->getCampusId() == $id) {
                                            return true;
                                        }
                                    }
                                    return false;
                                }
                            }

                            if (hasChild('block', $_GET['id']) == false) {
                                echo '
                                    <div class="lvl1__bg p-3 rounded-4 mb-3">
                                        <h5 class="text-center">Nenhum bloco cadastrado</h5>
                                        <div class="text-center"><a href="block.php?id=' . $campusId . '" class="btn btn__submit lvl2__bg">Criar um</a></div>
                                    </div> 
                                ';
                            } else {
                                $blockCookie = unserialize($_COOKIE['block-cookie']);
                                
                                foreach ($blockCookie as $block) {
                                    if ($block->getCampusId() == $_GET['id']) {
                                        echo '
                                            <div class="lvl1__bg p-3 rounded-4 mb-3">
                                                <h5 class="text-center">' . $block->getName() . '</h5>
                                                <div class="text-center"><a href="info-block.php?id=' . $block->getId() . '" class="btn btn__submit lvl2__bg">Ver mais</a></div>
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