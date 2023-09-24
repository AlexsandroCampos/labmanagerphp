<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/service/computer.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $computerId = $_GET['id'];
    $computers = unserialize($_COOKIE["computer-cookie"]);
    
    foreach ($computers as $computer) {
        if ($computer->getId() == $computerId) {
            $cpu = $computer->getCpu();
            $ram = $computer->getRam();
            $labId = $computer->getLab();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $computers = unserialize($_COOKIE["computer-cookie"]);
    $computerId = $_POST["id"];
    $newCpu = $_POST["cpu"];
    $newRam = $_POST["ram"];
    $newLabId = $_POST["lab"];
    foreach ($computers as &$computer) {
        if ($computer->getId() == $computerId) {
            $computer->setCpu($newCpu);
            $computer->setRam($newRam);
            $computer->setLab($newLabId);
            break;
        }
    }

    $serializedComputers = serialize($computers);
    setcookie("computer-cookie", $serializedComputers, time() + 360000000, "/");
    header("Location: ../static/info-computer.php?id=$computerId");
    die();
}
?>