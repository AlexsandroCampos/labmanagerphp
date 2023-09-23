<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $campusId = $_GET['id'];
    $campuses = unserialize($_COOKIE["campus-cookie"]);
    
    foreach ($campuses as $campus) {
        if ($campus->getId() == $campusId) {
            $name = $campus->getName();
            $address = $campus->getAddress();
            $acronym = $campus->getAcronym();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST["name"];
    $newAddress = $_POST["address"];
    $newAcronym = $_POST["acronym"];
    foreach ($campuses as &$campus) {
        if ($campus->getId() == $campusId) {
            $campus->setName($newName);
            $campus->setAddress($newAddress);
            $campus->setAcronym($newAcronym);
            break;
        }
    }

    $serializedCampuses = serialize($campuses);
    setcookie("campus-cookie", $serializedCampuses, time() + 360000000, "/");
    header("Location: info-campus.php?id=$campusId");
    die();
}
?>