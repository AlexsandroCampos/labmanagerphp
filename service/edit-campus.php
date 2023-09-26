<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/service/campus.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $campusId = $_GET['id'];
    $campuses = unserialize($_COOKIE["campus-cookie"]);
    
    foreach ($campuses as $campus) {
        if ($campus->getId() == $campusId) {
            $newName = $campus->getName();
            $newAddress = $campus->getAddress();
            $newAcronym = $campus->getAcronym();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campuses = unserialize($_COOKIE["campus-cookie"]);
    $campusId = $_POST["id"];
    $newName = $_POST["name"];
    $newAddress = $_POST["address"];
    $newAcronym = $_POST["acronym"];
    foreach ($campuses as $campus) {
        if ($campus->getId() == $campusId) {
            $error = false;
            if(empty(trim($newName))) {
                echo "Nome é obrigatório <br>";
                $error = true;
            }
    
            if(is_numeric($newName)) {
                echo "Nome deve ser uma string <br>";
                $error = true;
            }
    
            if(strlen($newName) > 50 || strlen($newName) < 4) {
                echo "Nome deve ter entre 4 e 50 caracteres <br>";
                $error = true;
            }
    
            if(empty(trim($newAddress))) {
                echo "Endereço é obrigatório <br>";
                $error = true;
            }
    
            if(is_numeric($newAddress)) {
                echo "Endereço deve ser uma string <br>";
                $error = true;
            }
    
            if(strlen($newAddress) > 50 || strlen($newAddress) < 4) {
                echo "Endereço deve ter entre 4 e 50 caracteres <br>";
                $error = true;
            }
    
            if(empty(trim($newAcronym))) {
                echo "Sigla é obrigatória <br>";
                $error = true;
            }
    
            if(is_numeric($newAcronym)) {
                echo "Sigla deve ser uma string <br>";
                $error = true;
            }
    
            if(strlen($newAcronym) > 50 || strlen($newAcronym) < 4) {
                echo "Sigla deve ter entre 4 e 50 caracteres <br>";
                $error = true;
            }
    
            if($error)
            {
                echo "<a href='../static/edit-campuses.php?id={$campusId}'/>Voltar</a><br>";
                break;
            }

            else
            {
                $campus->setName($newName);
                $campus->setAddress($newAddress);
                $campus->setAcronym($newAcronym);
                $serializedCampuses = serialize($campuses);
                setcookie("campus-cookie", $serializedCampuses, time() + 360000000, "/");
                header("Location: ../static/info-campus.php?id=$campusId");
                die();
            }
            
        }
    }

   
}
?>