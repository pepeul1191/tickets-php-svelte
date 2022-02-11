<script>
	import 'bootstrap/dist/css/bootstrap.min.css';
	import 'font-awesome/css/font-awesome.min.css';
	import '../../stylesheets/admin.css';
  import { Modal } from 'bootstrap';
	import { onMount } from 'svelte';
	import { Router, Route } from 'svelte-routing';
  import Index from '../Pages/Admin/Index.svelte';
  import ProjectType from '../Pages/Admin/ProjectType.svelte';
	import Redirect404 from '../Pages/Error/Redirect404.svelte';
  import Footer from './../Widgets/Footer.svelte';
  import Navigation from './../Widgets/Navigation.svelte';
  import { modal } from '../Stores/modal.js';
  export let url = '';
  export let basepath = '/admin';
  let modalComponent;
  let modalDOMStore;

  onMount(() => {
    console.log('home');
    modal.subscribe(value => {
      modalComponent = value;
    });
    modalDOMStore = new Modal(document.getElementById('modal'));
    document.getElementById('modal').addEventListener('hidden.bs.modal', function (event) {
      alert('=P');
    })
  });

  const modalOpen = () => {
    //myModal.toggle()
    modalComponent = Foo;
    // modalDOMStore.show();
    showModal(null);
  };

  function showModal(event) {
    if(typeof(event) !== "undefined" && event !== null){
      console.log(event.detail.param1);
    }
		modalDOMStore.show();
	}

</script>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <svelte:component this={modalComponent} />
    </div>
  </div>
</div>

<button class="btn btn-info d-none" on:click="{modalOpen}">Modal FOO</button>

<Navigation />

<Router url="{url}" basepath="{basepath}">
  <div>
    <Route path="/"><Index on:showModal={showModal}/></Route>
    <Route path="/project-type" component="{ProjectType}" />
    <Route path="/*" component="{Redirect404}" />
  </div>
</Router>

<Footer />

<style>
</style>