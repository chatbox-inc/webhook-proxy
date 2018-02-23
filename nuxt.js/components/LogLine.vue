<template>
  <div>
    <a @click="showDetail = !showDetail"
       aria-controls="hoge"
       :aria-expanded="showDetail ? 'true' : 'false'"
       class="list-group-item list-group-item-action flex-column align-items-start" >

      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">({{item.id}})my_first_webhook</h5>
        <small>3 days ago</small>
      </div>

      <b-collapse v-model="showDetail" class="mt-3" id="hoge">
        <p class="text-muted"> Request Detail info below </p>
        <h5>Request <small>send from https://hoghoge</small></h5>
        <pre><code>
hogehoge

hogehohgeo
        </code></pre>
        <h5>Result <small>status: 200</small></h5>
        <pre><code>
hogehoge

hogehohgeo
        </code></pre>
        <!-- content here -->
      </b-collapse>
    </a>
  </div>
</template>

<script>
  export default{
    props:{
      item: Object
    },
    data(){
      return {
        showDetail: false
      }
    }
  }

</script>

<style>

</style>
