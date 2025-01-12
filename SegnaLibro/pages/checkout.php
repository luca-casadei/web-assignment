    <div>
        <input type="button" value="Procedi all’ordine" onclick="redirectToCompleteOrder()">
    </div>

    <section>
        <form method="POST">
            <h1>Completa pagamento</h1>
            <ul>
                <li>
                    <label>Numero carta</label>
                    <input type="text" name="card_number" placeholder="0000 0000 0000 0000" required>
                </li>

                <li>
                    <label>Scadenza</label>
                    <input type="text" name="expiration" placeholder="MM/YY" required>
                </li>

                <li>
                    <label>CVC</label>
                    <input type="text" name="cvc" placeholder="123" required>
                </li>

                <li>
                    <label>Indirizzo</label>
                    <input type="text" name="address" placeholder="Via Esempio 50, Cesena (FC)" required>
                </li>

                <li>
                    <label>Nome intestatario</label>
                    <input type="text" name="card_holder" placeholder="Mario Rossi" required>
                </li>
            </ul>

            <input type="submit" value="Procedi all’ordine" onclick="redirectToCompleteOrder()">
        </form>
    </section>