<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tp["title"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>
    <?php require './components/navbar.php' ?>
    <main <?php echo "data-" . $tp["identification"]?>>
        <?php
        if (isset($tp["content"])) {
            require($tp["content"]);
        }
        ?>
    </main>
    <?php require './components/footer.php' ?>
</body>

</html>