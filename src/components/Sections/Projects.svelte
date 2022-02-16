<script>
  import { onMount } from 'svelte';
	import { Modal, Carousel } from 'bootstrap';
	import jQuery from 'jquery';
	import { getProjectTypeList, getProjects } from '../../services/site_service.js';
  const staticUrl = STATIC_URL;
	export let projectTypes = [{id: 0, name: 'Todos'}];
	export let projects = [];
	export let availableProjects = [];
	export let projectTypeSelected = 0; //btn-active
	let modalProject = {images: []};
	let modalDOM;
	let modalNoGalleryDOM;
	let pageSize = 6;
	let actualPage = 1;
	let buttonsPages = [];

	onMount(() => {    
    getProjectTypeList().then((resp) => {
      projectTypes = projectTypes.concat(resp.data);
    }).catch((resp) =>  {
      if(resp.status == 404){
        console.error('Recurso para listar los tipos de proyectos no existe');
      }else{
        console.error('Ocurrió un error en obtener los tipos de proyectos');
      }
    })
		getProjects().then((resp) => {
      projects = resp.data;
			var i = 0;
			var page = 1;
			projects.forEach((project) => {
				if(i < pageSize){
					project.page = page;
					availableProjects.push(project);
					i = i + 1;
				}else{
					i = 1;
					page = page + 1;
					project.page = page;
					availableProjects.push(project);
				}
			});
			availableProjects = availableProjects;
			updateButtonPages(page);
    }).catch((resp) =>  {
      if(resp.status == 404){
        console.error('Recurso para listar los proyectos no existe');
      }else{
        console.error('Ocurrió un error en obtener los proyectos');
      }
    });
		modalDOM = new Modal(document.getElementById('galleryModal'));
		modalNoGalleryDOM = new Modal(document.getElementById('noGalleryModal'));
  });

	const updateButtonPages = (page) => {
		// buttonsPages
		buttonsPages = []
		for(var i = 1; i <= page; i++){
			buttonsPages.push(i);
		}
		buttonsPages = buttonsPages;
	}

	const projectList = (projectTypeId) => {
		projectTypeSelected = projectTypeId;
		var newAvailableProjects = [];
		var i = 0;
		var page = 1;
		if (projectTypeId == 0){
			projects.forEach((project) => {
				if(i < pageSize){
					project.page = page;
					newAvailableProjects.push(project);
					i = i + 1;
				}else{
					i = 1;
					page = page + 1;
					project.page = page;
					newAvailableProjects.push(project);
				}
			});
			availableProjects = newAvailableProjects;
		}else{
			projects.forEach((project) => {
				project.project_types.forEach((type) => {
					if(i < pageSize && type.id == projectTypeId){
						project.page = page;
						newAvailableProjects.push(project);
						i = i + 1;
					}else if(type.id == projectTypeId){
						i = 1;
						page = page + 1;
						project.page = page;
						newAvailableProjects.push(project);
					}
				});
			});
			availableProjects = newAvailableProjects;
		}
		actualPage = 1;
		updateButtonPages(page);
	};

	const showGallery = (projectId) => {
		modalProject = null;
		availableProjects.forEach((project) => {
			if(project.id == projectId){
				modalProject = project;
			}
		});
		if(modalProject.images.length > 0){
			modalDOM.show();
			var myCarousel = document.querySelector('#carouselProjectImages')
			var carousel = new Carousel(myCarousel, {
				interval: 5000,
			});
		}else{
			modalNoGalleryDOM.show();
		}
	};

	const loadPage = (buttonNumber) => {
		actualPage = buttonNumber;
		if(window.innerWidth > 700){
			var pos = jQuery('#projects').offset().top + 100;
			jQuery('html, body').animate({ 
				scrollTop: pos
			}, 0);
		}
	};
</script>

<div class="container-xxl py-5 {projects.length == 0 ? 'd-none' : ''}" id="projects">
  <div class="container">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
      <h1 class="mb-3">Proyectos</h1>
      <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
    </div>
    <div class="col-lg-12 text-start text-center wow slideInRight" data-wow-delay="0.1s">
      <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
				{#each projectTypes as projectType}
					<li class="nav-item me-2">
						<button class="btn btn-outline-primary btn-types {projectType.id == projectTypeSelected ? 'btn-active' : ''}" data-bs-toggle="pill" on:click={projectList(projectType.id)}>{projectType.name}</button>
					</li>
				{/each}
      </ul>
  	</div>
    <div class="tab-content">
      <div id="tab-1" class="tab-pane fade show p-0 active">
				<div class="row g-4">
					{#each availableProjects as project}
						{#if project.page == actualPage}
							<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
								<div class="property-item rounded overflow-hidden">
									<div class="position-relative overflow-hidden">
										<a href="" on:click|preventDefault={() => {showGallery(project.id)}}><img class="img-fluid" src="{staticUrl}{project.url}" alt=""></a>
										<div class="bg-primary btn-gallery rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3" on:click={showGallery(project.id)}>Ver Galería</div>
									</div>
									<div class="p-4 pb-0">
										<h5 class="text-primary mb-3">{project.name}</h5>
										<p><i class="fa fa-map-marker-alt text-primary me-2"></i>{project.description}</p>
									</div>
								</div>
							</div>
						{/if}
					{/each}
				</div>
      </div>
			<div class="row pull-right btn-number-group">
				{#each buttonsPages as buttonNumber}
					{#if actualPage == buttonNumber}
						<span class="btn-number btn-number-active" on:click={loadPage(buttonNumber)}>{buttonNumber}</span>
					{:else}
						<span class="btn-number" on:click={loadPage(buttonNumber)}>{buttonNumber}</span>
					{/if}
				{/each}
			</div>
    </div>
  </div>
	<!-- Gallery Modal -->
	<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="galleryModalLabel">{modalProject.name}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div id="carouselProjectImages" class="carousel slide" data-bs-ride="carousel">
						<!-- inner -->
						<div class="carousel-inner">
							{#each modalProject.images as image, i}
								<div class="carousel-item {i == 0 ? 'active' : '' }">
									<img src="{staticUrl}{image.url}" class="d-block w-100" alt="{image.description}">
									<div class="carousel-caption d-none d-md-block">
										<p>{image.description}</p>
									</div>
								</div>
							{/each}
						</div>
						<!-- controls -->
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselProjectImages" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselProjectImages" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Empty Gallery Modal -->
	<div class="modal fade" id="noGalleryModal" tabindex="-1" aria-labelledby="noGalleryModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="noGalleryModalLabel">Uppps</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center">
					El proyecto aún no cuenta con una galería de imágenes.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
  .nav-pills .nav-item .btn {
    color: var(--dark);
  }

  .nav-pills .nav-item .btn:hover,
  .nav-pills .nav-item .btn.active {
    color: #FFFFFF;
  }

  .property-item {
    box-shadow: 0 0 30px rgba(0, 0, 0, .08);
  }

  .property-item img {
    transition: .5s;
  }

  .property-item:hover img {
    transform: scale(1.1);
  }

  .property-item .border-top {
    border-top: 1px dashed rgba(0, 185, 142, .3) !important;
  }

  .property-item .border-end {
    border-right: 1px dashed rgba(0, 185, 142, .3) !important;
  }

	.btn-gallery{
		background: var(--secondary) !important;
	}

	.btn-gallery:hover{
		cursor:pointer;
	}

	.btn-types{
		border: 1px solid var(--primary);
	}

	.btn-types:hover{
		background: var(--primary) !important;
		border: solid 1px white !important;
	}

	.btn-active{
		background: var(--primary);
		color:white !important;
	}

	.btn-active:hover{
		border: solid 1px white !important;
	}

	#galleryModal{
		z-index: 9999;
	}

	.carousel-caption{
		background-color: rgba(76, 76, 76, 0.60);
		margin-bottom: 0px !important;
	}

	.carousel-caption > p{
		margin-bottom: 0px !important;
	}

	.carousel-control-prev-icon, .carousel-control-next-icon{
		background-color: rgba(76, 76, 76, 0.90) !important;
		border-radius: 20px;
	}

	.btn-number {
    float: left;
    position: relative;
    width: fit-content;
    font-size: 25px;
    background: white;
		border: 1px solid var(--secondary);
    color:var(--secondary);
    margin-left: 20px;
    border-radius: 20px;
	}

	.btn-number:hover{
		border: 1px solid var(--secondary);
		cursor: pointer;
		transform: perspective();
	}

	.btn-number-active {
		color: white;
    background: var(--secondary);
	}

	.btn-number-active:hover{
		background: var(--primary);
	}

	.btn-number-group{
		padding-top: 20px;
		padding-bottom: 20px;
	}

	.py-5{
		padding-bottom: 5rem!important;
	}
</style>