<?php
require_once '../src/function.php';

$dir = opendir('../files');

//Vérification si un fichier à besoin d'être supprimé
if (isset($_GET["d"])) {
    $entry = $_GET["d"];
    deleteEntry($entry);
}

// Édite le contenue du fichier texte (.txt/.html),
if (isset($_POST["file"])) {
    $file = $_POST["file"];
    $file = fopen($file, "w");
    fwrite($file, stripcslashes($_POST["file-content"]));
    fclose($file);
}

showEntry('../files');      // Affiche les fichiers du dossier files
echo getNameFile();         //Affiche le chemin du fichier sélectionné
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit online</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <textarea name="file-content" id="file-content" cols="100" rows="20">
                <?php echo getContentFile();      // Affiche le contenue du fichier sélectionné?>
            </textarea>
        </div>
        <div>
            <input type="hidden" name="file" value="<?php if (isset($_GET["f"])) echo $_GET["f"]; //Stock le nom du fichier sélectionné?>">
            <input type="submit" value="Submit">
        </div>
    </form>
</body>

</html>