    <div>
          <input type="submit" value="Completa ordine" form="checkoutForm" />
    </div>

    <section>
        <form id="checkoutForm">
            <h1>Completa pagamento</h1>
            <ul>
                <li>
                    <label for="card_number">Numero carta</label>
                    <input type="text" id="card_number" name="card_number" placeholder="0000 0000 0000 0000" required />
                </li>

                <li>
                    <label for="card_expiration">Scadenza</label>
                    <input type="text" id="card_expiration" name="expiration" placeholder="MM/YY" required />
                </li>
                <li>
                    <label for="card_cvc">CVC</label>
                    <input type="text" id="card_cvc" name="card_cvc" placeholder="123" required />
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
                    <label for="address_city">Città</label>
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

                <li>
                    <label for="card_holder">Nome intestatario</label>
                    <input type="text" id="card_holder" name="card_holder" placeholder="Mario Rossi" required />
                </li>
            </ul>

            <input type="submit" value="Completa ordine" />
        </form>
    </section>