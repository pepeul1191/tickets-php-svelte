<script>
  import { onMount } from 'svelte';
	import { getServicesList } from '../../services/site_service.js';
  const static_url = STATIC_URL;
	export let services = [];
  // https://www.flaticon.es/packs/interior-design-48?word=interior%20design
  // https://www.flaticon.es/packs/ecology-and-environment-33

	onMount(() => {    
    getServicesList().then((resp) => {
      services = resp.data;
    }).catch((resp) =>  {
      if(resp.status == 404){
        console.error('Recurso para listar los servicios no existe');
      }else{
        console.error('Ocurrió un error en obtener los servicios');
      }
    })
  });
</script>

<div class="container-xxl py-5" id="services">
  <div class="container">
		<div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
			<h1 class="mb-3">Servicios</h1>
			<p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
		</div>
		<div class="row g-4">
			{#each services as service}
				<div class="col-lg-3 col-sm-6 col-6 wow fadeInUp" data-wow-delay="0.1s">
					<a class="cat-item d-block bg-light text-center rounded p-3" href="#" on:click|preventDefault={(event) => {return false;}}>
						<div class="rounded p-4">
							<div class="icon mb-3">
								<img class="img-fluid" src="{static_url}{service.url}" alt="Icon" width="64" height="64">
							</div>
							<h6>{service.name}</h6>
						</div>
					</a>
				</div>
			{/each}
		</div>
  </div>
</div>

<style>
  a{
    text-decoration: none;
  }

  .cat-item div {
    background: #FFFFFF;
    border: 1px dashed rgba(124, 124, 128, .5);
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
    border: 1px dashed rgba(124, 124, 128, .5);
  }

  h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-family: "Inter",sans-serif;
    font-weight: 700;
    line-height: 1.2;
    color: #212529;
  }

  .py-5 {
    padding-bottom: 0rem!important;
  }

  @media (max-width: 576px) {
    h6 {
      
    }

    .p-4 {
      padding: 0.5rem!important;
    }
  }
</style>