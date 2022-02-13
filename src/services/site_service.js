import axios from 'axios';

export const getServicesList = () => {
  return new Promise((resolve, reject) => {
    axios.get('api/service/list', {
      params: {}
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Lista de servicios no encontrado')
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

export const getProjectTypeList = () => {
  return new Promise((resolve, reject) => {
    axios.get('api/project_type/list', {
      params: {}
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Lista de tipos de proyecto no encontrado')
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