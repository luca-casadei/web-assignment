<nav data-open="false">
    <ul>
        <li><a href="./index.php"><img src="./images/logo.png" alt="SegnaLibro - Logo" /></a></li>
        <li><a href="./index.php">Homepage</a></li>
        <?php 
            if (isUserLoggedIn() && !isUserVendor()){
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