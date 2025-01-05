<nav data-open="false">
    <a href="./index.php"><img src="./images/logo.png" alt="Logo" /></a>
    <ul>
        <li><a href="./index.php">Homepage</a></li>
        <li><a href="#">Ricerca libro</a></li>
        <?php 
            if (isUserLoggedIn()){
               echo '<li><a href="./cart_index.php">Carrello</a></li>';
                echo '<li><a href="./orders_index.php">Ordini</a></li>';
            }
        ?>

    </ul>
    <ul>
        <li><img src="./images/bell.png" alt="Notifiche" /></li>
        <li><img src="./images/account.png" alt="Accesso e Profilo" /></li>
        <li><img src="./images/book.png" alt="Apri navigazione"/></li>
    </ul>
</nav>