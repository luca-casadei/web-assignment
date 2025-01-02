<?php
if(!defined('DIRECT_ACCESS')){
    header("Location: ../index.php");
}
?>
<h1>Account</h1>
<p>Visualizza le informazioni rilevanti del tuo account e apporta modifiche.</p>
<form method="POST" action="update_profile.php">
    <ul>
        <li>
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" />
        </li>
        <li>
            <label for="lastname">Cognome</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" />
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly />
        </li>
        <li>
            <label for="address">Indirizzo</label>
            <input type="text" id="address" name="address" placeholder="Via esempio, 50" />
        </li>
    </ul>
    <a href="">Modifica Password</a>
    <input type="submit" value="Salva Modifiche" />
</form>

<form>
    <p>Si prega di inserire la password vecchia e la nuova password (con relativa copia di conferma).</p>
    <ul>
        <li>
            <label for="old-password">Vecchia password:</label>
            <input type="password" id="old-password" required>
        </li>
        <li>
            <label for="new-password">Nuova password:</label>
            <input type="password" id="new-password" required>
        </li>
        <li>
            <label for="new-password-confirm">Conferma nuova password:</label>
            <input type="password" id="new-password-confirm" required>
        </li>
        <li>
            <input type="submit" value="Salva modifiche">
        </li>
    </ul>
</form>

<a href="./pages/logout.php">Disconnetti</a>