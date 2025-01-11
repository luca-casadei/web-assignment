<header>
    <search><input type="search" placeholder="Cerca libro..." aria-label="Ricerca libro per titolo" oninput="updateSearchTerms()" id="contentsearch"/></search>
    <form action="#" method="POST">
        <h2>Filtri</h2>
        <select title="Categoria" id="categoryselect" onchange="updateSearchTerms()"></select>
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
        <div>
            <label for="pricerange">Prezzo:</label>
            <input type="range" min="5" max="100" step="5" onchange="updateSearchTerms()" id="pricerange" name="pricerange"/>
            <p></p>
        </div>
    </form>
</header>
<section>
    
</section>