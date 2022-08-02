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
  let branchTypeId; let inputBranchType; let branchTypeIdValid = false;
  let branchId; let inputBranch; let branchIdValid = false;

  onMount(() => {    
    alertMessageStore.subscribe(value => {
      if(value != null){
        alertMessage = value.component;
        alertMessageProps = value.props;
      }
    });
    var idLength = 10;
    // ajax
    if(id === 'E'){
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
  });
  
  const getUserInfo = () => {
		getUser().then((resp) => {
      workerName = `${resp.data.last_names}, ${resp.data.names}`
			//(resp.data.names != null) ? user.name = resp.data.names : showUser = false;
			//(resp.data.img != null) ? user.img = resp.data.img : user.img = `${staticURL}assets/img/default-user.png`;
			//(resp.data.user != null) ? user.user = resp.data.user : user.user = null;
		}).catch((resp) =>  {
			showUser = false;
		});
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
      <h6>Detalles de la Incidencias de Servicios</h6>			
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
        <InputText 
          label={'Prioridad'}
          bind:value={id}
          placeholder={'Prioridad'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[
            {type:'notEmpty', message: 'Debe de ingresar un nombre proyecto'},
            {type:'maxLength', length: 100, message: 'Nombre máximo 100 letras'},
          ]}
        />
      </div>
      <div class="col-md-2">
        <InputText 
          label={'Estado'}
          bind:value={id}
          placeholder={'Estado'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
      <div class="col-md-6">
        <InputText 
          label={'Resumen'}
          bind:value={id}
          placeholder={'Resumen'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
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
  </div>
</div>

<style>

</style>