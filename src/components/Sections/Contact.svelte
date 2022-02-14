<script>
  const static_url = STATIC_URL;
  import ContactForm from '../Forms/ContactForm.svelte';
  let enterpriseData = ENTERPRISE_DATA;
</script>

<div class="d-md-flex h-md-100 align-items-center" id="contact">
	<div class="col-md-6 p-0 bg-left h-md-100">
		<div class="text-white d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
			<div class="logoarea pt-5 pb-5">
				<img src="{static_url}assets/img/logo.png" height="135" alt=""><br>
        <p class="info">Teléfono<br>
        <a href="tel:{enterpriseData.phone}">{enterpriseData.phone}</a><br>
        Correo<br>
        <a href="mailto:{enterpriseData.email}">{enterpriseData.email}</a></p>
        <div>
          <a href="{enterpriseData.facebook}" target="_blank" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="{enterpriseData.instagram}" target="_blank" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="https://api.whatsapp.com/send?phone={enterpriseData.phone}&text=Consulta%20desde%20la%20web" target="_blank" class="social"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
        </div>
			</div>
		</div>
	</div>
	<div class="col-md-6 p-0 bg-white h-md-100 loginarea wow">
		<div class="d-md-flex align-items-center h-md-100 p-3 justify-content-center">
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
    background: var(--secondary);
  }

  .text-cyan { 
    color: #35bdff;
  }

  img{
    margin-bottom: 30px;
  }

  .social{
    color: white;
    font-size: 20px;
    margin-left: 25px;
  }

  .social:hover{
    font-weight: 500;
  }

  div .social:first-child {
    margin-left: 0px;
  }

  .info{
    margin-top: 10px;
    font-size: 15px;
  }

  .btn-outline-light:hover{
    color: var(--primary);
    text-decoration: none !important;
  }

  .logoarea a{
    text-decoration: none;
    color: white;
  }

  .logoarea a:hover{
    text-decoration: underline;
    font-weight: 500;
  }

</style>