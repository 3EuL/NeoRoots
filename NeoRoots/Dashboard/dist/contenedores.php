<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link">Contact</a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->

            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="../assets/img/user1-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="../assets/img/user8-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="../assets/img/user3-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->

            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="../assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="../assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-outline-secondary">Profile</a>
                  <a href="../../FrontEnd/MainPage.php" class="btn btn-outline-danger float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="../../ASSETS/Logos/LogoProyecto.php"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">NeoRoots</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="bi bi-view-stacked"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ranking.php" class="nav-link">
                  <i class="bi bi-bar-chart-line-fill"></i>
                  <p>Ranking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="bi bi-table"></i>
                  <p>
                    CRUD
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="contenedores.php" class="nav-link">
                      <i class="bi bi-recycle"></i>
                      <p>containers</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="users.php" class="nav-link">
                      <i class="bi bi-people-fill small-box-icon"></i>
                      <p>users</p>
                    </a>
                  </li>
                </ul>
              </li>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Contenedores</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Contenedores</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <div class="row">
<?php
include './php/db.php';

$result = $conn->query("SELECT * FROM containers");

if(!$result){
    die("Error en la consulta: " . $conn->error);
}
?>

<?php if($result->num_rows > 0): ?>

<!-- BOTÓN NUEVO -->
<div class="col-md-2 mb-4">
  <div class="card text-center p-2 h-100 d-flex justify-content-center align-items-center" style="
    background: rgb(31, 116, 65);
    border: 2px dashed rgb(0, 51, 21);
    border-radius: 15px;
    cursor: pointer;
    min-height: 140px;
  " data-bs-toggle="modal" data-bs-target="#modalCrear">

    <div>
      <h1 style="font-size:50px; color:#9be7a1;">+</h1>
      <p style="color:#9be7a1;">Nuevo Contenedor</p>
    </div>

  </div>
</div>

<?php while($row = $result->fetch_assoc()): 

// ================= CONTRASTE AUTOMÁTICO =================
$bg = $row['colour'];
$hex = str_replace('#', '', $bg);

$r = hexdec(substr($hex, 0, 2));
$g = hexdec(substr($hex, 2, 2));
$b = hexdec(substr($hex, 4, 2));

$luminancia = (0.299 * $r + 0.587 * $g + 0.114 * $b);

$textColor = ($luminancia > 186) ? '#000000' : '#FFFFFF';
$borderColor = ($luminancia > 186) ? 'rgba(0,0,0,0.3)' : 'rgba(255,255,255,0.3)';

// ================= ESTADO =================
$nivel = rand(10, 100); 

if($nivel < 40){
  $estado = "Disponible";
  $estadoColor = "#00e676";
} elseif($nivel < 80){
  $estado = "Medio";
  $estadoColor = "#ffc107";
} else {
  $estado = "Lleno";
  $estadoColor = "#ff5252";
}
?>

<!-- TARJETA -->
<div class="col-md-4 mb-4">
  <div class="card shadow" style="
    background: <?= $bg ?>;
    color: <?= $textColor ?>;
    border-radius: 15px;
    border: 1px solid <?= $borderColor ?>;
  ">

    <div class="card-body text-center">

      <!-- ICONO -->
      <div style="
        width:60px;
        height:60px;
        border-radius:50%;
        margin:auto;
        background: <?= $bg ?>;
        border:2px solid <?= $textColor ?>;
        display:flex;
        align-items:center;
        justify-content:center;
        color: <?= $textColor ?>;
        font-size:25px;
      ">
        <i class="bi bi-trash3-fill"></i>
      </div>

      <!-- TEXTO -->
      <h4 class="mt-3" style="color: <?= $textColor ?>;">
        <?= $row['waste_type'] ?>
      </h4>

      <p style="color: <?= $textColor ?>;">
        <?= $row['description'] ?>
      </p>

      <!-- ESTADO -->
      <div style="
        margin-top:10px;
        padding:5px 10px;
        border-radius:20px;
        display:inline-block;
        background: <?= $estadoColor ?>;
        color:#000;
        font-size:12px;
        font-weight:bold;
      ">
        <?= $estado ?> (<?= $nivel ?>%)
      </div>

      <!-- BOTONES -->
      <div class="mt-3 d-flex justify-content-center gap-2">

        <!-- EDITAR -->
        <button 
          class="btn btnEditar"
          data-id="<?= $row['container_id'] ?>"
          data-colour="<?= $row['colour'] ?>"
          data-type="<?= $row['waste_type'] ?>"
          data-desc="<?= $row['description'] ?>"
          data-bs-toggle="modal"
          data-bs-target="#modalEditar"
          style="
            background: transparent;
            color: <?= $textColor ?>;
            border: 1px solid <?= $textColor ?>;
          ">
          <i class="bi bi-pencil-fill"></i>
        </button>

        <!-- ELIMINAR -->
        <button 
          class="btn"
          data-id="<?= $row['container_id'] ?>"
          data-bs-toggle="modal"
          data-bs-target="#modalEliminar"
          style="
            background: transparent;
            color: <?= $textColor ?>;
            border: 1px solid <?= $textColor ?>;
          ">
          <i class="bi bi-trash3-fill"></i>
        </button>

      </div>

    </div>
  </div>
</div>

<?php endwhile; ?>

<?php else: ?>

<div class="text-center mt-5">
  <h4 style="color:#9be7a1;">No hay contenedores registrados</h4>
  <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modalCrear">
    + Crear primer contenedor
  </button>
</div>

<?php endif; ?>
</div>
<!-- ================= MODAL CREAR ================= -->
<div class="modal fade" id="modalCrear">
  <div class="modal-dialog">
    <div class="modal-content" style="background:#0c180d; color:white;">

      <form method="POST" action="./php/procesador_contenedores.php">
        <div class="modal-header">
          <h5>Nuevo Contenedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="color" name="colour" class="form-control form-control-color mb-2" value="#00e676">
          <input name="waste_type" class="form-control mb-2" placeholder="Tipo de residuo" required>
          <textarea name="description" class="form-control" placeholder="Descripción"></textarea>
        </div>

        <div class="modal-footer">
          <button name="crear" class="btn btn-success">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- ================= MODAL EDITAR ================= -->
<div class="modal fade" id="modalEditar">
  <div class="modal-dialog">
    <div class="modal-content" style="background:#0c180d; color:white;">

      <form method="POST" action="./php/procesador_contenedores.php">
        <div class="modal-header">
          <h5>Editar Contenedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <input type="hidden" name="id" id="edit_id">

          <input type="color" name="colour" id="edit_colour" class="form-control form-control-color mb-2">
          <input name="waste_type" id="edit_type" class="form-control mb-2">
          <textarea name="description" id="edit_desc" class="form-control"></textarea>

        </div>

        <div class="modal-footer">
          <button name="editar" class="btn btn-warning">Actualizar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- ================= MODAL ELIMINAR ================= -->
<div class="modal fade" id="modalEliminar">
  <div class="modal-dialog">
    <div class="modal-content" style="background:#0c180d; color:white;">

      <div class="modal-header">
        <h5>Eliminar contenedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        ¿Seguro que deseas eliminar este contenedor?
      </div>

      <div class="modal-footer">
        <form method="POST" action="./php/procesador_contenedores.php">
          <input type="hidden" name="delete" id="delete_id">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </div>

    </div>
  </div>
</div>

      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2026&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
      document.querySelectorAll('.btnEditar').forEach(btn => {
      btn.addEventListener('click', () => {
      document.getElementById('edit_id').value = btn.dataset.id;
      document.getElementById('edit_colour').value = btn.dataset.colour;
      document.getElementById('edit_type').value = btn.dataset.type;
      document.getElementById('edit_desc').value = btn.dataset.desc;
      });
    });
      const modalEliminar = document.getElementById('modalEliminar');

modalEliminar.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget; // botón que abrió el modal
  const id = button.getAttribute('data-id');

  document.getElementById('delete_id').value = id;
});
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
