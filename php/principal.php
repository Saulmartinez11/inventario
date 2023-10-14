<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventarios de Bodeguero</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/para-proyecto.css" rel="stylesheet">

</head>

<body>

    <!--*******************
    Inicio del precargador
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
      FInal del precargador
    ********************-->
    

    <!--**********************************
      Inicio de la envoltura principal
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
          Inicio del encabezado de navegación
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img src="images/178940393_469162514417984_6848956263872598253_n.jpg"width="500" height="45">
				
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Final del encabezado de navegación
        ***********************************-->
		
		<!--**********************************
               Inicio del encabezado
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Bienvenido a tu Sistema de Inventario
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
							
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
									<img src="images/profile/pic1.jpg" width="20" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Perfil </span>
                                    </a>
                                    <a href="page-login.html" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Cerrar sesión </span>
                                    </a>
                                </div>
                            </li>
							<li class="dropdown schedule-event primary">
								<a href="javascript:void(0)" class="btn btn-primary btn-rounded event-btn">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="scale5 me-0 mb-0 me-sm-2 mb-sm-1"><path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 2V6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 2V6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 10H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> 
								</a>
							</li>
                        </ul>
					</div>
                </nav>
            </div>
        </div>
        <!--**********************************
                 Fin del encabezado
        ***********************************-->

        <!--**********************************
            Inicio de la barra lateral
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Inventarios de Bodeguero</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="index.html">Inicio</a></li>
							<li><a href="analytics.html">Usuarios</a></li>
							<li><a href="content.html">Categorias</a></li>
							<li><a href="all-ticket.html">Lista Control</a></li>
							<li><a href="customer-list.html">Empleados</a></li>
							<li><a href="reviews.html">Listado de control de empleados</a></li>
						</ul>
                    </li>
					<li>
						<a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
							<i class="flaticon-381-diploma"></i>
							<span class="nav-text">Categorias</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="content.html">Tipo de categorias</a></li>
							<li><a href="menu-1.html">Editar Categoria</a></li>
						</ul>
                    </li>
					<li>
						<a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
							<i class="flaticon-381-id-card"></i>
							<span class="nav-text">Listado de control</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="create-ticket.html">Listar Control</a></li>
							<li><a href="all-ticket.html">Controles</a></li>
						</ul>
                    </li>
					<li>
						<a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
							<i class="flaticon-381-id-card-4"></i>
							<span class="nav-text">Empleados</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="agregar-empleados.html">Agregar Empleados</a></li>
							<li><a href="customer-list.html">Empleados</a></li>
						</ul>
                    </li>
                    <li>
						<a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
						<i class="flaticon-381-television"></i>
							<span class="nav-text">Usuario</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="app-profile.html">Usuario</a></li>
                            <li><a href="analytics.html">Usuarios</a></li>
							<li><a href="edit-profile.html">Editar Usuario </a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
							<i class="flaticon-381-controls-3"></i>
							<span class="nav-text">Lista de Control de Empleados</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="chart-flot.html">Lista de Control</a></li>
                            <li><a href="chart-morris.html">Controles</a></li>
                        </ul>
                    </li>
                </ul>
			</div>
        </div>
        <!--**********************************
            Final de la barra lateral
        ***********************************-->
		
		<!--**********************************
                 Lista de eventos
        ***********************************-->
		
		<div class="event-sidebar dz-scroll active" id="eventSidebar">
			<div class="card shadow-none rounded-0 bg-transparent h-auto mb-0"></div>
			    <div class="card-body text-center event-calender pb-2">
					<input type='text' class="form-control d-none" id='datetimepicker1' />
				</div>
			<!--</div>-->
		</div>
		
		<!--**********************************

             Inicio del cuerpo del contenido
        ***********************************-->
		<section class="full-width pageContent">
            <!-- barra de navegación -->
            <div class="full-width navBar">
                <div class="full-width navBar-options">
                    <i class="zmdi zmdi-swap btn-menu" id="btn-menu"></i>	
                </div>
            </div>
            <section class="full-width text-center" style="padding: 40px 0;">
                <h3 class="text-center tittles">SELECCIONES</h3>
                <!-- titulos -->
                <article class="full-width tile">
                    <li><a href="app-profile.html">
                    <div class="tile-text">
                        <div class="Usuario-icono">
                            <i class="bi bi-person-video2"></i>
                        </div>
                        <span class="text-condensedLight">
                            2<br>
                            <small>Usuarios</small>
                        </span>
                    </div>
                    </a></li>
                    <i class="zmdi zmdi-account tile-icon"></i>
                </article>
                <article class="full-width tile">
                    <li><a href="content.html">
                    <div class="tile-text">
                        <div class="Categoria-icono">
                            <i class="bi bi-bookmark"></i>
                        </div>
                        <span class="text-condensedLight">
                            71<br>
                            <small>Categorias</small>
                        </span>
                    </div>
                    </a></li>
                    <i class="zmdi zmdi-accounts tile-icon"></i>
                </article>
                <article class="full-width tile">
                    <li><a href="all-ticket.html">
                    <div class="tile-text">
                        <div class="Control-icono">
                            <i class="bi bi-card-checklist"></i>
                        </div>
                        <span class="text-condensedLight">
                            7<br>
                            <small>Lista control</small>
                        </span>
                    </div>
                    </a></li>
                    <i class="zmdi zmdi-truck tile-icon"></i>
                </article>
                <article class="full-width tile">
                    <li><a href="chat.html">
                    <div class="tile-text">
                        <div class="Empleados-icono">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <span class="text-condensedLight">
                            9<br>
                            <small>Empleados</small>
                        </span>
                    </div>
                    </a></li>
                    <i class="zmdi zmdi-label tile-icon"></i>
                </article>
                <article class="full-width tile">
                    <li><a href="chart-flot.html">
                    <div class="tile-text">
                        <div class="List-Empleados-icono">
                            <i class="bi bi-list-ul"></i>
                        </div>
                        <span class="text-condensedLight">
                            121<br>
                            <small>Listado empleados</small>
                        </span>
                    </div>
                    </a></li>
                    <i class="zmdi zmdi-washing-machine tile-icon"></i>
                </article>
            </section>
        </section>
        <!--**********************************
            Fin del cuerpo del contenido
        ***********************************-->


    </div>
    <!--**********************************
        Final de la envoltura principal
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="vendor/bootstrap-datetimepicker/js/moment.js"></script>
	<script src="vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="vendor/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
    
</body>
</html>