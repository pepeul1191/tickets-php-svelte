import axios from 'axios';

export const getWorkerById = (id) => {
  return new Promise((resolve, reject) => {
    axios.get('admin/worker/get', {
      params: {id: id}
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Trabajador no encontrado')
      }else{
        console.error(error.response.data);
      }
      reject(error.response);
    })
    .then(function () {
      // todo?
    });
  });
}

export const saveWorkerDetail = (params) => {
  return new Promise((resolve, reject) => {
    axios.post('admin/project/detail/save', JSON.stringify(params), {
      headers: {
        'Content-Type': 'application/json',
      }
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Proyecto a editar no existe en el servidor')
      }else{
        console.error(error.response.data);
      }
      reject(error.response);
    })
    .then(function () {
      // todo?
    });
  });
}

export const saveWorkerBranch = (params) => {
  return new Promise((resolve, reject) => {
    axios.post('admin/worker/branch/save', JSON.stringify(params), {
      headers: {
        'Content-Type': 'application/json',
      }
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Trabajador a asociar sedes no existe en el servidor')
      }else{
        console.error(error.response.data);
      }
      reject(error.response);
    })
    .then(function () {
      // todo?
    });
  });
}
