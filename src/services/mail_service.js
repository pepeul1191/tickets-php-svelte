import axios from 'axios';

export const sendEmail = (params) => {
  return new Promise((resolve, reject) => {
    axios.post('mail', JSON.stringify(params), {
      headers: {
        'Content-Type': 'application/json',
      }
    }).then(function (response) {
      resolve(response);
    }).catch(function (error) {
      if(error.response.status == 404){
        console.error('Recurso no encontrado')
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
