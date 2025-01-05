<?php
if(!defined('DIRECT_ACCESS')){
    header("Location: ../index.php");
}
?>

<aside id="sidebar">
    <a href="">Modifica Password</a>
    <a href="./logout_index.php">Disconnetti</a>
</aside>
<section>


<form method="POST">
    <h1>Account</h1>
    <p>Visualizza le informazioni rilevanti del tuo account e apporta modifiche.</p>
    <ul>
        <li>
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" value="" />
        </li>
        <li>
            <label for="lastname">Cognome</label>
            <input type="text" id="lastname" name="lastname" value="" />
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="" readonly />
        </li>
        <li>
            <label for="address_avenue">Via</label>
            <input type="text" id="address_avenue" name="avenue" placeholder="Via esempio" value="" />
        </li>
        <li>
            <label for="address_civic" >Civico</label>
            <input type="text" id="address_civic" name="civic" placeholder="50" value="" />
        </li>
        <li>
            <label for="address_city" >Città</label>
            <input type="text" id="address_city" name="city" placeholder="Cesena" value="" />
        </li>
        <li>
            <label for="address_province">Provincia</label>
            <select id="address_province" name="province">
                <option value="">Seleziona la provincia</option>
            </select>
        </li>
        <li>
            <label for="address_cap" >CAP</label>
            <input type="text" id="address_cap" name="cap" placeholder="47521" value="" />
        </li>
    </ul>
    <input type="submit" value="Salva Modifiche" />
    <a href="">Modifica Password</a>
</form>

<form>
    <p>Si prega di inserire la vecchia e nuova password, con ulteriore conferma.</p>
    <ul>
        <li>
            <label for="old_password">Vecchia password</label>
            <input type="password" name="old_password" required>
        </li>
        <li>
            <label for="new_password">Nuova password</label>
            <input type="password"name="new_password" required>
        </li>
        <li>
            <label for="new_password_confirm">Conferma nuova password</label>
            <input type="password" name="new_password_confirm" required>
        </li>
    </ul>
    <input type="submit" value="Salva Password">
</form>

<a href="./logout_index.php">Disconnetti</a>

</section>