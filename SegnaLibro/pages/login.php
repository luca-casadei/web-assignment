<h1>Login</h1>
<form action="#" method="POST">
    <?php if(isset($tp["error"])): ?>
    <p error><?php echo $tp["error"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        </li>
        <li>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
        </li>
        <li>
            <input type="submit" value="Accedi" />
        </li>
        <li>Non hai un account?<a href="./signup_index.php">Registrati</a></li>
    </ul>
</form>