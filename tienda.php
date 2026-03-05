<?php require __DIR__ . "/api/auth_required.php"; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Vibex | Tienda</title>
  <link rel="stylesheet" href="css/tienda.css" />
</head>

<body>
  <!-- NAV -->
  <header class="nav">
  <div class="nav-inner">

    <a class="brand" href="tienda.php">
      <img src="img/logovibex.png" alt="Vibex" class="brand-logo" />
    </a>

    <div class="nav-actions">

      <div class="search">
        <input id="searchInput" type="search" placeholder="Buscar..." />
      </div>

      <!-- 👇 AQUI VA -->
      <a class="logout" href="api/logout.php">Cerrar sesión</a>

    </div>

  </div>
</header>

    <!-- CATEGORÍAS -->
    <nav class="cats">
      <button class="cat active" data-filter="all" type="button">Todo</button>
      <button class="cat" data-filter="poleras" type="button">Poleras</button>
      <button class="cat" data-filter="pantalones" type="button">Pantalones</button>
      <button class="cat" data-filter="jeans" type="button">Jeans</button>
      <button class="cat" data-filter="casacas" type="button">Casacas</button>
      <button class="cat" data-filter="accesorios" type="button">Accesorios</button>
    </nav>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-inner">
      <h1>Vibex Store</h1>
      <p>Streetwear moderno. Catálogo por secciones. Busca, filtra y arma tu look.</p>
      <div class="hero-chips">
        <span class="chip">🔥 Nuevos drops</span>
        <span class="chip">💸 Ofertas semanales</span>
        <span class="chip">🚚 Envíos (demo)</span>
      </div>
    </div>
  </section>

  <!-- CONTENIDO -->
  <main class="main">
    <!-- POLERAS -->
    <section class="section" data-section="poleras">
      <div class="section-head">
        <h2>Poleras</h2>
        <a class="link" href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'})">Subir ↑</a>
      </div>

      <div class="grid">
        <article class="card product" data-cat="poleras" data-name="Polera Oversize Negra" data-tags="negra oversize algodon">
          <div class="thumb">
            <div class="badge">Nuevo</div>
            <div class="imgph">POLERA</div>
          </div>
          <div class="info">
            <h3>Polera Oversize Negra</h3>
            <p class="meta">Algodón • Oversize</p>
            <div class="price-row">
              <span class="price">Bs. 129</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="poleras" data-name="Polera Basic Blanca" data-tags="blanca basica">
          <div class="thumb">
            <div class="imgph">POLERA</div>
          </div>
          <div class="info">
            <h3>Polera Basic Blanca</h3>
            <p class="meta">Cotton • Fit regular</p>
            <div class="price-row">
              <span class="price">Bs. 99</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="poleras" data-name="Polera Graphic Vibes" data-tags="grafica estampado">
          <div class="thumb">
            <div class="badge hot">Hot</div>
            <div class="imgph">POLERA</div>
          </div>
          <div class="info">
            <h3>Polera Graphic Vibes</h3>
            <p class="meta">Estampado • Street</p>
            <div class="price-row">
              <span class="price">Bs. 149</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- PANTALONES -->
    <section class="section" data-section="pantalones">
      <div class="section-head">
        <h2>Pantalones</h2>
        <a class="link" href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'})">Subir ↑</a>
      </div>

      <div class="grid">
        <article class="card product" data-cat="pantalones" data-name="Jogger Cargo Gris" data-tags="jogger cargo gris">
          <div class="thumb">
            <div class="imgph">PANTALÓN</div>
          </div>
          <div class="info">
            <h3>Jogger Cargo Gris</h3>
            <p class="meta">Cargo • Comfort</p>
            <div class="price-row">
              <span class="price">Bs. 199</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="pantalones" data-name="Pantalón Slim Negro" data-tags="slim negro">
          <div class="thumb">
            <div class="badge sale">-20%</div>
            <div class="imgph">PANTALÓN</div>
          </div>
          <div class="info">
            <h3>Pantalón Slim Negro</h3>
            <p class="meta">Slim • Elegante</p>
            <div class="price-row">
              <span class="price"><s>Bs. 210</s> Bs. 168</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="pantalones" data-name="Cargo Verde Military" data-tags="cargo verde military">
          <div class="thumb">
            <div class="imgph">PANTALÓN</div>
          </div>
          <div class="info">
            <h3>Cargo Verde Military</h3>
            <p class="meta">Street • Bolsillos</p>
            <div class="price-row">
              <span class="price">Bs. 229</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- JEANS -->
    <section class="section" data-section="jeans">
      <div class="section-head">
        <h2>Jeans</h2>
        <a class="link" href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'})">Subir ↑</a>
      </div>

      <div class="grid">
        <article class="card product" data-cat="jeans" data-name="Jean Skinny Azul" data-tags="skinny azul">
          <div class="thumb"><div class="imgph">JEAN</div></div>
          <div class="info">
            <h3>Jean Skinny Azul</h3>
            <p class="meta">Skinny • Stretch</p>
            <div class="price-row">
              <span class="price">Bs. 189</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="jeans" data-name="Jean Baggy Light" data-tags="baggy claro">
          <div class="thumb"><div class="imgph">JEAN</div></div>
          <div class="info">
            <h3>Jean Baggy Light</h3>
            <p class="meta">Baggy • Urban</p>
            <div class="price-row">
              <span class="price">Bs. 219</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="jeans" data-name="Jean Negro Ripped" data-tags="negro ripped rotos">
          <div class="thumb"><div class="badge hot">Hot</div><div class="imgph">JEAN</div></div>
          <div class="info">
            <h3>Jean Negro Ripped</h3>
            <p class="meta">Ripped • Street</p>
            <div class="price-row">
              <span class="price">Bs. 249</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- CASACAS -->
    <section class="section" data-section="casacas">
      <div class="section-head">
        <h2>Casacas</h2>
        <a class="link" href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'})">Subir ↑</a>
      </div>

      <div class="grid">
        <article class="card product" data-cat="casacas" data-name="Casaca Bomber Negra" data-tags="bomber negra">
          <div class="thumb"><div class="imgph">CASACA</div></div>
          <div class="info">
            <h3>Casaca Bomber Negra</h3>
            <p class="meta">Bomber • Clásica</p>
            <div class="price-row">
              <span class="price">Bs. 299</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="casacas" data-name="Hoodie Vibex Purple" data-tags="hoodie morado">
          <div class="thumb"><div class="badge">Nuevo</div><div class="imgph">CASACA</div></div>
          <div class="info">
            <h3>Hoodie Vibex Purple</h3>
            <p class="meta">Hoodie • Warm</p>
            <div class="price-row">
              <span class="price">Bs. 279</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="casacas" data-name="Casaca Denim Blue" data-tags="denim azul">
          <div class="thumb"><div class="imgph">CASACA</div></div>
          <div class="info">
            <h3>Casaca Denim Blue</h3>
            <p class="meta">Denim • Street</p>
            <div class="price-row">
              <span class="price">Bs. 319</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- ACCESORIOS -->
    <section class="section" data-section="accesorios">
      <div class="section-head">
        <h2>Accesorios</h2>
        <a class="link" href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'})">Subir ↑</a>
      </div>

      <div class="grid">
        <article class="card product" data-cat="accesorios" data-name="Gorra Vibex Black" data-tags="gorra negra">
          <div class="thumb"><div class="imgph">ACCESORIO</div></div>
          <div class="info">
            <h3>Gorra Vibex Black</h3>
            <p class="meta">Snapback • Black</p>
            <div class="price-row">
              <span class="price">Bs. 89</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="accesorios" data-name="Canguro Street" data-tags="canguro bolso">
          <div class="thumb"><div class="imgph">ACCESORIO</div></div>
          <div class="info">
            <h3>Canguro Street</h3>
            <p class="meta">Bolso • Urban</p>
            <div class="price-row">
              <span class="price">Bs. 109</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>

        <article class="card product" data-cat="accesorios" data-name="Pack Medias Vibex" data-tags="medias pack">
          <div class="thumb"><div class="badge sale">-15%</div><div class="imgph">ACCESORIO</div></div>
          <div class="info">
            <h3>Pack Medias Vibex</h3>
            <p class="meta">Pack x3 • Soft</p>
            <div class="price-row">
              <span class="price"><s>Bs. 60</s> Bs. 51</span>
              <button class="btn" type="button" data-add>Agregar</button>
            </div>
          </div>
        </article>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div>© <span id="year"></span> Vibex. Catálogo demo.</div>
  </footer>

  <script>
    // Año
    document.getElementById("year").textContent = new Date().getFullYear();

    // Filtros
    const cats = document.querySelectorAll(".cat");
    const products = Array.from(document.querySelectorAll(".product"));
    const searchInput = document.getElementById("searchInput");
    const clearSearch = document.getElementById("clearSearch");

    let activeFilter = "all";

    function applyFilters(){
      const q = (searchInput.value || "").trim().toLowerCase();

      products.forEach(p => {
        const cat = p.dataset.cat;
        const name = (p.dataset.name || "").toLowerCase();
        const tags = (p.dataset.tags || "").toLowerCase();

        const matchCat = (activeFilter === "all") || (cat === activeFilter);
        const matchText = !q || name.includes(q) || tags.includes(q);

        p.style.display = (matchCat && matchText) ? "" : "none";
      });
    }

    cats.forEach(btn => {
      btn.addEventListener("click", () => {
        cats.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        activeFilter = btn.dataset.filter;
        applyFilters();

        // Scroll a la sección si no es "Todo"
        if(activeFilter !== "all"){
          const section = document.querySelector(`.section[data-section="${activeFilter}"]`);
          if(section) section.scrollIntoView({ behavior: "smooth", block: "start" });
        }
      });
    });

    searchInput.addEventListener("input", applyFilters);
    clearSearch.addEventListener("click", () => { searchInput.value = ""; applyFilters(); searchInput.focus(); });

    // Carrito demo (solo contador)
    let cart = 0;
    const cartCount = document.getElementById("cartCount");
    document.addEventListener("click", (e) => {
      const btn = e.target.closest("[data-add]");
      if(!btn) return;
      cart++;
      cartCount.textContent = cart;
      btn.textContent = "✓ Agregado";
      btn.disabled = true;
      setTimeout(() => { btn.textContent = "Agregar"; btn.disabled = false; }, 900);
    });
  </script>
</body>
</html>