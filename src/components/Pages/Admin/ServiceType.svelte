<script>
  import { onMount } from 'svelte';
	import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import DataTable from '../../Widgets/DataTable.svelte';
	const base_url = BASE_URL;
  let alertMessage = null;
  let alertMessageProps = {};
  let serviceTypeDataTable;

  onMount(() => {
    // console.log('index');
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    serviceTypeDataTable.list();
  });
</script>

<svelte:head>
	<title>Gestión de Tipos de Servicios</title>
</svelte:head>

<div class="container">
	<div class="row">
		<svelte:component this={alertMessage} {...alertMessageProps} />
		<div class="col-lg-12 page-header">
			<h2>Lista de Tipos de Servicios</h2>
		</div>
		<div class="col-md-5">
			<DataTable bind:this={serviceTypeDataTable} 
				urlServices={{ 
					list: `${base_url}admin/service_type/list`, 
					save: `${base_url}admin/service_type/save` 
				}}
				buttonAddRow={true},
				buttonSave={true},
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					name:{
						type: 'input[text]',
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
						caption: 'Operaciones',
						style:'text-align: center;',
					},]}
					messages={{
						notChanges: 'No ha ejecutado cambios en la tabla de tipos de servicios',
						list404: 'Rercuso no encontrado para listar los elmentos de la tabla de tipos de servicios',
						list500: 'Ocurrió un error en listar los elementos de la tabla de tipos de servicios',
						save404: 'Rercuso no encontrado para guardar los cambios de la tabla de tipos de servicios',
						save500: 'Ocurrió un error para guardar los cambios de la table de tipos de servicios',
						save200: 'Se han actualizado los registros de la tabla de tipos de servicios',
					}}
			/>
		</div>
	</div>
</div>

<style>

</style>