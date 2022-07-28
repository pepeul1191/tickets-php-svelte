<script>
  import { onMount } from 'svelte';
	import { navigate, link } from 'svelte-routing';
  import DataTable from '../../Widgets/DataTable.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  const base_url = BASE_URL;
  export let id;
  export let disabled = false;
  let disabledInCreate = true;
  let title = 'Incidencias de Servicios';
  let alertMessage = null;
  let alertMessageProps = {};

  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
  });  
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<div class="container">
	<div class="row">
		<div class="col-lg-12 page-header">
			<h2>{title}</h2>
		</div>
  </div>
  <div class="row">
    <svelte:component this={alertMessage} {...alertMessageProps} />
    <div class="col-md-6">
      <br>
      <h6>Listas de Incidencias de Servicios</h6>
      
			<a class="btn btn-secondary"  use:link href="/service/add"> <i class="fa fa-plus" style="margin-right:5px"></i>Agregar Registro</a>
    </div>
  </div>
</div>

<style>

</style>