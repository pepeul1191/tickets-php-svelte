<script>
  import { onMount } from 'svelte';
	import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import DataTable from '../../Widgets/DataTable.svelte';
  import InputText from '../../Widgets/InputText.svelte';
  const base_url = BASE_URL;
  let alertMessage = null;
  let alertMessageProps = {};
  let workerDataTable;
  let inputName = '';
  let inputEmail = '';

  onMount(() => {
    // console.log('index');
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    workerDataTable.list();
  });

  const search = () => {
    // run validations
    workerDataTable.queryParams = {
      name: inputName,
      email: inputEmail,
    };
    workerDataTable.list();
  }
  
  const clean = () => {
    inputName = '';
    workerDataTable.queryParams = {
      name: inputName,
      email: inputEmail,
    };
    workerDataTable.list();
  };
</script>

<svelte:head>
	<title>Gestión de Trabajadores</title>
</svelte:head>

<div class="container">
	<div class="row">
		<svelte:component this={alertMessage} {...alertMessageProps} />
		<div class="col-lg-12 page-header">
			<h2>Gestión de Trabajadores</h2>
		</div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <InputText 
        label={'Nombre'}
        bind:value={inputName}
        placeholder={'Ingrese el nombre de Trabajador'} 
      />
    </div> 
    <div class="col-md-3">
      <InputText 
        label={'Correo'}
        bind:value={inputEmail}
        placeholder={'Ingrese el correo de Trabajador'} 
      />
    </div> 
    <div class="col-md-3" style="padding-top:27px;">
      <button class="btn btn-warning" on:click="{clean}"><i class="fa fa-eraser" aria-hidden="true"></i>
        Limpiar</button>
      <button class="btn btn-success" on:click="{search}"><i class="fa fa-search" aria-hidden="true"></i>
        Buscar Trabajadores</button>
    </div>
  </div>
  <div class="row">
		<div class="col-md-12">
      <br>
			<DataTable bind:this={workerDataTable} 
				urlServices={{ 
					list: `${base_url}admin/worker/list`, 
					save: `${base_url}admin/worker/delete` 
				}}
				buttonSave={true}
				buttonAddRecord={'/worker/add'}
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					last_names:{
						type: 'td',
					},
          names:{
						type: 'td',
					},
          email:{
						type: 'td',
					},
          phone:{
						type: 'td',
					},
					actions:{
						type: 'actions',
						buttons: [
              {
								type: 'link', 
								icon: 'fa fa-pencil', 
								style:'font-size:12px; margin-right:10px;',
								url: '/worker/edit/',
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
						caption: 'Apellidos',
					},
					{
						caption: 'Nombres',
					},
          {
						caption: 'Correo',
					},
          {
						caption: 'Teléfono',
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
          step: 15,
        }}
			/>
		</div>
  </div>
</div>

<style>

</style>