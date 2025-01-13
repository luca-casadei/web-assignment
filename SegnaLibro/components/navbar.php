<nav data-open="false">
    <ul>
        <li><a href="./index.php"><img src="./images/logo.png" alt="SegnaLibro - Logo" /></a></li>
        <li <?php echo ($tp["active"] == "home" ? "data-active" : "")?>><a href="./index.php">Homepage</a></li>
        <?php 
            if (isUserLoggedIn()){
                if (!isUserVendor()){
                    echo '<li '.($tp["active"] == "cart" ? "data-active" : "").'><a href="./cart_index.php">Carrello</a></li>';
                    echo '<li '.($tp["active"] == "orders" ? "data-active" : "").'><a href="./orders_index.php">Ordini</a></li>';
                    echo '<li '.($tp["active"] == "search" ? "data-active" : "").'><a href="./advanced_search_index.php">Ricerca avanzata</a></li>';
                } else {
                    echo '<li '.($tp["active"] == "user_orders" ? "data-active" : "").'><a href="./user_orders_index.php">Ordini utenti</a></li>';
                }
            }else{
                echo '<li '.($tp["active"] == "search" ? "data-active" : "").'><a href="./advanced_search_index.php">Ricerca avanzata</a></li>';
            }
        ?>
    </ul>
    <ul>
        <li><img src="./images/bell.png" alt="Notifiche" /></li>
        <li><img src="./images/account.png" alt="Accesso e Profilo" /></li>
        <li><img src="./images/book.png"  alt="Apri navigazione"/></li>
    </ul>
</nav>