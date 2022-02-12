<script>
  import { onMount } from 'svelte';
  import UploadFile from '../../Widgets/UploadFile.svelte';
  import InputText from '../../Widgets/InputText.svelte';
  import InputDate from '../../Widgets/InputDate.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import { getProjectById, saveProjectDetail } from '../../../services/project_service.js';
  export let id;
  export let disabled = false;
  let baseURL = BASE_URL;
  let staticURL = STATIC_URL;
  let disabledInCreate = true;
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
      disabledInCreate = true;
    }else{
      console.log('else')
      title = 'Editar Proyecto';
      loadDetail(id);
      disabledInCreate = false;
    }
  });

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
          disabledInCreate = false;
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
</div>

<style>
  .btn-actions{
    float:right;
    margin-top:15px;
  }
</style>