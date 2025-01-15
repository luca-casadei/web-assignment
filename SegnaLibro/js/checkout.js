document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      const cardNumber = form.querySelector('input[name="card_number"]');
      const expiration = form.querySelector('input[name="expiration"]');
      const cvc = form.querySelector('input[name="card_cvc"]');
      const cardHolder = form.querySelector('input[name="card_holder"]');
      if (!validateCardNumber(cardNumber.value)) {
        alert(
          "Il numero carta non è valido. Deve contenere 16 cifre (senza spazi)."
        );
        return;
      }
      if (!validateExpiration(expiration.value)) {
        alert(
          "La data di scadenza deve essere nel formato MM/YY (es. 08/26)."
        );
        return;
      }
      if (!validateCVC(cvc.value)) {
        alert("Il CVC deve essere un numero di 3 cifre.");
        return;
      }
      if (!cardHolder.value.trim()) {
        alert("Inserisci il nome dell’intestatario della carta.");
        return;
      }

      insertOrder();
    });
  }

  getProvinces();
  getAddress();
});

function validateCardNumber(number) {
  let clean = "";
  for (let i = 0; i < number.length; i++) {
    if (number[i] !== " ") clean += number[i];
  }
  if (clean.length !== 16) return false;
  for (let i = 0; i < clean.length; i++) {
    let c = clean.charCodeAt(i);
    if (c < 48 || c > 57) return false;
  }
  return true;
}

function validateExpiration(exp) {
  if (exp.length !== 5) return false;
  if (exp[2] !== "/") return false;
  let month = exp.slice(0, 2);
  let year = exp.slice(3);
  if (!isAllDigits(month) || !isAllDigits(year)) return false;
  let m = parseInt(month, 10);
  if (m < 1 || m > 12) return false;
  return true;
}

function validateCVC(cvc) {
  if (cvc.length !== 3) return false;
  if (!isAllDigits(cvc)) return false;
  return true;
}

function isAllDigits(str) {
  for (let i = 0; i < str.length; i++) {
    let c = str.charCodeAt(i);
    if (c < 48 || c > 57) return false;
  }
  return true;
}

async function getAddress() {
  const url = "./apis/api-checkout.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    const userInfo = json["user_info"];
    document.querySelector("#address_avenue").value = userInfo.Via || "";
    document.querySelector("#address_civic").value = userInfo.Civico || "";
    document.querySelector("#address_city").value = userInfo.Citta || "";
    document.querySelector("#address_province").value =
      userInfo.CodiceProvincia || "";
    document.querySelector("#address_cap").value = userInfo.CAP || "";
    document.querySelector("#card_holder").value =
      userInfo.Nome + " " + userInfo.Cognome || "";
  } catch (error) {
    console.log(error.message);
  }
}

async function getProvinces() {
  const url = "./apis/api-checkout.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    const provincesSelect = document.querySelector("#address_province");
    provincesSelect.innerHTML =
      '<option value="">Seleziona la provincia</option>';
    json["provinces"].forEach((province) => {
      const option = document.createElement("option");
      option.value = province.Codice;
      option.textContent = province.Nome;
      provincesSelect.appendChild(option);
    });
  } catch (error) {
    console.log(error.message);
  }
}

async function insertOrder() {
  const url = "./apis/api-checkout.php";
  const formData = new FormData();
  formData.append("action", "insert_order");
  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData,
    });
    const text = await response.json();
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    if (text["status"] === "ALREADY_ORDERED") {
      alert("Alcuni elementi del carrello sono già stati ordinati");
      window.location.href = "./index.php";
    } else if (text["status"] === "SUCCESS") {
      window.location.href = "./complete_order_index.php";
    } else {
      console.log(text);
    }
  } catch (error) {
    console.log(error.message);
  }
}
