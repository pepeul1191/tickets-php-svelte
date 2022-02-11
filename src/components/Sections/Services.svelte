<script>
  const static_url = STATIC_URL;
</script>

<div class="container-xxl py-5">
  <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
          <h1 class="mb-3">Servicios</h1>
          <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
      </div>
      <div class="row g-4">
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-apartment.png" alt="Icon">
                      </div>
                      <h6>Apartment</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-villa.png" alt="Icon">
                      </div>
                      <h6>Villa</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-house.png" alt="Icon">
                      </div>
                      <h6>Home</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-housing.png" alt="Icon">
                      </div>
                      <h6>Office</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-building.png" alt="Icon">
                      </div>
                      <h6>Building</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-neighborhood.png" alt="Icon">
                      </div>
                      <h6>Townhouse</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-condominium.png" alt="Icon">
                      </div>
                      <h6>Shop</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
              <a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
                  <div class="rounded p-4">
                      <div class="icon mb-3">
                          <img class="img-fluid" src="{static_url}assets/img/icon-luxury.png" alt="Icon">
                      </div>
                      <h6>Garage</h6>
                  </div>
              </a>
          </div>
      </div>
  </div>
</div>

<style>
  a{
    text-decoration: none;
  }

  .cat-item div {
    background: #FFFFFF;
    border: 1px dashed rgba(0, 185, 142, .3);
    transition: .5s;
  }

  .cat-item:hover div {
    background: var(--secondary);
    border-color: transparent;
  }

  .cat-item div * {
    transition: .5s;
  }

  .cat-item:hover div * {
    color: #FFFFFF !important;
  }

  .icon {
    padding: 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF !important;
    border-radius: 50px;
    border: 1px dashed var(--secondary) !important;
  }

  h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-family: "Inter",sans-serif;
    font-weight: 700;
    line-height: 1.2;
    color: #0E2E50;
  }
</style>