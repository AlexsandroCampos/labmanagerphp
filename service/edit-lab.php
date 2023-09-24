<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/service/lab.php';
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
    $labs = unserialize($_COOKIE["lab-cookie"]);
    $labId = $_POST["id"];
    $newName = $_POST["name"];
    $newNumber = $_POST["number"];
    $newBlock = $_POST["block_id"];

    foreach ($labs as &$lab) {
        if ($lab->getId() == $labId) {
            $lab->setName($newName);
            $lab->setNumber($newNumber);
            $lab->setBlockId($newBlock);
            break;
        }
    }

    $serializedLabs = serialize($labs);
    setcookie("lab-cookie", $serializedLabs, time() + 360000000, "/");
    header("Location: ../static/info-lab.php?id=$labId");
    die();
}
?>