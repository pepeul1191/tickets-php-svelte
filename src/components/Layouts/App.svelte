<script>
  import Header from '../Sections/Header.svelte';
  import Contact from '../Sections/Contact.svelte';
  import DevelopedBy from '../Sections/DevelopedBy.svelte';
  import TopBanner from '../Sections/TopBanner.svelte';
  import Spinner from '../Sections/Spinner.svelte';
  
  let phone = '+51901268633';
</script>

<div class="container-xxl bg-white p-0" id="demo">
  <Spinner />
  <Header />
  <TopBanner />
  <Contact /> 
  <DevelopedBy />
</div>

<a href="https://api.whatsapp.com/send?phone={phone}&text=Consulta%20desde%20la%20web" class="btn btn-lg btn-primary btn-lg-square whatsapp-fixed">
  <i class="bi bi-whatsapp"></i>
</a>

<style>
  .whatsapp-fixed {
    position: fixed;
    z-index: 99;
    width: 80px;
    height: 80px;
    bottom: 40px;
    right: 40px;
    background-color: #00bfa5;
    border-color: #00bfa5;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 42px;
  }

  .whatsapp-fixed:hover{
    color: #fff;
    background-color: #28ac00;
    border-color: #28ac00;
  }
</style>