let tarjetaGlobal = "";

// FILTRAR INPUT
document.addEventListener("DOMContentLoaded", () => {

  const tarjeta = document.getElementById("tarjeta");
  const pin = document.getElementById("pin");

  tarjeta.addEventListener("input", () => {
    tarjeta.value = tarjeta.value.replace(/\D/g, "");
  });

  pin.addEventListener("input", () => {
    pin.value = pin.value.replace(/\D/g, "").slice(0, 4);
  });

});

// INPUT ACTIVO
function getActivo() {
  const tarjeta = document.getElementById("tarjeta");
  const pin = document.getElementById("pin");

  let activo = document.activeElement;

  if (activo !== tarjeta && activo !== pin) {
    tarjeta.focus();
    return tarjeta;
  }

  return activo;
}

// ESCRIBIR
function presionar(valor) {
  const activo = getActivo();

  if (activo.id === "pin" && activo.value.length >= 4) return;

  activo.value += valor;
}

// BORRAR
function borrar() {
  const activo = getActivo();
  activo.value = activo.value.slice(0, -1);
}

// CAMBIAR CAMPO
function cambiarCampo() {
  const tarjeta = document.getElementById("tarjeta");
  const pin = document.getElementById("pin");

  const activo = document.activeElement;

  if (activo === tarjeta) {
    pin.focus();
    return;
  }

  if (activo === pin) {
    tarjeta.focus();
    return;
  }

  tarjeta.focus();
}

// 🔥 NUEVO: ILUMINAR TECLADO
function iluminarTecla(key) {

  let selector = "";

  if (/^[0-9]$/.test(key)) {
    if (key === "0") selector = ".cero";
    else selector = ".n" + key;
  }

  if (key === "del") selector = ".del";
  if (key === "enter") selector = ".enter";
  if (key === "cambiar") selector = ".cambiar";

  const btn = document.querySelector(selector);

  if (!btn) return;

  btn.classList.add("pulsando");

  setTimeout(() => {
    btn.classList.remove("pulsando");
  }, 120);
}

// TECLADO FÍSICO
document.addEventListener("keydown", (e) => {

  // números
  if (/^[0-9]$/.test(e.key)) {
    e.preventDefault();
    presionar(e.key);
    iluminarTecla(e.key);
    return;
  }

  // numpad
  if (e.code.startsWith("Numpad") && !isNaN(e.key)) {
    e.preventDefault();
    presionar(e.key);
    iluminarTecla(e.key);
    return;
  }

  // borrar
  if (
    e.key === "Delete" ||
    e.key === "Backspace" ||
    e.key === "." ||
    e.code === "NumpadDecimal"
  ) {
    e.preventDefault();
    borrar();
    iluminarTecla("del");
    return;
  }

  // cambiar
  if (e.key === "+" || e.code === "NumpadAdd") {
    e.preventDefault();
    cambiarCampo();
    iluminarTecla("cambiar");
    return;
  }

  // enter
  if (e.key === "Enter") {
    e.preventDefault();
    login();
    iluminarTecla("enter");
    return;
  }

});

// LOGIN
function login() {
  const tarjeta = document.getElementById("tarjeta").value;
  const pin = document.getElementById("pin").value;

  fetch("http://localhost/atm/backend/login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ tarjeta, pin })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      tarjetaGlobal = tarjeta;
      localStorage.setItem("tarjeta", tarjeta);
      window.location = "menu.html";
    } else {
      alert("Datos incorrectos");
    }
  });
}