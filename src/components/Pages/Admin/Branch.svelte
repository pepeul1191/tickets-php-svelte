<script>
  import { onMount } from 'svelte';
  import DataTable from '../../Widgets/DataTable.svelte';
  import AlertMessage from '../../Widgets/AlertMessage.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  const base_url = BASE_URL;
  let branchDataTable;
  export let type_name;
  let projectCheckGroup;
  let baseURL = BASE_URL;
  let title = '';
  let alertMessage = null;
  let alertMessageProps = {};
  
  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    if(type_name == 'lima'){
      title = 'Lima'
    }else{
      title = 'Provincias'
    }
    branchDataTable.urlServices.list = `${baseURL}admin/branch/list?type_name=${type_name}`;
    branchDataTable.list();
    branchDataTable.extraData.type_name = type_name;
  });
</script>


<svelte:head>
  <title>Gestión de Sedes - {title}</title>
</svelte:head>


<div class="container">
	<div class="row">
		<svelte:component this={alertMessage} {...alertMessageProps} />
		<div class="col-lg-12 page-header">
			<h2>Lista de Sedes de {title}</h2>
		</div>
		<div class="col-md-12">
			<DataTable bind:this={branchDataTable} 
				urlServices={{ 
					list: `${base_url}admin/branch/list`, 
					save: `${base_url}admin/branch/save` 
				}}
				buttonAddRow={true},
				buttonSave={true},
        colspanFooter = 5,
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					name:{
						type: 'input[text]',
            style: 'width: 400px;',
					},
          address:{
						type: 'input[text]',
            style: 'width: 800px;',
					},
          phone:{
						type: 'input[text]',
            style: 'width: 150px;',
					},
          whatsapp:{
						type: 'input[text]',
            style: 'width: 150px;',
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
						caption: 'Dirección',
					},
          {
						caption: 'Teléfono',
					},
          {
						caption: 'WhastApp',
					},
					{
						caption: 'Operaciones',
						style:'text-align: center;',
					},]}
					messages={{
						notChanges: `No ha ejecutado cambios en la tabla de sedes de ${title}`,
						list404: `Rercuso no encontrado para listar los elmentos de la tabla de sedes de ${title}`,
						list500: `Ocurrió un error en listar los elementos de la tabla de sedes de ${title}`,
						save404: `Rercuso no encontrado para guardar los cambios de la tabla de sedes de ${title}`,
						save500: `Ocurrió un error para guardar los cambios de la table de sedes de ${title}`,
						save200: `Se han actualizado los registros de la tabla de sedes de ${title}`,
					}}
			/>
		</div>
	</div>
</div>

<style>
  .btn-actions{
    float:right;
    margin-top:15px;
  }
</style>