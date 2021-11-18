<?php

/**
 * Permet de delete un fichier ou un dossier
 * @return void
 */
function deleteEntry($path)
{
    if (!is_dir($path) && !is_file($path)) {
        header('Location: index.php');
    }
    if (is_dir($path)) {
        $handle = opendir($path);
        while ($entry = readdir($handle)) {
            if ($entry != "." && $entry != "..") {
                if (is_dir($path . '/' . $entry)) {
                    deleteEntry($path . '/' . $entry);
                }
                if (is_file($path . '/' . $entry)) {
                    echo $path . '/' .  $entry . " was deleted <br>";
                    unlink($path . '/' .  $entry);
                }
            }
        }
        echo $path . " was deleted <br>";
        rmdir($path);
    }
    if (is_file($path)) {
        echo $path . " was deleted <br>";
        unlink($path);
    }
}

/**
 * Permet de récupérer le nom d'un fichier
 * @return string
 */
function getNameFile()
{
    if (isset($_GET["f"])) {
        $file = $_GET["f"];
        return "<h1>" . $file . "</h1>";
    }
}
/**
 * Permet de récupérer le chemin d'un fichier ou d'un dossier et créé un lien pour édit le fichier
 * @return void
 */
function showEntry(string $path)
{
    $handle = opendir($path);
    while ($entry = readdir($handle)) {
        if (!in_array($entry, array('.', '..'))) {
            if (is_dir($path . '/' . $entry)) {
                showEntry($path . '/' . $entry);
                echo '<div class="print-directory">' . $entry . '<a href="?d=' . $path . '/' . $entry . '" style="color:red; display:inlineBlock; marginLeft:10px"><button>x</button></a></div>';
            } else {
                echo '<div><a href="?f=' . $path . '/' . $entry . '">' . $entry . '</a> <a href="?d=' . $path . '/' . $entry . '" style="color:red; display:inlineBlock; marginLeft:10px"><button>x</button></a></div> ';
            }
        }
    }
}

/**
 * Permet de récupérer le contenue d'un fichier
 */
function getContentFile()
{
    if (isset($_GET["f"])) {
        $file = $_GET["f"];
        if ((strstr($_GET["f"], ".html") || strstr($_GET["f"], ".txt"))) {
            $content = file_get_contents($file);
            return $content;
        }
    }
}
