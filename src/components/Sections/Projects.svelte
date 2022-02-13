<script>
  import { onMount } from 'svelte';
	import { getProjectTypeList, getProjects } from '../../services/site_service.js';
  const static_url = STATIC_URL;
	export let projectTypes = [{id: 0, name: 'Todos'}];
	export let projects = [];
	export let availableProjects = [];
	export let projectTypeSelected = 0; //btn-active

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
			availableProjects = projects;
    }).catch((resp) =>  {
      if(resp.status == 404){
        console.error('Recurso para listar los proyectos no existe');
      }else{
        console.error('Ocurrió un error en obtener los proyectos');
      }
    })
  });

	const projectList = (projectTypeId) => {
		projectTypeSelected = projectTypeId;
		console.log(projectTypeId)
		if (projectTypeId == 0){
			availableProjects = projects;
		}else{
			var newAvailableProjects = [];
			projects.forEach((project) => {
				project.project_types.forEach(function(type) {
					if (type.id == projectTypeId) {
						newAvailableProjects.push(project);
					}
				});
			});
			availableProjects = newAvailableProjects;
		}
	};

	const showGallery = (projectId) => {
		console.log(projectId);
	};
</script>

<div class="container-xxl py-5">
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
						<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
							<div class="property-item rounded overflow-hidden">
								<div class="position-relative overflow-hidden">
									<a href="" on:click|preventDefault={() => {showGallery(project.id)}}><img class="img-fluid" src="{static_url}{project.url}" alt=""></a>
									<div class="bg-primary btn-gallery rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3" on:click={showGallery(project.id)}>Ver Galería</div>
								</div>
								<div class="p-4 pb-0">
									<h5 class="text-primary mb-3">{project.name}</h5>
									<p><i class="fa fa-map-marker-alt text-primary me-2"></i>{project.description}</p>
								</div>
							</div>
						</div>
					{/each}
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
</style>