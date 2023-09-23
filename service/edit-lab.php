<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $labId = $_GET['id'];
    $labs = unserialize($_COOKIE["lab-cookie"]);
    
    foreach ($labs as $lab) {
        if ($lab->getId() == $labId) {
            $name = $lab->getName();
            $number = $lab->getNumber();
            $block = $lab->getBlock();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST["name"];
    $newNumber = $_POST["number"];
    $newBlock = $_POST["block"];

    foreach ($labs as &$lab) {
        if ($lab->getId() == $labId) {
            $lab->setName($newName);
            $lab->setNumber($newNumber);
            $lab->setBlock($newBlock);
            break;
        }
    }

    $serializedLabs = serialize($labs);
    setcookie("lab-cookie", $serializedLabs, time() + 360000000, "/");
    header("Location: info-lab.php?id=$labId");
    die();
}
?>