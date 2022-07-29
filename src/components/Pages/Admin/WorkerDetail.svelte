<script>
  import { onMount } from 'svelte';
  import InputText from '../../Widgets/InputText.svelte';
  import InputPassword from '../../Widgets/InputPassword.svelte';
  import InputSelect from '../../Widgets/InputSelect.svelte';
  import AlertMessage from '../../Widgets/AlertMessage.svelte';
  import InputCheckGroup from '../../Widgets/InputCheckGroup.svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import { getWorkerById, saveWorkerDetail, saveWorkerBranch } from '../../../services/worker_service.js';
  import { getUserWorkerById, updateUserPassword } from '../../../services/user_service.js';
  export let id;
  export let disabled = false;
  export let disabledProjectType = false;
  export let disabledLimaBranch = false;
  export let disabledProvinceBranch = false;
  let baseURL = BASE_URL;
  let title = '';
  let alertMessage = null;
  let alertMessageProps = {};
  // worker data
  let positionId;
  let names = ''; let inputNames; let namesValid = false;
  let lastNames = ''; let inputLastNames; let lastNamesValid = false;
  let email = ''; let inputEmail; let emailValid = false;
  let phone = ''; let inputPhone; let phoneValid = false;
  let position = ''; let inputPosition; let positionValid = false;
  // user-worker data
  let userId = 'E';
  let password = ''; let passwordOriginal = ''; let inputPassword = ''; let passwordValid = false;
  let user = ''; let inputUser = ''; let userValid = false;
  let messageRandomPassword = '';
  let lastLogin = '';
  // branch-worker data
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
      // console.log('if')
      title = 'Crear Trabajador';
      id = 'E';
      disabledProjectType = true;
    }else{
      // console.log('else')
      title = 'Editar Trabajador';
      loadDetail(id);
      disabledProjectType = false;
    }
    // postion select
    inputPosition.list();
    // load user
    loadUser(id);
    // branches of worker
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

  const loadUser = (id) => {
    getUserWorkerById(id).then((resp) => {
      var data = resp.data;
      user = data.user;
      password = '1111111111';
      userId = data.id;
    }).catch((resp) =>  {
      if(resp.status == 404){
        launchAlert(null, 'El trabajador aún no tiene un usuario asignado', 'warning');
      }else{
        launchAlert(null, 'Ocurrió un error en obtener los datos del usuario del trabajador', 'danger');
      }
    })
  };

  const saveWokerUser = () => {
    // run validations
    inputUser.validate();
    inputPassword.validate();
    // check if true
    if(passwordValid && userValid) {
      var params = {
        worker_id: id,
        id: userId,
        user: user,
        password: password,
        email: email,
      };
      updateUserPassword(params).then((resp) => {
        var data = resp.data;
        if(data == ''){
          // edited
          launchAlert(null, 'Se ha editado el usuario del trabajador', 'success');
        }else{
          // created
          userId = data;
          launchAlert(null, 'Se ha creado el usuario del trabajador', 'success');
        }
      }).catch((resp) =>  {
        if(resp.status == 404){
          launchAlert(null, 'Recurso asosiar actualizar el usuario del trabajador no existe en el servidor', 'danger');
        }else if(resp.status == 501){ 
          launchAlert(null, resp.data, 'danger');
        }else { 
          launchAlert(null, 'Ocurrió un error en asosiar el usuario del trabajador', 'danger');
        }
      })
    }
  };

  const sendResetMail = () => {
    alert('TODO: Enviar correo con reseteo de contraseña')
  };

  const saveBranches = (branch) => {
    var dataChanged = branch.getChanges();
    if(id != 'E'){
      var params = {
        id: id,
        data: dataChanged,
      };
      saveWorkerBranch(params).then((resp) => {
        var data = resp.data;
        branch.originData = JSON.parse(JSON.stringify(branch.data));
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

  const generatePassword = () => {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%()=¡[]*|@';
    var charactersLength = characters.length;
    for ( var i = 0; i < 10; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    messageRandomPassword = `Contraseña generada: <b style="color: #343434;font-weight: 900;">${result}</b>`;
    password = result;
    setTimeout(() => {messageRandomPassword = ''}, 5000);
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
        url={`${baseURL}admin/position/list`}
        validations={[
          {type:'notEmpty', message: 'Debe seleccionar el puesto de trabajo'},
        ]}
        key = {{ id: 'id', name: 'name'}}
        bind:selectedValue={positionId}
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
			<h2>Datos de Usuario</h2>
		</div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <InputText 
        label={'Usuario'}
        bind:value={user}
        placeholder={'Usuario de trabajador'} 
        disabled={disabled}
        validations={[
          {type:'notEmpty', message: 'Debe de ingresar un nombre usuario'},
          {type:'maxLength', length: 45, message: 'Nombre máximo 45 letras'},
        ]}
        bind:valid={userValid} 
        bind:this={inputUser}
      />
    </div>
    <div class="col-md-3">
      <InputPassword 
        label={'Contraseña'}
        bind:value={password}
        placeholder={'Contraseña del usuario'} 
        disabled={true}
        validations={[{type:'notEmpty', message: 'Debe de Generar una Contraseña'},]}
        bind:this={inputPassword}
        bind:valid={passwordValid} 
      />
    </div>
    <div class="col-md-3">
      <InputText 
        label={'Último Acceso'}
        bind:value={lastLogin}
        placeholder={'Último acceso al sistema'} 
        disabled={true}
        validations={[]}
        valid={true} 
      />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 pull-right">
      <button class="btn btn-success btn-actions" disabled="{disabled}" on:click="{saveWokerUser}"><i class="fa fa-check" aria-hidden="true"></i>
        Actualizar Datos de Usuario</button>
      <button class="btn btn-primary btn-actions" disabled="{disabled}" on:click="{sendResetMail}"><i class="fa fa-envelope-o" aria-hidden="true"></i>
        Enviar Correo de Cambio de Contraseña</button>
      <button class="btn btn-secondary btn-actions" disabled="{disabled}" on:click="{generatePassword}"><i class="fa fa-random" aria-hidden="true"></i>
        Generar Contraseña</button>
      <label class="btn-actions" style="margin-top: 20px;">{@html messageRandomPassword}</label>
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
      <button class="btn btn-success btn-actions" style="" disabled="{disabledLimaBranch}" on:click="{saveBranches(branchLimaCheckGroup)}"><i class="fa fa-list" aria-hidden="true"></i>
        Asosiar Sedes de Lima</button>
      <button class="btn btn-secondary btn-actions" style="" disabled="{disabledLimaBranch}" on:click="{branchLimaCheckGroup.unselectAll()}"><i class="fa fa-square-o" aria-hidden="true"></i>
          Deseleccionar Todos</button>
      <button class="btn btn-secondary btn-actions" style="" disabled="{disabledLimaBranch}" on:click="{branchLimaCheckGroup.selectAll()}"><i class="fa fa-check-square-o" aria-hidden="true"></i>
            Seleccionar Todos</button>
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
      <button class="btn btn-success btn-actions" style="" disabled="{disabledProvinceBranch}" on:click="{saveBranches(branchProvinceCheckGroup)}"><i class="fa fa-list" aria-hidden="true"></i>
        Asosiar Sedes de Provincias</button>
      <button class="btn btn-secondary btn-actions" style="" disabled="{disabledLimaBranch}" on:click="{branchProvinceCheckGroup.unselectAll()}"><i class="fa fa-square-o" aria-hidden="true"></i>
          Deseleccionar Todos</button>
      <button class="btn btn-secondary btn-actions" style="" disabled="{disabledLimaBranch}" on:click="{branchProvinceCheckGroup.selectAll()}"><i class="fa fa-check-square-o" aria-hidden="true"></i>
        Seleccionar Todos</button>
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