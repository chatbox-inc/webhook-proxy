<template>
  <section class="">
    <app-navibar></app-navibar>
    <div class="container mt-5" v-if="item">

      <h3>Webhook</h3>

      <button type="button" @click="reload(item)">Reload</button>

      <div class="mt-3">
        <div class="text-muted">{{url}}/webhook/{{item.name}}</div>
        <div class="text-muted" v-if="logs.length">last access: {{logs[0].created_at}}</div>
        <div class="text-muted">count: {{count}} </div>
      </div>

      <div class="list-group list-group-flush mt-2">
        <app-logline v-for="(log,key) in this.logs" :key="key" :item="log"></app-logline>
      </div>

      <div class="row mt-5" v-if="count > logs.length">
        <div class="col-sm-8 offset-sm-2">
          <a class="btn btn-block btn-light" @click="load(item.name)">more</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import AppLogo from '~/components/AppLogo.vue'
  import AppNavibar from '~/components/Navibar.vue'
  import AppLogline from '~/components/LogLine.vue'

  export default {
    components: {
      AppLogo,
      AppLogline,
      AppNavibar
    },
    data(){
      return {
        count: null,
        logs: [],
        page: 0,
        hasMore: true
      }
    },
    computed:{
      item(){
        return this.$store.state.active;
      },
      url(){
        return process.env.APP_URL;
      }
    },
    methods:{
      async load(name){
        const response = await this.$store.dispatch('LOAD_WEBHOOK_LOGS',{
          name,
          page: this.page
        })
        this.logs = this.logs.concat(response.data.logs);
        this.count = response.data.count;
        this.page++;

        if(this.count === this.logs.length || response.data.logs.length === 0){
          this.hasMore = false;
        }
      },
      reload(item) {
        this.logs = []
        this.page = 0
        this.load(item.name)
      }
    },
    mounted(){
      if(!this.item){
        this.$router.push("/")
      }
      this.load(this.item.name);
    }
  }
</script>

<style>

</style>
