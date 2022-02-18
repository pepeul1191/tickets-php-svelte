<script>
  // https://fontawesome.com/v4/icons/
  const staticUrl = STATIC_URL;
</script>

<div class="container-xxl py-5 bg-light" id="about">
  <div class="container">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
      <h1 class="mb-3">Nosotros</h1>
      <p>Somos una empresa peruana de arquitectura y diseño interior, enfocada en atender las necesidades y expectativas de nuestros clientes. <br>Algo que nos distingue:</p>
    </div>
    <div class="row g-4">
      <div class="col-12">
        <div class="row gy-4">
          <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
            <div class="bg-light rounded p-3">
              <div class="d-flex align-items-center bg-white rounded p-3 dashed-primary">
                <div class="icon me-3" style="width: 145px; height: 145px;">
                  <img class="img-fluid svelte-1oeojtn" src="{staticUrl}assets/img/services-1.png" alt="Icon">
                </div>
                <span>Diseños personalizados, funcionales y ergonómicos para el hogar o negocio.</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
            <div class="bg-light rounded p-3">
              <div class="d-flex align-items-center bg-white rounded p-3 dashed-primary" >
                <div class="icon me-3" style="width: 145px; height: 145px;">
                  <img class="img-fluid svelte-1oeojtn" src="{staticUrl}assets/img/services-2.png" alt="Icon">
                </div>
                <span>Diseños personalizados, funcionales y ergonómicos para el hogar o negocio.</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
            <div class="bg-light rounded p-3">
              <div class="d-flex align-items-center bg-white rounded p-3 dashed-primary" >
                <div class="icon me-3" style="width: 145px; height: 145px;">
                  <img class="img-fluid svelte-1oeojtn" src="{staticUrl}assets/img/services-3.png" alt="Icon">
                </div>
                <span>Diseños personalizados, funcionales y ergonómicos para el hogar o negocio.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .py-5{
    padding-bottom: 3rem!important;
  }


  .icon {
    padding: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF !important;
    border-radius: 50px;
    border: 0px dashed var(--secondary) !important;
  }

  .text-primary {
    --bs-text-opacity: 1;
    color: rgba(var(--primary),var(--bs-text-opacity))!important;
  }

  .dashed-primary{
    border: 1px dashed var(--primary);
  }
</style>