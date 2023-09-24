<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $blockId = $_GET['id'];
    $blocks = unserialize($_COOKIE["block-cookie"]);
    
    foreach ($blocks as $block) {
        if ($block->getId() == $blockId) {
            $name = $block->getName();
            $campusId = $block->getCampusId();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST["name"];
    $newCampusId = $_POST["campusId"];
    foreach ($blocks as &$block) {
        if ($block->getId() == $blockId) {
            $block->setName($newName);
            $block->setCampusId($newCampusId);
            break;
        }
    }

    $serializedBlocks = serialize($blocks);
    setcookie("block-cookie", $serializedBlocks, time() + 360000000, '/');
    header("Location: block-details.php?id=$blockId");
    die();
}
?>