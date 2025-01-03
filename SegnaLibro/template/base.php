<!DOCTYPE html>
<html lang="it">

<?php require './components/head.php'?>

<body>
    <?php require './components/navbar.php' ?>
    <main <?php echo "data-" . $tp["identification"] ?>>
        <?php
        if (isset($tp["content"])) {
            require($tp["content"]);
        }
        ?>
    </main>
    <?php require './components/footer.php' ?>
    <?php
    if (isset($tp["js"])):
        foreach ($tp["js"] as $s):
    ?>
    <script src="<?php echo $s; ?>"></script>
    <?php endforeach;
    endif; ?>
</body>

</html>