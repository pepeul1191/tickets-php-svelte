<script>
  import { onMount } from 'svelte';
	import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import DataTable from '../../Widgets/DataTable.svelte';
  import InputText from '../../Widgets/InputText.svelte';
  const base_url = BASE_URL;
  let alertMessage = null;
  let alertMessageProps = {};
  let projectDataTable;
  let inputName = '';

  onMount(() => {
    // console.log('index');
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    projectDataTable.list();
  });

  const search = () => {
    // run validations
    projectDataTable.queryParams = {
      name: inputName,
    };
    projectDataTable.list();
  }
  
  const clean = () => {
    inputName = '';
    projectDataTable.queryParams = {
      name: inputName,
    };
    projectDataTable.list();
  };
</script>

<svelte:head>
	<title>Gestión de Proyectos</title>
</svelte:head>

<div class="container">
	<div class="row">
		<svelte:component this={alertMessage} {...alertMessageProps} />
		<div class="col-lg-12 page-header">
			<h2>Gestión de Proyectos</h2>
		</div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <InputText 
        label={'Nombre'}
        bind:value={inputName}
        placeholder={'Ingrese nombre de proyecto'} 
      />
    </div> 
    <div class="col-md-3" style="padding-top:27px;">
      <button class="btn btn-warning" on:click="{clean}"><i class="fa fa-eraser" aria-hidden="true"></i>
        Limpiar</button>
      <button class="btn btn-success" on:click="{search}"><i class="fa fa-search" aria-hidden="true"></i>
        Buscar Proyectos</button>
    </div>
  </div>
  <div class="row">
		<div class="col-md-12">
      <br>
			<DataTable bind:this={projectDataTable} 
				urlServices={{ 
					list: `${base_url}admin/project/list`, 
					save: `${base_url}admin/project/delete` 
				}}
				buttonSave={true}
				buttonAddRecord={'/admin/project/add'}
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					date:{
						type: 'td',
					},
          name:{
						type: 'td',
					},
					actions:{
						type: 'actions',
						buttons: [
              {
								type: 'link', 
								icon: 'fa fa-pencil', 
								style:'font-size:12px; margin-right:10px;',
								url: '/admin/project/edit/',
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
						caption: 'Fecha',
					},
					{
						caption: 'Nombre',
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