<script>
  import jQuery from 'jquery';
  const static_url = STATIC_URL;
  import { changeNav } from '../Stores/changeNav.js'
  export let page;
  let tab = null;
  let collapsed = false;

  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 45) {
      jQuery('.nav-bar').addClass('sticky-top');
    } else {
      jQuery('.nav-bar').removeClass('sticky-top');
    }
  });

  changeNav.subscribe(newTab => {
		tab = newTab;
    jQuery("#navbarCollapse").removeClass("show");
	});

  const collapse = (event) => {
    //console.log(collapsed)
    if(collapsed == true){
      collapsed = false;
    }else{
      collapsed = true;
    }
    
    if(!collapsed){
      jQuery('#navbarCollapse').addClass('d-none');
      collapsed = false;
    }else{
      jQuery('#navbarCollapse').removeClass('d-none');
      collapsed = true;
    }
  };

  const navtigation = (section) => {
    //console.log(collapsed)
    if(collapsed == true){
      collapsed = false;
    }else{
      collapsed = true;
    }
    page.redirect(`/${section}`)
  };
</script>

<div class="container-fluid nav-bar bg-transparent">
  <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
    <a href="/" class="navbar-brand d-flex align-items-center text-center">
      <div class="icon p-2 me-2">
        <img class="img-fluid" src="{static_url}assets/img/logo-nav.png" alt="Icon" style="width: 170px; height: 48px;">
      </div>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" on:click|preventDefault={(event)=>collapse(event)}>
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto">
        <a href="/" class="nav-item nav-link {tab == 'home' ? 'active' : ''}" section="home" on:click|preventDefault={(event)=>navtigation('')}>Home</a>
        <a href="/nosotros" class="nav-item nav-link {tab == 'about' ? 'active' : ''}" section="about" on:click|preventDefault={(event)=>navtigation('nosotros')}>Nosotros</a>
        <a href="/servicios" class="nav-item nav-link {tab == 'services' ? 'active' : ''}" section="services" on:click|preventDefault={(event)=>navtigation('servicios')}>Servicios</a>
        <a href="/proyectos" class="nav-item nav-link {tab == 'projects' ? 'active' : ''}" section="projects" on:click|preventDefault={(event)=>navtigation('proyectos')}>Proyectos</a>
        <a href="/contacto" class="nav-item nav-link {tab == 'contact' ? 'active' : ''}" section="contact" on:click|preventDefault={(event)=>navtigation('contacto')}>Contacto</a>
        <!--
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Servicios</a>
          <div class="dropdown-menu rounded-0 m-0">
            <a href="property-list.html" class="dropdown-item">Property List</a>
            <a href="property-type.html" class="dropdown-item">Property Type</a>
            <a href="property-agent.html" class="dropdown-item">Property Agent</a>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu rounded-0 m-0">
            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
            <a href="404.html" class="dropdown-item">404 Error</a>
          </div>
        </div>
        -->
      </div>
      <a href="/login" class="btn btn-primary px-3 d-none d-lg-flex">Intranet</a>
    </div>
  </nav>
</div>

<style>
 .nav-bar {
    position: relative;
    margin-top: 45px;
    padding: 0 3rem;
    transition: .5s;
    z-index: 90 !important;
    }

  .nav-bar.sticky-top {
    position: sticky !important;
    padding: 0 !important;
    z-index: 90 !important;
  }

  .navbar {
    box-shadow: 0 0 30px rgba(0, 0, 0, .08);
  }

  .navbar .dropdown-toggle::after {
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    vertical-align: middle;
    margin-left: 5px;
    transition: .5s;
  }

  .navbar .dropdown-toggle[aria-expanded=true]::after {
    transform: rotate(-180deg);
  }

  .navbar-light .navbar-nav .nav-link {
    margin-right: 30px;
    padding: 25px 0;
    color: #FFFFFF;
    font-size: 15px;
    text-transform: uppercase;
    outline: none;
  }

  .navbar-light .navbar-nav .nav-link:hover,
  .navbar-light .navbar-nav .nav-link.active {
    color: var(--primary);
  }

  .btn-primary{
    background-color:  var(--primary);
    border: 1px solid var(--primary);
    text-transform: uppercase;
  }

  @media (max-width: 991.98px) {
    .nav-bar {
      margin: 0;
      padding: 0;
    }

    .navbar-light .navbar-nav .nav-link  {
      margin-right: 0;
      padding: 10px 0;
    }

    .navbar-light .navbar-nav {
        border-top: 1px solid #EEEEEE;
    }
  }

  .navbar-light .navbar-brand {
    height: 75px;
  }

  .navbar-light .navbar-nav .nav-link {
    color: var(--dark);
    font-weight: 500;
  }

  @media (min-width: 992px) {
    .navbar .nav-item .dropdown-menu {
      display: block;
      top: 100%;
      margin-top: 0;
      transform: rotateX(-75deg);
      transform-origin: 0% 0%;
      opacity: 0;
      visibility: hidden;
      transition: .5s;    
    }

    .navbar .nav-item:hover .dropdown-menu {
      transform: rotateX(0deg);
      visibility: visible;
      transition: .5s;
      opacity: 1;
    }
  }

  .dropdown-toggle::after{
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    vertical-align: middle;
    margin-left: 5px;
    transition: .5s;
  }
</style>