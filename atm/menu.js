function formatearBs(monto) {
  return "Bs " + Number(monto).toLocaleString("es-BO");
}

const tarjeta = localStorage.getItem("tarjeta");

// =======================
// FILTRAR INPUTS
// =======================
document.addEventListener("DOMContentLoaded", () => {

  const inputs = document.querySelectorAll("input");

  inputs.forEach(input => {
    input.addEventListener("input", () => {
      input.value = input.value.replace(/\D/g, "");
    });
  });

  const montoRetiro = document.getElementById("montoRetiro");
  if (montoRetiro) {
    montoRetiro.addEventListener("input", () => {
      montoRetiro.value = montoRetiro.value.replace(/\D/g, "");
    });
  }

});

// =======================
// ELEMENTO ACTIVO
// =======================
function getActivo() {

  // 🔥 si el modal está activo
  const modal = document.getElementById("modalRecibo");
  if (modal && modal.style.display === "flex") {
    const botones = modal.querySelectorAll("button");
    return document.activeElement || botones[0];
  }

  const elementos = document.querySelectorAll(".pantalla.activa input, .pantalla.activa button");

  let activo = document.activeElement;

  if (![...elementos].includes(activo)) {
    return elementos[0] || null;
  }

  return activo;
}

// =======================
// ESCRIBIR
// =======================
function presionar(valor) {
  const activo = getActivo();

  if (activo && activo.tagName === "INPUT") {
    activo.value += valor;
  }
}

// =======================
// BORRAR
// =======================
function borrar() {
  const activo = getActivo();

  if (activo && activo.tagName === "INPUT") {
    activo.value = activo.value.slice(0, -1);
  }
}

// =======================
// CAMBIAR
// =======================
function cambiarCampo() {

  const modal = document.getElementById("modalRecibo");

if (modal && modal.style.display === "flex") {

  const botones = modal.querySelectorAll("button");

  let index = [...botones].indexOf(document.activeElement);

  if (index === -1 || index === botones.length - 1) {
    botones[0].focus();
  } else {
    botones[index + 1].focus();
  }

  return;
}

  const pantalla = document.querySelector(".pantalla.activa");

  if (pantalla.id === "estado") {

    const items = document.querySelectorAll("#estadoTexto .movimiento, .volver-btn");

    if (items.length === 0) return;

    let index = [...items].findIndex(el => el.classList.contains("seleccionado"));

    items.forEach(el => el.classList.remove("seleccionado"));

    index = (index + 1) % items.length;

    const actual = items[index];
    actual.classList.add("seleccionado");

    actual.scrollIntoView({
      behavior: "smooth",
      block: "center"
    });

    return;
  }

  const elementos = document.querySelectorAll(".pantalla.activa input, .pantalla.activa button");

  let index = [...elementos].indexOf(document.activeElement);

  if (index === -1 || index === elementos.length - 1) {
    elementos[0].focus();
  } else {
    elementos[index + 1].focus();
  }
}

// =======================
// ENTER
// =======================
function accionEnter() {

  const modal = document.getElementById("modalRecibo");

if (modal && modal.style.display === "flex") {

  const activo = document.activeElement;

  if (activo && activo.tagName === "BUTTON") {
    activo.click();
  }

  return;
}

  const pantalla = document.querySelector(".pantalla.activa").id;
  const activo = getActivo();

  if (activo && activo.tagName === "BUTTON") {
    activo.click();
  }

  if (activo && activo.tagName === "INPUT") {
    if (pantalla === "deposito") depositar();
    if (pantalla === "transferencia") transferir();
    if (pantalla === "montoPersonal") confirmarRetiro();
  }

  if (pantalla === "estado") {

  const seleccionado = document.querySelector(".movimiento.seleccionado");

  if (!seleccionado) return;

  if (seleccionado.classList.contains("volver-btn")) {
    volver();
    return;
  }

  const tipo = seleccionado.dataset.tipo;
  const monto = seleccionado.dataset.monto;
  const detalle = seleccionado.dataset.detalle;
  const fecha = seleccionado.dataset.fecha;

  abrirReciboHistorial(tipo, monto, detalle, fecha);
}
  }


// =======================
// ILUMINAR TECLADO
// =======================
function iluminarTecla(key) {
  const botones = document.querySelectorAll(".teclado button");

  botones.forEach(btn => {
    if (btn.dataset.key == key) {
      btn.classList.add("pulsando");
      setTimeout(() => btn.classList.remove("pulsando"), 120);
    }
  });
}

// =======================
// NAVEGACIÓN
// =======================
function mostrar(id) {
  document.querySelectorAll(".pantalla").forEach(p => p.classList.remove("activa"));

  const pantalla = document.getElementById(id);
  if (pantalla) pantalla.classList.add("activa");
}

function volver() {
  mostrar("menu");
}

// =======================
// BACKEND
// =======================
function verSaldo() {
  fetch("http://localhost/atm/backend/saldo.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({ tarjeta })
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById("saldoTexto").innerText =
      "Saldo: " + formatearBs(data.saldo);
  });
}

// 🔥 RETIRO + RECIBO
function retirar(monto) {
  fetch("http://localhost/atm/backend/retirar.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({ tarjeta, monto })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("Retiro exitoso");
      imprimirRecibo("Retiro", monto);
    } else {
      alert("Saldo insuficiente");
    }
  });
}

// 🔥 DEPÓSITO + RECIBO
function depositar() {
  const monto = document.getElementById("montoDep").value;

  fetch("http://localhost/atm/backend/depositar.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({ tarjeta, monto })
  })
  .then(() => {
    alert("Depósito realizado");
    imprimirRecibo("Depósito", monto);
  });
}

// 🔥 TRANSFERENCIA + RECIBO
function transferir() {
  const monto = document.getElementById("montoTrans").value;
  const destino = document.getElementById("destino").value;

  alert("Transferencia de " + formatearBs(monto));
  imprimirRecibo("Transferencia", monto, "A: " + destino);
}

// =======================
function verEstado() {
  fetch("http://localhost/atm/backend/estado.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({ tarjeta })
  })
  .then(res => res.json())
  .then(data => {

    const contenedor = document.getElementById("estadoTexto");

    if (data.length === 0) {
      contenedor.innerHTML = `
        <div class="movimiento volver-btn">Volver</div>
        <p>No hay movimientos</p>
      `;
    } else {
      contenedor.innerHTML = `
  <div class="movimiento volver-btn">Volver</div>
` + data.map(m => `
  <div class="movimiento"
       data-tipo="${m.tipo}"
       data-monto="${m.monto}"
       data-detalle="${m.detalle || ""}"
       data-fecha="${m.fecha}">
       
    <strong>${m.tipo}</strong> - ${formatearBs(m.monto)}<br>
    <small>${m.detalle || ""}</small><br>
    <small>${m.fecha}</small>
  </div>
`).join("");
    }

    const primero = document.querySelector("#estadoTexto .movimiento");
    if (primero) primero.classList.add("seleccionado");
  });
}

// =======================
function confirmarRetiro() {
  const monto = document.getElementById("montoRetiro").value;

  if (!monto || monto <= 0) {
    alert("Ingrese un monto válido");
    return;
  }

  retirar(Number(monto));
}

// =======================
// CLICK VOLVER
// =======================
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("volver-btn")) {
    volver();
  }
});

// =======================
// 🔥 TECLADO FÍSICO (CORRECTO)
// =======================
document.addEventListener("keydown", (e) => {

  if (/^[0-9]$/.test(e.key)) {
    e.preventDefault();
    presionar(e.key);
    iluminarTecla(e.key);
    return;
  }

  if (e.code.startsWith("Numpad") && !isNaN(e.key)) {
    e.preventDefault();
    presionar(e.key);
    iluminarTecla(e.key);
    return;
  }

  if (e.key === "Delete" || e.key === "Backspace" || e.key === "." || e.code === "NumpadDecimal") {
    e.preventDefault();
    borrar();
    iluminarTecla("del");
    return;
  }

  if (e.key === "+" || e.code === "NumpadAdd") {
    e.preventDefault();
    cambiarCampo();
    iluminarTecla("cambiar");
    return;
  }

  if (e.key === "Enter") {
    e.preventDefault();
    accionEnter();
    iluminarTecla("enter");
    return;
  }

});

// =======================
// RECIBO
// =======================
let htmlRecibo = "";

function imprimirRecibo(tipo, monto, detalle = "") {

  const fecha = new Date().toLocaleString("es-BO");
  const tarjeta = localStorage.getItem("tarjeta");

  htmlRecibo = `
    <div>
      <h3>BanCori</h3>
      <p>----------------------</p>
      <p><strong>${tipo}</strong></p>
      <p>Monto: ${formatearBs(monto)}</p>
      <p>${detalle}</p>
      <p>Tarjeta: ****${tarjeta.slice(-4)}</p>
      <p>${fecha}</p>
      <p>----------------------</p>
      <p>Gracias por usar BanCori</p>
    </div>
  `;

  document.getElementById("contenidoRecibo").innerHTML = htmlRecibo;
  document.getElementById("modalRecibo").style.display = "flex";

  setTimeout(() => {
  const btn = document.querySelector("#modalRecibo button");
  if (btn) btn.focus();
}, 50);
}

function confirmarImpresion(imprimir) {

  if (imprimir) {

    const win = window.open("", "", "width=400,height=600");

    win.document.write(`
      <html>
      <body style="font-family: monospace; text-align:center;">
        ${htmlRecibo}
      </body>
      <script>
        window.print();
        window.onafterprint = () => window.close();
      <\/script>
      </html>
    `);

    win.document.close();
  }

  // 🔥 cerrar modal
  document.getElementById("modalRecibo").style.display = "none";

  // 🔥 LIMPIAR INPUTS (PRO)
  const inputs = document.querySelectorAll("input");
  inputs.forEach(i => i.value = "");

  // 🔥 VOLVER AL MENÚ AUTOMÁTICAMENTE
  volver();
}

document.addEventListener("click", (e) => {

  const item = e.target.closest(".movimiento");

  if (!item) return;

  // 🔥 VOLVER
  if (item.classList.contains("volver-btn")) {
    volver();
    return;
  }

  // 🔥 DATOS
  const tipo = item.dataset.tipo;
  const monto = item.dataset.monto;
  const detalle = item.dataset.detalle;
  const fecha = item.dataset.fecha;

  abrirReciboHistorial(tipo, monto, detalle, fecha);

});

function abrirReciboHistorial(tipo, monto, detalle, fecha) {

  const tarjeta = localStorage.getItem("tarjeta");

  htmlRecibo = `
    <div>
      <h3>BanCori</h3>
      <p>----------------------</p>
      <p><strong>${tipo}</strong></p>
      <p>Monto: ${formatearBs(monto)}</p>
      <p>${detalle}</p>
      <p>Tarjeta: ****${tarjeta.slice(-4)}</p>
      <p>${fecha}</p>
      <p>----------------------</p>
      <p>Gracias por usar BanCori</p>
    </div>
  `;

  document.getElementById("contenidoRecibo").innerHTML = htmlRecibo;
  document.getElementById("modalRecibo").style.display = "flex";
}

function cerrarSesion() {

  localStorage.removeItem("tarjeta");

  mostrar("despedida");

  setTimeout(() => {
    window.location.href = "index.html";
  }, 2500);

}