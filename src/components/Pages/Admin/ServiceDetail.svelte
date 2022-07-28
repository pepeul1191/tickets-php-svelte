<script>
  import { onMount } from 'svelte';
  import { alertMessage as alertMessageStore} from '../../Stores/alertMessage.js';
  import InputText from '../../Widgets/InputText.svelte';
  let alertMessage = null;
  let alertMessageProps = {};
  const base_url = BASE_URL;
  export let id;
  let title = '';

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
    <div class="col-md-6">
      <br>
      <h6>Detalles de la Incidencias de Servicios</h6>			
    </div>
    <div class="row">
      <div class="col-md-2">
        <InputText 
          label={'Número de Ticket'}
          bind:value={id}
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
          bind:value={id}
          placeholder={'Informante'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
      <div class="col-md-2">
        <InputText 
          label={'Tipo de Sede'}
          bind:value={id}
          placeholder={'Tipo de Sede'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
      <div class="col-md-3">
        <InputText 
          label={'Sede'}
          bind:value={id}
          placeholder={'Sede'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
      <div class="col-md-2">
        <InputText 
          label={'Fecha de Creación'}
          bind:value={id}
          placeholder={'Fecha de Creación'} 
          disabled={true}
          style={'text-align:center;'}
          validations={[ ]}
        />
      </div>
    </div>
    <div class="row">
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
          bind:value={id}
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