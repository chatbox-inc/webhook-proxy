<template>
  <div>
    <a
       class="list-group-item list-group-item-action flex-column align-items-start" >

      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1" @click="showDetail = !showDetail"
            aria-controls="hoge"
            :aria-expanded="showDetail ? 'true' : 'false'">
          Request from {{item.remote_host}}
        </h5>
        <small>{{item.created_at}}</small>
      </div>

      <b-collapse v-model="showDetail" class="mt-3" id="hoge">
        <p class="text-muted"> Request Detail info below </p>
        <h5>Request <small>from {{item.remote_host}}</small></h5>
        <pre>{{json(item.request_body)}}</pre>
        <div v-if="item.response_status">
          <h5>Result <small>status: {{item.response_status}}</small></h5>
          <pre><code>{{json(item.response_body)}}</code></pre>
        </div>
      </b-collapse>
    </a>
  </div>
</template>

<script>
  import beautify from "json-beautify"
  export default{
    props:{
      item: Object
    },
    data(){
      return {
        showDetail: false
      }
    },
    methods:{
      json(json_str){
        return beautify(json_str, null, 2, 100)
      }
    }
  }

</script>

<style>

</style>
