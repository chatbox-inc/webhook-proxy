<template>
  <section class="">
    <app-navibar></app-navibar>
    <div class="container mt-5">

      <h3>Webhook</h3>

      <div class="mt-3" v-if="item">
        <div class="text-muted">{{url}}/webhook/{{item.name}}</div>
        <div class="text-muted" v-if="logs.length">last access: {{logs[0].created_at}}</div>
        <div class="text-muted">count: {{count}} </div>
      </div>

      <div class="list-group list-group-flush mt-2">
        <app-logline v-for="(item,key) in this.logs" :key="key" :item="item"></app-logline>
      </div>

      <div class="row mt-5" v-if="count > logs.length">
        <div class="col-sm-8 offset-sm-2">
          <a class="btn btn-block btn-light" @click="load">more</a>
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
      async load(){
        const response = await this.$store.dispatch('LOAD_WEBHOOK_LOGS',{
          name: this.item.name,
          page: this.page
        })
        this.logs = this.logs.concat(response.data.logs);
        this.count = response.data.count;
        this.page++;

        if(this.count === this.logs.length || response.data.logs.length === 0){
          this.hasMore = false;
        }
      }
    },
    async created(){
      if(!this.item){
        this.$router.push("/")
      }
      await this.load();
    }
  }
</script>

<style>

</style>
