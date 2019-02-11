<template>
    <section id="content-fun" class="section section-lg section-nucleo-icons pb-250">
        <div class="container" @mouseleave="showIconsAnimation = false">
            <div class="row justify-content-center" @mouseover="showIconsAnimation = true">
                <div class="col-lg-8 text-center">
                    <h2 class="h3">Сортировка по категориям, в разработке...</h2>

                    <a href="#" class="btn btn-link text-default">#смешное</a>
                    <a href="#" class="btn btn-link text-primary">#котики</a>
                    <a href="#" class="btn btn-link text-info">#девушки</a>
                    <a href="#" class="btn btn-link text-success">#неловковышло</a>
                    <a href="#" class="btn btn-link text-warning">#шокирующие</a>
                    <a href="#" class="btn btn-link text-danger">#красота</a>
                </div>
            </div>
            <div class="row justify-content-center mt-5" @mouseover="showIconsAnimation = true">
                <div class="col-lg-8 text-center">
                    <h2 class="h2">Мы наполняем сайт контентом, скоро видео будут доступны, ждите =)</h2>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
  data() {
    return {
      showIconsAnimation: false
    };
  },
  methods: {
    onScroll(evt) {
      console.log(evt);
    }
  }
};
</script>
<style>
</style>
