<script>
  import { onMount } from 'svelte';
  import DataTable from '../../Widgets/DataTable.svelte';
  import AlertMessage from '../../Widgets/AlertMessage.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  const base_url = BASE_URL;
  export let id;
  export let disabled = false;
  let imagesBranchDataTable;
  let disabledInCreate = true;
  let title = 'Gestión de Servicios';
  let alertMessage = null;
  let alertMessageProps = {};

  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    imagesBranchDataTable.list();
  });

  const launchAlert = (event, message, type) => {
    alertMessage = null;
    alertMessage = AlertMessage;
    alertMessageProps = {
      message: message,
      type: type,
      timeOut: 5000
    }
  };
  
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
      <h6>Listas de Servicios</h6>
      <DataTable bind:this={imagesBranchDataTable} 
				urlServices={{ 
					list: `${base_url}admin/service/list`, 
					save: `${base_url}admin/service/save` 
				}}
				buttonSave={true},
        buttonAddRow={true},
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					name:{
						type: 'input[text]',
					},
          url:{
						type: 'upload',
            style: 'text-align: center',
            tableKeyURL: 'url',
            tableRecordKey: 'id',
					},
          actions:{
						type: 'actions',
						buttons: [
							{
								type: 'delete',
							},
						],
						style: 'text-align:center;'
					},
				}}
				headers={[
					{
						caption: 'codigo',
						style: 'display:none;',
					},
					{
						caption: 'Nombre',
					},
          {
						caption: 'Imágenes del Servicio',
            style: 'text-align: center',
					},
          {
						caption: 'Operaciones',
						style:'text-align: center;',
					},
				]}
				messages={{
					notChanges: 'No ha ejecutado cambios en los servicios',
					list404: 'Rercuso no encontrado para listar los elmentos de los servicios',
					list500: 'Ocurrió un error en listar los elementos de los servicios',
					save404: 'Rercuso no encontrado para guardar los cambios de los servicios',
					save500: 'Ocurrió un error para guardar los cambios de los servicios',
					save200: 'Se han actualizado los registros de los servicios',
				}}
        disabled={disabledInCreate & disabled}
			/>
    </div>
  </div>
</div>

<style>

</style>