<script>
  import { onMount } from 'svelte';
  import page from 'page';
  import jQuery from 'jquery';
  import Nav from '../Sections/Nav.svelte';
  import Contact from '../Sections/Contact.svelte';
  import DevelopedBy from '../Sections/DevelopedBy.svelte';
  import Header from '../Sections/Header.svelte';
  import Spinner from '../Sections/Spinner.svelte';
  import About from '../Sections/About.svelte';
  import Services from '../Sections/Services.svelte';
  import Projects from '../Sections/Projects.svelte';
  import { changeNav } from '../Stores/changeNav.js'
  
  let enterpriseData = ENTERPRISE_DATA;
  let pos = 0;

  onMount(() => {    
    page('/', () => {
      pos = jQuery('#home').offset().top - 100;
      jQuery('html, body').animate({ 
        scrollTop: pos
      }, 900);
      changeNav.update(nav => 'home')
    });
    page('/nosotros', () => {
      pos = jQuery('#about').offset().top - 100;
      jQuery('html, body').animate({ 
        scrollTop: pos
      }, 900);
      changeNav.update(nav => 'about')
    });
    page('/servicios', () => {
      pos = jQuery('#services').offset().top - 100;
      jQuery('html, body').animate({ 
        scrollTop: pos
      }, 900);
      changeNav.update(nav => 'services')
    });
    page('/proyectos', () => {
      pos = jQuery('#projects').offset().top - 100;
      jQuery('html, body').animate({ 
        scrollTop: pos
      }, 900);
      changeNav.update(nav => 'projects')
    });
    page('/contacto', () => {
      pos = jQuery('#contact').offset().top - 100;
      jQuery('html, body').animate({ 
        scrollTop: pos
      }, 900);
      changeNav.update(nav => 'contact')
    });
    page.start();
  });
</script>

<div class="container-xxl bg-white p-0">
  <Spinner />
  <Nav />
  <Header />
  <About />
  <Services />
  <Projects />
  <Contact /> 
  <DevelopedBy />
</div>

<a href="https://api.whatsapp.com/send?phone={enterpriseData.phone}&text=Consulta%20desde%20la%20web" class="btn btn-lg btn-primary btn-lg-square whatsapp-fixed" target="_blank">
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