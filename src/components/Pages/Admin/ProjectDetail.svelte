<script>
  import { onMount } from 'svelte';
  import DataTable from '../../Widgets/DataTable.svelte';
  import UploadFile from '../../Widgets/UploadFile.svelte';
  import InputText from '../../Widgets/InputText.svelte';
  import InputDate from '../../Widgets/InputDate.svelte';
  import AlertMessage from '../../Widgets/AlertMessage.svelte';
  import InputCheckGroup from '../../Widgets/InputCheckGroup.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import { getProjectById, saveProjectDetail, saveProjectTypes } from '../../../services/project_service.js';
  export let id;
  export let disabled = false;
  export let disabledProjectType = false;
  let projectCheckGroup;
  let baseURL = BASE_URL;
  let staticURL = STATIC_URL;
  let imagesDataTable;
  let title = '';
  let alertMessage = null;
  let alertMessageProps = {};
  let imageURL = 'E';
  let imageUploadFile = '';
  let date = ''; let inputDate; let dateValid = false;
  let name = ''; let inputName; let nameValid = false;
  let description = ''; let inputDescription; let descriptionValid = false;
  
  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    // ajax
    if(id === undefined){
      console.log('if')
      title = 'Crear Proyecto';
      id = 'E';
      disabledProjectType = true;
    }else{
      console.log('else')
      title = 'Editar Proyecto';
      loadDetail(id);
      disabledProjectType = false;
    }
    projectCheckGroup.url = `${baseURL}admin/project/project-type?project_id=${id}`;
    projectCheckGroup.list();
    // image table
    imagesDataTable.urlServices.list = `${baseURL}admin/project/image/list?project_id=${id}`;
    imagesDataTable.list();
    imagesDataTable.extraData.project_id = id;
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

  const saveDetail = () => {
    // run validations
    inputDate.validate();
    inputName.validate();
    inputDescription.validate();
    // check image url
    if(imageURL == 'E'){
      imageURL = 'assets/img/default-project.png'
    }
    // check if true
    if(dateValid && nameValid && descriptionValid) {
      var params = {
        id: id,
        date: date,
        name: name,
        description: description,
        url: imageURL,
      };
      saveProjectDetail(params).then((resp) => {
        var data = resp.data;
        if(data != ''){
          id = data;
          title = 'Editar Usuario';
          launchAlert(null, 'Se ha creado un nuevo usuario', 'success');
          disabledProjectType = false;
          imagesDataTable.extraData.project_id = data;
        }else{
          launchAlert(null, 'Se ha editado un usuario', 'success');
        }
      }).catch((resp) =>  {
        if(resp.status == 404){
          launchAlert(null, 'Recurso guardar detalle de usuario no existe en el servidor', 'danger');
        }else if(resp.status == 501){ 
          launchAlert(null, resp.data, 'danger');
        }else { 
          launchAlert(null, 'Ocurrió un error en guardar los datos del usuario', 'danger');
        }
      })
    }
  };

  const loadDetail = (id) => {
    getProjectById(id).then((resp) => {
      var data = resp.data;
      date = data.date;
      name = data.name;
      description = data.description;
      imageURL = data.url;
    }).catch((resp) =>  {
      disabled = true;
      if(resp.status == 404){
        launchAlert(null, 'Proyecto a editar no existe', 'warning');
      }else{
        launchAlert(null, 'Ocurrió un error en obtener los datos del proyecto', 'danger');
      }
    })
  };

  const saveTypes = () => {
    if(id != 'E'){
      var params = {
        id: id,
        data: projectCheckGroup.data,
      };
      saveProjectTypes(params).then((resp) => {
        var data = resp.data;
        console.log(resp.data)
        if(data == ''){
          launchAlert(null, 'Se ha asociado el tipo(s) de evento', 'success');
        }
      }).catch((resp) =>  {
        if(resp.status == 404){
          launchAlert(null, 'Recurso asosiar los tipos no existe en el servidor', 'danger');
        }else if(resp.status == 501){ 
          launchAlert(null, resp.data, 'danger');
        }else { 
          launchAlert(null, 'Ocurrió un error en asosiar los tipos de eventos del evento', 'danger');
        }
      })
    }
  };
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<div class="container">
	<div class="row">
		<svelte:component this={alertMessage} {...alertMessageProps} />
		<div class="col-lg-12 page-header">
			<h2>{title}</h2>
		</div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <InputDate 
        label={'Fecha'}
        bind:value={date}
        placeholder={'Nombre del proyecto'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar una fecha del proyecto'},
        ]}
        bind:valid={dateValid} 
        bind:this={inputDate}
      />
    </div>
    <div class="col-md-7">
      <InputText 
        label={'Nombre'}
        bind:value={name}
        placeholder={'Nombre del proyecto'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar un nombre proyecto'},
          {type:'maxLength', length: 100, message: 'Nombre máximo 100 letras'},
        ]}
        bind:valid={nameValid} 
        bind:this={inputName}
      />
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <UploadFile bind:this={imageUploadFile} 
          label={'Imagen Principal'}
          fileName={'file'} 
          url={`${baseURL}upload`} 
          baseUrlFile={`${staticURL}`}  
          validationSize={
            {size: 2.6, message: 'Máximo 2 MB'}
          }
          validationExtension={
            {allowed: ['image/png', 'image/jpg', 'image/jpeg'], message: 'Sólo Imágenes'}
          }
          disabled={disabled}
          bind:urlFile={imageURL}
        />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <InputText 
        label={'Descripción'}
        bind:value={description}
        placeholder={'Descripción del proyecto'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar una descripción del proyecto'},
          {type:'maxLength', length: 200, message: 'Nombre máximo 200 letras'},
        ]}
        bind:valid={descriptionValid} 
        bind:this={inputDescription}
      />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 pull-right">
      <button class="btn btn-success btn-actions" disabled="{disabled}" on:click="{saveDetail}"><i class="fa fa-check" aria-hidden="true"></i>
        {title}</button>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-9">
      <InputCheckGroup bind:this={projectCheckGroup} 
        url={`${baseURL}admin/project/project-type`}
        key = {{ id: 'id', name: 'name', exist: 'exist' }}
        inline = {true}
        label = {'Seleccionar el Tipo(s) de Proyecto'}
        disabled = {disabledProjectType}
      />
    </div>
    <div class="col-md-3 pull-right">
      <button class="btn btn-primary btn-actions" style="margin-top: 35px;" disabled="{disabledProjectType}" on:click="{saveTypes}"><i class="fa fa-list" aria-hidden="true"></i>
        Asosiar Tipo de Proyecto</button>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <br>
      <h6>Galería de Imágenes</h6>
      <DataTable bind:this={imagesDataTable} 
				urlServices={{ 
					list: `${baseURL}admin/project/image/list`, 
					save: `${baseURL}admin/project/image/save` 
				}}
				buttonSave={true},
        buttonAddRow={true},
				rows={{
					id: {
						style: 'color: red; display:none;',
						type: 'id',
					},
					description:{
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
						caption: 'Descripción',
					},
          {
						caption: 'Imágenes del Proyecto',
            style: 'text-align: center',
					},
          {
						caption: 'Operaciones',
						style:'text-align: center;',
					},
				]}
				messages={{
					notChanges: 'No ha ejecutado cambios en la tabla de imágenes del proyecto',
					list404: 'Rercuso no encontrado para listar los elmentos de la tabla de imágenes del proyecto',
					list500: 'Ocurrió un error en listar los elementos de la tabla de imágenes del proyecto',
					save404: 'Rercuso no encontrado para guardar los cambios de la tabla de imágenes del proyecto',
					save500: 'Ocurrió un error para guardar los cambios de la table de imágenes del proyecto',
					save200: 'Se han actualizado los registros de la tabla de imágenes del proyecto',
				}}
        disabled={disabledProjectType}
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