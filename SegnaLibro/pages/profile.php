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
            <a href="change_password.php" class="change-password-link">Modifica Password</a>
            <input type="submit" value="Salva Modifiche" />
        </form>
        <a href="./pages/logout.php" class="logout-link">Disconnetti</a>