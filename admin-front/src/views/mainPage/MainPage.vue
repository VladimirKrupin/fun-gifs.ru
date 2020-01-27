<template>
  <div class="app flex-row  bg-theme app-container">
    <div class="row w-100 pr-md-4 pl-4 pt-2 pr-sm-0">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mr-sm-0 mr-md-5">
        <div class="card bg-info">
          <router-link :to="'gifkawood'" class="text-muted card-link">
            <div class="card-body">
              <div class="h1 text-right mb-4 text-white">
                <i class="icon-star"></i>
              </div>
              <div class="card-padding  text-center">
                <div class="h1 mb-3 text-white">gifkawood</div>
                <small class="text-uppercase text-white">group gifkawood</small>
              </div>
            </div>
          </router-link>
        </div>
      </div>

      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mr-sm-0 mr-md-5">
        <div class="card bg-warning">
          <router-link :to="'moregirls'" class="text-muted card-link">
            <div class="card-body">
              <div class="h1 text-right mb-4 text-white">
                <i class="icon-star"></i>
              </div>
              <div class="card-padding  text-center">
                <div class="h1 mb-3 text-white">moregirls</div>
                <small class="text-uppercase text-white">group moregirls</small>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'MainPage',
    data() {
      return {
      };
    },
    components: {
    },
    computed: {
    },
    updated: function (){
    },
    watch: {
    },
    mounted: function () {
    },
    methods: {
    }
  }
</script>

<style>
  .card-padding {
    padding-bottom: 40px;
  }
</style>
