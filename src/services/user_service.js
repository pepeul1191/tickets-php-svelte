import axios from 'axios';
import { CSRF } from '../components/Stores/csrf.js';

export const getUser = () => {
  return new Promise((resolve, reject) => {
    axios.get('access/user/info', {
      params: {},
      headers:{
        [CSRF.key]: CSRF.value,
      }
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Dentista no encontrado')
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

export const getUserWorkerById = (id) => {
  return new Promise((resolve, reject) => {
    axios.get('access/user/worker/get', {
      params: {worker_id: id}
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Usuario no encontrado')
      }else if(error.response.status == 501){
        alert();
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

export const updateUserPassword = (params) => {
  return new Promise((resolve, reject) => {
    axios.post('access/user/worker/update', JSON.stringify(params), {
      headers: {
        'Content-Type': 'application/json',
      }
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Usuario a editar no existe en el servidor')
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
