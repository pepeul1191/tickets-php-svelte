<script>
  import jQuery from 'jquery';
  const base_url = BASE_URL;
  const static_url = STATIC_URL;
  const enterpriseName = "Antergo";
  let navScroll = "XD";
  
  jQuery(window).scroll(function(event){
    var pathname = window.location.pathname; 
    if(true/*pathname == '/'*/){
      var sc = jQuery(window).scrollTop();
      // console.log(sc);
      if(sc >= 180){
        navScroll = "nav-scroll";
      }else{
        navScroll = "";
      }
    }
  });

  const togglerMenu = () => {
    const navLinks = document.querySelectorAll('.nav-item')
    console.log(navLinks)
    const menuToggle = document.getElementById('navbarSupportedContent')
    const bsCollapse = new bootstrap.Collapse(menuToggle)
    navLinks.forEach((l) => {
      l.addEventListener('click', () => { console.log('XD');bsCollapse.toggle() })
    })
    const btnToggle = document.getElementById('btnToggle')
    btnToggle.addEventListener('click', () => { console.log('XD');bsCollapse.toggle() })
  };
</script>
<nav class="navbar navbar-expand-lg navigation-wrap {navScroll}">
  <div class="container">
    <a class="navbar-brand" href="{base_url}">
      <img src="{static_url}assets/img/mail-logo.png" alt="{enterpriseName}" height="60">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" id="btnToggle" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" on:click={togglerMenu}>
      <span class="navbar-toggler-icon">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#aboutUs" on:click|preventDefault={() => {}}>Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#projects" on:click|preventDefault={() => {}}>Proyectos</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="/contacto">Contacto</a>
        </li>
        <li>
          <button class="btn-main">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
            +51 901 268 633
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  .btn-main{
    display: inline-block;
    padding: 0.625rem 1.875rem;
    line-height: 1.5625rem;
    background-color: var(--primary-color);
    border: 0.1875rem solid var(--primary-color);
    color: var(--black-color);
    font-size: 0.9375rem;
    font-weight: 600;
    text-transform: capitalize;
    border-radius: 0.5rem;
    box-shadow: 0px 2px 10px -1px rbg(0 0 0 / 19%);
    -webkit-transition: all .4s ease-out 0s;
    -o-transition: all .4s ease-out 0s;
    -moz-transition: all .4s ease-out 0s;
    transition: all .4s ease-out 0s;
    border-radius: 0px;
  }

  .nav-scroll{
    background: white;
  }

  .btn-main:hover{
    background-color: transparent;
    color:var(--primary-color);
  }

  .wrapper{
    padding-top: 4.25rem;
    padding-bottom: 4.25rem;
  }

  .text-content{
    width: 70%;
    margin:auto;
  }

  .navigation-wrap{
    position: fixed;
    width: 100%;
    left:0;
    z-index: 1000;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
  }

  .navigation-wrap .nav-item{
    padding: 0 0.625rem;
  }

  .navbar-toggler:focus{
    outline: unset;
    border:unset;
    box-shadow: none;
  }

  .nav-link{
    font-size: 0.9375rem;
    font-weight: 600;
    text-transform: capitalize;
    color:var(--black-color) !important;
  }

  .nav-link:hover,
  .nav-link.active{
    color:var(--primary-color) !important;
  }

  .navigation-wrap .btn-main{
    padding: 0.3125rem 1.4375rem;
    box-shadow: none;
    margin-left:0.625rem;
  }

  .navigation-wrap.scroll-on{
    position:fixed;
    background-color: var(--primary-color); 
    top:0;
    left:0;
    width:100%;
    box-shadow: 0 0.125rem 1.75rem 0 rgb(0,0,0,0.09);
    transition: all 0.15s ease-in-out 0s;
  }

  .navigation-wrap.scroll-on .nav-link{
    color:var(--black-color);
  }

  .navigation-wrap.scroll-on .nav-link:hover,
  .navigation-wrap.scroll-on .nav-link:active{
    color:var(--primary-color);
  }

  .navbar-toggler-icon{
    font-size: 1.5rem;
    height: 1.25em;
  }

  @media(max-width: 991px){
    .text-content{
      width: 100%;

    }

    .navigation-wrap .navbar-brand img {
      height: 3.8125rem;
    }

    .navigation-wrap{
      text-align: center;
      background-color: var(--white-color);
    }
  }

  @media(max-width: 767px){
    h1{
      font-size: 2.8rem;
    }

    h2{
      font-size: 1.3rem;
      line-height: 28px;
    }
  }
</style>