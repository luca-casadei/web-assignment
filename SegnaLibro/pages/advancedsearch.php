<header>
    <div role="search">
        <label for="contentsearch">Cerca libro:</label>
        <input
            type="search"
            placeholder="..."
            aria-label="Ricerca libro per titolo"
            oninput="updateSearchTerms()"
            id="contentsearch"
        >
    </div>
    <form action="#" method="POST">
        <h2>Filtri</h2>
        <ul>
            <li>
                <label for="categoryselect">Categoria:</label>
                <select title="Categoria" id="categoryselect" onchange="updateSearchTerms()"><option selected value="">Nessuna categoria</option></select>
            </li>
            <li>
                <label for="orderingselect">Ordina:</label>
                <select title="Ordinamento" id="orderingselect" onchange="updateSearchTerms()">
                    <optgroup label="Prezzo">
                        <option value="pdesc">Da più a meno costoso</option>
                        <option value="pasc">Da meno a più costoso</option>
                    </optgroup>
                    <optgroup label="Titolo">
                        <option value="tdesc">Da A a Z</option>
                        <option value="tasc">Dalla Z alla A</option>
                    </optgroup>
                </select>
            </li>
            <li>
                <label for="pricerange">Prezzo:</label>
                <input type="range" min="5" max="500" step="5" onchange="updateSearchTerms()" id="pricerange" name="pricerange"/>
                <p></p>
            </li>
        </ul>
    </form>
</header>
<section>
    
</section>