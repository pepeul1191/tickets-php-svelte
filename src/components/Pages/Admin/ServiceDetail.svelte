<script>
  import { onMount } from 'svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import { getUser } from '../../../services/user_service.js';
  import InputText from '../../Widgets/InputText.svelte';
  import InputSelect from '../../Widgets/InputSelect.svelte';
  import Worker from './Worker.svelte';
  let alertMessage = null;
  let alertMessageProps = {};
  let baseURL = BASE_URL;
  export let workerName = '';
  export let disabled = false;
  export let disabledBranch = true;
  let title = '';
  // service header data
  export let id; let idDisplayed = '';
  export let created = '-'; 
  export let edited = '-'; 
  let workerId = '';
  let description = '';
  let resume = ''; let inputResume; let resumeValid = false;
  let branchTypeId; let inputBranchType; let branchTypeIdValid = false;
  let branchId; let inputBranch; let branchIdValid = false;
  let stateId; let inputState; let stateIdValid = false;
  let priorityId; let inputPriority; let priorityIdValid = false;
  let ticketTypeId; let inputTicketType; let ticketTypeIdValid = false;

  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    var idLength = 10;
    // ajax
    if(id == 'E'){
      console.log('if')
      title = 'Crear Servicio';
      id = 'E';
      idDisplayed = '-'
      disabledProjectType = true;
    }else{
      console.log('else')
      title = 'Editar Servicio';
      loadDetail(id);
      disabledProjectType = false;
    }
    if(id != 'E'){
      while(id.length != idLength){
        id = '0' + id;
      }
    }
    // load worker data
    getUserInfo();
    inputBranchType.list();
    inputPriority.list();
    inputState.list();
  });
  
  const getUserInfo = () => {
		getUser().then((resp) => {
      workerName = `${resp.data.last_names}, ${resp.data.names}`;
      workerId = resp.data.worker_id;
			//(resp.data.names != null) ? user.name = resp.data.names : showUser = false;
			//(resp.data.img != null) ? user.img = resp.data.img : user.img = `${staticURL}assets/img/default-user.png`;
			//(resp.data.user != null) ? user.user = resp.data.user : user.user = null;
		}).catch((resp) =>  {
			showUser = false;
		});
	};

  const saveHeader = () => {
    // run validations
    /*
    inputDate.validate();
    inputName.validate();
    inputDescription.validate();
    */
    // check if true
    //if(dateValid && nameValid && descriptionValid) {
    if(true){
      var params = {
        id: id,
        names: names,
        last_names: lastNames,
        phone: phone,
        email: email,
        position_id: positionId,
      };
      console.log(params);
      /*
      saveWorkerDetail(params).then((resp) => {
        var data = resp.data;
        if(data != ''){
          id = data;
          title = 'Editar Trabajador';
          launchAlert(null, 'Se ha creado un nuevo trabajador', 'success');
          disabledProjectType = false;
        }else{
          launchAlert(null, 'Se ha editado un trabajador', 'success');
        }
      }).catch((resp) =>  {
        if(resp.status == 404){
          launchAlert(null, 'Recurso guardar detalle de trabajador no existe en el servidor', 'danger');
        }else if(resp.status == 501){ 
          launchAlert(null, resp.data, 'danger');
        }else { 
          launchAlert(null, 'Ocurrió un error en guardar los datos del trabajador', 'danger');
        }
      })*/
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
      <h6>Detalles del Ticket</h6>			
    </div>
    <div class="row">
      <div class="col-md-2">
        <InputText 
          label={'Número de Ticket'}
          bind:value={idDisplayed}
          placeholder={'Nombre del proyecto'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[
            {type:'notEmpty', message: 'Debe de ingresar un nombre proyecto'},
            {type:'maxLength', length: 100, message: 'Nombre máximo 100 letras'},
          ]}
        />
      </div>
      <div class="col-md-3">
        <InputText 
          label={'Informante'}
          bind:value={workerName}
          placeholder={'Informante'} 
          disabled={true}
          style={''}
          validations={[ ]}
        />
      </div>
      <div class="col-md-2">
        <InputSelect 
          label={'Tipo de Sede'}
          placeholder={'Tipo de Sede'} 
          disabled={disabled}
          url={`${baseURL}admin/branch_type/list`}
          validations={[
            {type:'notEmpty', message: 'Debe seleccionar el tipo de sede'},
          ]}
          key = {{ id: 'id', name: 'name'}}
          customFunctionOnChange={() => {
            var typeName = 'province';
            if(branchTypeId == 1){
              typeName = 'lima'
            }
            inputBranch.data = [];
            inputBranch.url = `${baseURL}admin/branch/list?type_name=${typeName}`;
            inputBranch.list();
            disabledBranch = false;
          }}
          bind:selectedValue={branchTypeId}
          bind:valid={branchTypeIdValid} 
          bind:this={inputBranchType}
        />
      </div>
      <div class="col-md-3">
        <InputSelect 
          label={'Sede'}
          placeholder={'Sede'} 
          disabled={disabledBranch}
          url={''}
          validations={[
            {type:'notEmpty', message: 'Debe seleccionar la sede'},
          ]}
          key = {{ id: 'id', name: 'name'}}
          bind:selectedValue={branchId}
          bind:valid={branchIdValid} 
          bind:this={inputBranch}
        />
      </div>
      <div class="col-md-2">
        <InputText 
          label={'Fecha de Creación'}
          bind:value={created}
          placeholder={'Fecha de Creación'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="col-md-2">
        <InputSelect 
          label={'Prioridad'}
          placeholder={'Prioridad'} 
          disabled={disabled}
          url={`${baseURL}admin/priority/list`}
          validations={[
            {type:'notEmpty', message: 'Debe seleccionar la prioridad'},
          ]}
          key = {{ id: 'id', name: 'name'}}
          bind:selectedValue={priorityId}
          bind:valid={priorityIdValid} 
          bind:this={inputPriority}
        />
      </div>
      <div class="col-md-2">
        <InputSelect 
          label={'Estado'}
          placeholder={'Estado'} 
          disabled={disabled}
          url={`${baseURL}admin/state/list`}
          validations={[
            {type:'notEmpty', message: 'Debe seleccionar el estado'},
          ]}
          key = {{ id: 'id', name: 'name'}}
          bind:selectedValue={stateId}
          bind:valid={stateIdValid} 
          bind:this={inputState}
        />
      </div>
      <div class="col-md-6">
        <InputText 
        label={'Resumen del servicio (máxmo 75 letras)'}
        bind:value={resume}
        placeholder={'Resumen'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar un nombre proyecto'},
          {type:'maxLength', length: 75, message: 'Nombre máximo 100 letras'},
        ]}
        bind:valid={resumeValid} 
        bind:this={inputResume}
      />
      </div>
      <div class="col-md-2">
        <InputText 
          label={'Última Edición'}
          bind:value={edited}
          placeholder={'Última Edición'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 pull-right">
        <button class="btn btn-success btn-actions" disabled="{disabled}" on:click="{saveHeader}"><i class="fa fa-check" aria-hidden="true"></i>
          {title}</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6"> 
      <h6>Imágnes Adjuntas</h6>			
    </div>
  </div>
</div>

<style>
.btn-actions{
    float:right;
    margin-top:15px;
    margin-left: 10px;
  }
</style>