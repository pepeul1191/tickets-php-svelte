<script>
  import { onMount } from 'svelte';
	import { navigate, link } from 'svelte-routing';
  import DataTable from '../../Widgets/DataTable.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  const baseURL = BASE_URL;
  export let id;
  export let disabled = false;
  let disabledInCreate = true;
  let title = 'Incidencias de Servicios';
  let alertMessage = null;
  let serviceDataTable;
  let alertMessageProps = {};

  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    serviceDataTable.list();
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
    <div class="col-md-12">
      <DataTable bind:this={serviceDataTable} 
				urlServices={{ 
					list: `${baseURL}admin/service/list`, 
					save: `${baseURL}admin/service/delete` 
				}}
				buttonSave={true}
				buttonAddRecord={'/service/add'}
        colspanFooter={8},
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					state_name:{
						type: 'td',
					},
          priority_name:{
						type: 'td',
					},
          branch_name:{
						type: 'td',
					},
          created:{
						type: 'td',
					},
          edited:{
						type: 'td',
					},
          worker_name:{
						type: 'td',
					},
          resume:{
						type: 'td',
					},
					actions:{
						type: 'actions',
						buttons: [
              {
								type: 'link', 
								icon: 'fa fa-pencil', 
								style:'font-size:12px; margin-right:10px;',
								url: '/service/edit/',
                key: 'id',
							},
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
						style: 'display:none',
					},
          {
						caption: 'Estado',
					},
					{
						caption: 'Prioridad',
					},
          {
						caption: 'Sede',
					},
          {
						caption: 'Creado',
					},
          {
						caption: 'Editado',
					},
          {
						caption: 'Reportado por',
					},
          {
						caption: 'Resumen',
					},
					{
						caption: 'Operaciones',
						style:'text-align: center;',
					},]}
        messages={{
          notChanges: 'No ha ejecutado cambios en la tabla de proyectos',
          list404: 'Rercuso no encontrado para listar los elmentos de la tabla de proyectos',
          list500: 'Ocurrió un error en listar los elementos de la tabla de proyectos',
          save404: 'Rercuso no encontrado para guardar los cambios de la tabla de proyectos',
          save500: 'Ocurrió un error para guardar los cambios de la table de proyectos',
          save200: 'Se han actualizado los registros de la tabla de proyectos',
        }}
        pagination={{
          step: 10,
        }}
			/>
    </div>
  </div>
</div>

<style>

</style>