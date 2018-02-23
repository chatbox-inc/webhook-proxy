import axios from 'axios'

const sendRequest = async (options)=>{
  options = Object.assign({
    baseURL: "/api/"
  },options);
  console.log(options)
  return await axios.request(options)
}


export default {
  async register(payload){
    const method = 'post';
    const url = "/webhook"
    const data = payload
    return await sendRequest({method, url, data})
  },
  async list(payload={}){
    const method = 'post';
    const url = "/webhook/list"
    const data = payload
    return await sendRequest({method, url, data})

  },
  async logs(name,page){
    const method = 'get';
    const url = `/webhook/logs/${name}`
    const params = {page}
    return await sendRequest({method, url, params})

  }
}
