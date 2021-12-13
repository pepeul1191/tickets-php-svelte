<script>
  const static_url = STATIC_URL;
  import ContactForm from '../Forms/ContactForm.svelte';
</script>

<div class="d-md-flex h-md-100 align-items-center">
	<div class="col-md-6 p-0 bg-left h-md-100">
		<div class="text-white d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
			<div class="logoarea pt-5 pb-5">
        <h5 class="mb-4 font-weight-light">Sitio en Construcción<i class="fab fa-sass fa-2x text-cyan"></i></h5>
				<img src="{static_url}assets/img/logo.png" height="165" alt=""><br>
				<a target="_blank" class="btn btn-outline-light btn-lg" href="{static_url}brochure.pdf">Ver Brochure</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 p-0 bg-white h-md-100 loginarea">
		<div class="d-md-flex align-items-center h-md-100 p-5 justify-content-center">
			<ContactForm />
		</div>
	</div>
</div>

<style>
  @media (min-width: 768px) {
    .h-md-100 {
      height: 100vh;
    }
  }
  .btn-round { 
    border-radius: 30px;
  }
  .bg-left {
    background: var(--primary-color);
  }
  .text-cyan { 
    color: #35bdff;
  }
  img{
    margin-bottom: 30px;
  }
</style>