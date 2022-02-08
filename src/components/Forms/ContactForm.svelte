<script>
  import { sendEmail } from '../../services/mail_service.js';
  let name = '';
  let phone = '';
  let email = '';
  let comment = '';
  let invalidName = '';
  let invalidPhone = '';
  let invalidEmail = '';
  let invalidCommnet = '';
  let message = '';
  let messageClass = '';
  let inputName;
  let disabled = false;

  const sendMessage = () => {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    (name == '') ? (invalidName = 'is-invalid') : (invalidName = '');
    (phone == '') ? (invalidPhone = 'is-invalid') : (invalidPhone = '');
    (comment == '') ? (invalidCommnet = 'is-invalid') : (invalidCommnet = '');
    (email == '') ? (invalidEmail = 'is-invalid') : (!regex.test(email)) ? (invalidEmail = 'is-invalid') : (invalidEmail = '');
    if(
      invalidName == '' && 
      invalidPhone == '' && 
      invalidEmail == '' && 
      invalidCommnet == ''
    ){
      message = '';
      messageClass = '';
      var params = {
        name: name,
        phone: phone,
        comment: comment,
        email: email,
      };
      disabled = true;
      messageClass = 'text-primary';
      message = 'Enviando mensaje ...';
      sendEmail(params).then((resp) => {
          console.log(resp);
          disabled = false;
          messageClass = 'text-success';
          message = 'Mensaje enviado';
          name = '';
          phone = '';
          comment = '';
          email = '';
          inputName.focus();
          setTimeout(() => {message = ''}, 5000);
        }).catch((resp => {
          console.log(resp);
          messageClass = 'text-danger';
          message = 'Ocurrió un error al mandar su mensaje';
          setTimeout(() => {message = ''}, 5000);
          disabled = false;
        })
      );
    }else{
      message = 'Debe de llenar todos los campos requeridos';
      (invalidEmail == 'is-invalid') ? (email != '') ? (message = 'Debe de ingresar un correo válido') : (null) :(null);
      messageClass = 'text-danger';
    }
  }
</script>

<form class="border rounded p-5">
  <h3 class="mb-4 text-center">Contáctenos</h3>
  <div class="contact-form">
    <label for="" class={messageClass}>{message}</label>
    <div class="form-group">
      <label class="control-label d-none" for="name">Nombre:</label>
      <div class="">          
      <input type="text" class="form-control {invalidName}" id="name" placeholder="Nombre" name="name" bind:value={name} disabled={disabled} bind:this={inputName}>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label d-none" for="phone">Teléfono:</label>
      <div class="">          
      <input type="text" class="form-control {invalidPhone}" id="phone" placeholder="Teléfono" name="phone" bind:value={phone} disabled={disabled}>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label d-none" for="email">Correo:</label>
      <div class="">
      <input type="email" class="form-control {invalidEmail}" id="email" placeholder="Correo Electrónico" name="email" bind:value={email} disabled={disabled}>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label d-none" for="comment">Comentario:</label>
      <div class="">
      <textarea class="form-control {invalidCommnet}" rows="5" id="comment" placeholder="Comentario" bind:value={comment} disabled={disabled}></textarea>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 ">
      <button type="submit" on:click|preventDefault={() => sendMessage()} class="btn btn-default"  disabled={disabled}>Enviar</button>
      </div>
    </div>
  </div>
</form>

<style>
  .form-control{
    border-radius: 0px;
    margin-bottom: 5px;
  }

  .btn-default{
    margin-top: 10px;
    background-color: var(--secondary-color);
    color: #FDFDFD;
    width: 100%;
    margin-bottom: 10px;
  }

  .btn-default:hover{
    background-color: var(--primary-color);
  }

  p{
    font-size: 13px;
  }

  .p-5{
    padding: 3rem 11rem 3rem 2.5rem !important;
  }

  h3, .contact-form{
    width: 150%;
  }
</style>