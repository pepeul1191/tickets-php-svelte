<script>
  import { onMount } from 'svelte';
  import DataTable from '../../Widgets/DataTable.svelte';
  import UploadFile from '../../Widgets/UploadFile.svelte';
  import InputText from '../../Widgets/InputText.svelte';
  import InputSelect from '../../Widgets/InputSelect.svelte';
  import InputDate from '../../Widgets/InputDate.svelte';
  import AlertMessage from '../../Widgets/AlertMessage.svelte';
  import InputCheckGroup from '../../Widgets/InputCheckGroup.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import { getWorkerById, saveWorkerDetail, saveWorkerBranch } from '../../../services/worker_service.js';
  export let id;
  export let disabled = false;
  export let disabledProjectType = false;

  export let disabledLimaBranch = false;
  export let disabledProvinceBranch = false;
  let projectCheckGroup;
  let baseURL = BASE_URL;
  let staticURL = STATIC_URL;
  let imagesDataTable;
  let title = '';
  let alertMessage = null;
  let alertMessageProps = {};
  let imageURL = 'E';
  let imageUploadFile = '';
  let positionId;
  let names = ''; let inputNames; let namesValid = false;
  let lastNames = ''; let inputLastNames; let lastNamesValid = false;
  let email = ''; let inputEmail; let emailValid = false;
  let phone = ''; let inputPhone; let phoneValid = false;
  let position = ''; let inputPosition; let positionValid = false;
  let branchLimaCheckGroup;
  let branchProvinceCheckGroup;
  
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
      title = 'Crear Trabajador';
      id = 'E';
      disabledProjectType = true;
    }else{
      console.log('else')
      title = 'Editar Trabajador';
      loadDetail(id);
      disabledProjectType = false;
    }
    branchLimaCheckGroup.url = `${baseURL}admin/worker/branch?worker_id=${id}&branch_type_id=1`;
    branchLimaCheckGroup.list();
    branchProvinceCheckGroup.url = `${baseURL}admin/worker/branch?worker_id=${id}&branch_type_id=2`;
    branchProvinceCheckGroup.list();
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
    getWorkerById(id).then((resp) => {
      var data = resp.data;
      names = data.names;
      lastNames = data.last_names;
      phone = data.phone;
      email = data.email;
      positionId = data.position_id;
    }).catch((resp) =>  {
      disabled = true;
      if(resp.status == 404){
        launchAlert(null, 'Trabajador a editar no existe', 'warning');
      }else{
        launchAlert(null, 'Ocurrió un error en obtener los datos del trabajador', 'danger');
      }
    })
  };

  const saveBranches = (dataChanged) => {
    if(id != 'E'){
      var params = {
        id: id,
        data: dataChanged,
      };
      saveWorkerBranch(params).then((resp) => {
        var data = resp.data;
        console.log(resp.data)
        if(data == ''){
          launchAlert(null, 'Se ha asociado el sedes al trabajador', 'success');
        }
      }).catch((resp) =>  {
        if(resp.status == 404){
          launchAlert(null, 'Recurso asosiar los trabajores a sedes no existe en el servidor', 'danger');
        }else if(resp.status == 501){ 
          launchAlert(null, resp.data, 'danger');
        }else { 
          launchAlert(null, 'Ocurrió un error en asosiar las sedes a los trabajadores', 'danger');
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
			<h2>{title} - Datos Generales</h2>
		</div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <InputText 
        label={'Apellidos'}
        bind:value={lastNames}
        placeholder={'Apellidos del trabajador'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar los appelidos del trabajador'},
          {type:'maxLength', length: 45, message: 'Nombre máximo 45 letras'},
        ]}
        bind:valid={lastNamesValid} 
        bind:this={inputLastNames}
      />
    </div>
    <div class="col-md-3">
      <InputText 
        label={'Nombres'}
        bind:value={names}
        placeholder={'Nombres del trabajador'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar los nombres del trabajador'},
          {type:'maxLength', length: 45, message: 'Nombre máximo 45 letras'},
        ]}
        bind:valid={namesValid} 
        bind:this={inputNames}
      />
    </div>
    <div class="col-md-2">
      <InputText 
        label={'Teléfono'}
        bind:value={phone}
        placeholder={'Teléfono del trabajador'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar el teléfono del trabajador'},
          {type:'maxLength', length: 25, message: 'Nombre máximo 25 letras'},
        ]}
        bind:valid={phoneValid} 
        bind:this={inputPhone}
      />
    </div>
    <div class="col-md-2">
      <InputText 
        label={'Correo'}
        bind:value={email}
        placeholder={'Correo del trabajador'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar el correo del trabajador'},
          {type:'email'},
        ]}
        bind:valid={emailValid} 
        bind:this={inputEmail}
      />
    </div>
    <div class="col-md-2">
      <InputSelect 
        label={'Puesto de Trabajo'}
        bind:value={position}
        placeholder={'Nombre del trabajador'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar una fecha del trabajador'},
        ]}
        bind:valid={positionValid} 
        bind:this={inputPosition}
      />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 pull-right">
      <button class="btn btn-success btn-actions" disabled="{disabled}" on:click="{saveDetail}"><i class="fa fa-check" aria-hidden="true"></i>
        {title}</button>
    </div>
  </div>
  <div class="row">
		<div class="col-lg-12 page-header">
			<br><h2>Sedes Dónde Labora</h2>
		</div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <InputCheckGroup bind:this={branchLimaCheckGroup} 
        url={`${baseURL}admin/branch/list?type_name=lima`}
        key = {{ id: 'id', name: 'name', exist: 'exist' }}
        inline = {true}
        label = {'Sedes de Lima'}
        disabled = {disabledLimaBranch}
        columnSize = {3}
      />
    </div>
    <div class="col-md-12 pull-right">
      <button class="btn btn-primary btn-actions" style="" disabled="{disabledLimaBranch}" on:click="{saveBranches(branchLimaCheckGroup.getChanges())}"><i class="fa fa-list" aria-hidden="true"></i>
        Asosiar Sedes de Lima</button>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <InputCheckGroup bind:this={branchProvinceCheckGroup} 
        url={`${baseURL}admin/branch/list?type_name=province`}
        key = {{ id: 'id', name: 'name', exist: 'exist' }}
        inline = {true}
        label = {'Sedes de Provincia'}
        columnSize = {3}
        disabled = {disabledProvinceBranch}
      />
    </div>
    <div class="col-md-12 pull-right">
      <button class="btn btn-primary btn-actions" style="" disabled="{disabledProvinceBranch}" on:click="{saveBranches(branchProvinceCheckGroup.getChanges())}"><i class="fa fa-list" aria-hidden="true"></i>
        Asosiar Sedes de Provincias</button>
    </div>
  </div>
  <hr>

  <hr>
</div>

<style>
  .btn-actions{
    float:right;
    margin-top:15px;
  }
</style>