<script>
  const staticUrl = STATIC_URL;
</script>

<div class="container-fluid header bg-white p-0" id="home">
  <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
    <div class="col-md-6 p-5 mt-lg-5">
      <h1 class="display-5 animated fadeIn mb-4">Creando el <span class="text-primary">Arte</span> de Vivir con <span class="text-primary">Estilo</span> y <span class="text-primary">Comodidad</span></h1>
      <p class="animated fadeIn mb-4 pb-2">Nuestro trabajo es escuchar, estudiar y diseñar soluciones efectivas, que cada usuario obtenga el espacio adecuado a su actividad, identidad y filosofía.</p>
      <a href="/proyectos" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">
        <i class="fa fa-search" aria-hidden="true"></i>Ver Proyectos
      </a>
      <a href="{staticUrl}Antergo_Brochure.pdf" target="_blank" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">
        <i class="fa fa-book" aria-hidden="true"></i>Ver Brochure
      </a>
    </div>
    <div class="col-md-6 animated fadeIn">
      <div class="owl-carousel header-carousel">
        <div class="owl-carousel-item">
          <img class="img-fluid" src="{staticUrl}assets/img/carousel-1.jpg" alt="">
        </div>
        <div class="owl-carousel-item">
          <img class="img-fluid" src="{staticUrl}assets/img/carousel-2.jpg" alt="">
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .text-primary{
    color: var(--primary) !important;
  }

  .btn-primary, .btn-primary:hover{
    background-color: var(--secondary) !important;
    border: 1px solid var(--secondary) !important;
  }

  a > i{
    margin-right: 10px;
  }
</style>