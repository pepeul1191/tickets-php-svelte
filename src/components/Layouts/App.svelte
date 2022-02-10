<script>
  import Header from '../Sections/Header.svelte';
  import Contact from '../Sections/Contact.svelte';
  import DevelopedBy from '../Sections/DevelopedBy.svelte';
  import TopBanner from '../Sections/TopBanner.svelte';

  import Spinner from '../Sections/Spinner.svelte';
  
</script>

<div class="container-xxl bg-white p-0" id="demo">
  <Spinner />
  <Header />
  <TopBanner />
  <Contact /> 
  <DevelopedBy />
</div>

<style>
</style>