<script>
  import jQuery from 'jquery';
  import { onMount } from 'svelte';
  
  var spinner = function () {
    setTimeout(function () {
      if (jQuery('#spinner').length > 0) {
        jQuery('#spinner').removeClass('show');
      }
    }, 1);
  };

  onMount(() => {
    spinner();
  });
</script>

<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
  <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
    <span class="sr-only"></span>
  </div>
</div>

<style>
  #spinner {
    opacity: 0;
    visibility: hidden;
    transition: opacity .5s ease-out, visibility 0s linear .5s;
    z-index: 99999;
  }

  #spinner.show {
    transition: opacity .5s ease-out, visibility 0s linear 0s;
    visibility: visible;
    opacity: 1;
  }
</style>