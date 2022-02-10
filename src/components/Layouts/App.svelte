<script>
  import { onMount } from 'svelte';
  import page from 'page';
  import jQuery from 'jquery';
  import 'waypoints/lib/noframework.waypoints.js';
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
    // waypoints
    new Waypoint({
      element: document.getElementById('header'),
      handler: function(direction, event) {
        page('/');
      },
      offset: '-10%'
    })
    new Waypoint({
      element: document.getElementById('contact'),
      handler: function() {
        page('/contacto');
      },
      offset: '-10%'
    })
  });
</script>
<div id="overflow-scroll">
  <section id="header" class="sectionStage">
    <Header />
  </section>
  <TopBanner />
  <section id="contact" class="sectionStage"> 
    <Contact /> 
  </section>
  <DevelopedBy />
</div>

<style>
</style>