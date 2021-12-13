<script>

</script>

<form class="border rounded p-5">
  <h3 class="mb-4 text-center">Contáctenos</h3>
  <div class="contact-form">
    <div class="form-group">
      <label class="control-label d-none" for="fname">Nombre:</label>
      <div class="">          
      <input type="text" class="form-control" id="fname" placeholder="Nombre" name="fname">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label d-none" for="lname">Teléfono:</label>
      <div class="">          
      <input type="text" class="form-control" id="lname" placeholder="Teléfono" name="lname">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label d-none" for="email">Correo:</label>
      <div class="">
      <input type="email" class="form-control" id="email" placeholder="Correo Electrónico" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label d-none" for="comment">Comentario:</label>
      <div class="">
      <textarea class="form-control" rows="5" id="comment" placeholder="Comentario"></textarea>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 ">
      <button type="submit" class="btn btn-default">Enviar</button>
      </div>
    </div>
    <p>El sitio está siendo desarrollado por <a href="http://softweb.pe/"> Softtware Web Perú</a> © 2011-2021</p>
  </div>
</form>

<style>
  .form-control{
    border-radius: 0px;
    margin-bottom: 5px;
  }

  .btn-default{
    margin-top: 10px;
    background-color: var(--primary-color);
    color: #FDFDFD;
    width: 100%;
    margin-bottom: 10px;
  }

  .btn > i{
    margin-right: 5px;
  }

  .btn-default:hover{
    background-color: var(--secondary-color);
  }

  p{
    font-size: 13px;
  }
</style>