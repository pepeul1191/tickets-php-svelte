<script>
  import { onMount } from 'svelte';
  import page from 'page';
  import jQuery from 'jquery';
  import Header from '../Sections/Header.svelte';
  import Contact from '../Sections/Contact.svelte';
  import DevelopedBy from '../Sections/DevelopedBy.svelte';
  import TopBanner from '../Sections/TopBanner.svelte';
   // set default component
  onMount(() => {
    page('/', () => {
      jQuery('html, body').animate({ 
        scrollTop: jQuery('#header').offset().top 
      }, 500);
    });
    page('/contacto', () => {
      jQuery('html, body').animate({ 
        scrollTop: jQuery('#contact').offset().top 
      }, 500);
    });
    // activate router
    page.start();
  });
</script>

<section id="header"><Header /></section>
<TopBanner />
<section id="contact"> <Contact /> </section>
<DevelopedBy />

<style>
</style>