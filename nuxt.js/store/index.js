import api from '~/service/http.js'

export const state = () => ({
  list: [],
  active: null,
  error: null // list の取得に関するエラー
})

export const mutations = {
  SET_LIST (state, list) {
    state.list = list
  },
  SET_ACTIVE (state, item) {
    state.active = item
  }
}

export const actions = {
  async POST_NEW_WEBHOOK(ctx,payload){
    return await api.register(payload)
  },
  async RELOAD_WEBHOOKS({commit}){
    const response = await api.list()
    if(Array.isArray(response.data.webhook_list)){
      commit('SET_LIST',response.data.webhook_list)
    }else{
      throw new Error("fail to load resource")
    }
  },
  LOAD_WEBHOOK_LOGS(ctx,{name,page}){
    return api.logs(name,page)
  },
}
