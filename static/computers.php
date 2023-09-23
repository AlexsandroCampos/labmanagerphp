<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LabManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand" asp-area="" asp-controller="Home" asp-action="Index">MvcLabManager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="privacy">Privacidade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="computers.php">Computadores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="labs.php">Laboratórios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <main role="main" class="pb-3">
              <form action="/service/computer.php" method="post">
                <label for="cpu">
                  CPU do computador
                  <input class="form-control" type="text" name="cpu">
                </label>
                <label for="ram">
                  RAM do computador
                  <input class="form-control" type="text" name="ram">
                </label>
                <label for="lab">
                  ID do laboratório
                  <input class="form-control" type="number" name="lab">
                </label>
                <input type="hidden" value="computer" name="entity"/>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </main>
    </div>

    <footer class="border-top footer text-muted fixed-bottom pb-3 pt-3">
        <div class="container">
            &copy; 2023 - LabManager - <a href="privacy">Privacidade</a>
        </div>
    </footer>
</body>
</html>