<template>
  <section class="">
    <app-navibar></app-navibar>
    <div class="container mt-5">

      <h3>Webhook list</h3>

      <div class="list-group list-group-flush mt-5">
        <a v-for="(item,key) in items" :key="key" @click="setActive(item)"
           class="list-group-item list-group-item-action flex-column align-items-start" >

          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{item.name}}</h5>
            <!--<small>3 days ago</small>-->
          </div>
          <p class="mb-1">{{url + '/webhook/' +item.name}}</p>
          <small v-if="item.url">Proxy to {{item.url}}</small>
          <small v-else>no url connected</small>
        </a>
      </div>

    </div>
  </section>
</template>

<script>
import AppLogo from '~/components/AppLogo.vue'
import AppNavibar from '~/components/Navibar.vue'

export default {
  components: {
    AppLogo,
    AppNavibar
  },
  computed:{
    items(){
      return this.$store.state.list;
    },
    url(){
      return process.env.APP_URL;
    }
  },
  methods:{
    setActive(item){
      this.$store.commit("SET_ACTIVE",item);
      this.$router.push("/logs/webhook")
    }
  },
  async mounted(){
    try{
      await this.$store.dispatch('RELOAD_WEBHOOKS')
    }catch (e){

    }
  }
}
</script>

<style>

</style>
