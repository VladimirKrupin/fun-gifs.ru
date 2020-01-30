<template>
  <div class="app flex-row bg-theme">
    <div class="container-fluid bg-theme">
      <b-row>
        <b-col class="col-sm-12 col-12 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h1 my-4">Профиль</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 col-md-5 col-lg-5 offset-lg-1">
          <div class="block-theme block-theme--bordered mb-5">
            <p class="text text--weight-b mb-0">
              Артамонова Екатерина Павловна
            </p>
            <p class="text text--color-grey">
              Ваш бизнес наставник
            </p>
            <p>
              Если у вас возникли вопросы или нужен совет о том, как правильно вести бизнес &mdash;
              обратитесь к личному наставнику. Он даст подробную информацию.
            </p>
            <div class="d-flex flex-wrap">
              <a href="tel:89278889090" class="link pr-4">8 (927) 888 90-90</a><a
              href="email:artamonova@gmail.com" class="link">artamonova@gmail.com</a>
            </div>
          </div>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-5 col-lg-5 offset-lg-1">
          <h3 class="h3">Основное</h3>
        </b-col>
      </b-row>
      <b-row class="d-flex align-items-center mb-3">
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
          <p class="mb-0">
            Сфера деятельности
          </p>
        </b-col>
        <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
          <b-form-group class="mb-0">
            <b-form-input disabled type="text" id="name" placeholder="Торговля"
                          class="form-control form-control-lg"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="d-flex align-items-center mb-3">
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
          <p class="mb-0">
            Бизнес
          </p>
        </b-col>
        <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
          <b-form-group class="mb-0">
            <b-form-input disabled type="text" id="name"
                          placeholder="Торговая точка 'Игрушки-плюшки'"
                          class="form-control form-control-lg"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <div>
        <b-row class="d-flex align-items-center mb-3">
          <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
            <p class="mb-0">
              Поручители
            </p>
          </b-col>
          <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
            <b-form-group class="mb-0">
              <b-input-group>
                <b-input-group-prepend>
                  <b-input-group-text>1</b-input-group-text>
                </b-input-group-prepend>
                <b-form-input disabled class="form-control form-control-lg" type="text"
                              placeholder="Одинцов Василий Викторович"></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col class="col-12 col-sm-12 offset-md-4 col-md-4 col-lg-4 offset-lg-4">
            <b-form-group class="mb-0">
              <b-input-group>
                <b-input-group-prepend>
                  <b-input-group-text>2</b-input-group-text>
                </b-input-group-prepend>
                <b-form-input disabled class="form-control form-control-lg" type="text"
                              placeholder="Карпова Татьяна Васильевна"></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
      </div>
      <b-row>
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
          <h3 class="h3 mt-5">Контакты</h3>
        </b-col>
      </b-row>
      <b-row class="d-flex align-items-center mb-3">
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
          <p class="mb-0">
            Ф.И.О.
          </p>
        </b-col>
        <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
          <b-form-group class="mb-0">
            <b-form-input type="text" id="name" placeholder="Непереводимченко Александр Сергеевич"
                          class="form-control form-control-lg"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="d-flex align-items-center mb-3">
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
          <p class="mb-0">
            E-mail
          </p>
        </b-col>
        <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
          <b-form-group class="mb-0">
            <b-form-input disabled type="text" id="name" placeholder="user@mail.com"
                          class="form-control form-control-lg"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="d-flex align-items-center mb-3">
        <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1">
          <p class="mb-0">
            Телефон
          </p>
        </b-col>
        <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
          <b-form-group class="mb-0">
            <b-form-input type="text" id="name" placeholder="8 (927) 777 66-55"
                          class="form-control form-control-lg"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row><b-row class="d-flex align-items-center mb-3">
      <b-col class="col-12 col-sm-12 offset-md-1 col-md-3 col-lg-3 offset-lg-1 align-self-start">
        <p class="mb-0 mt-2">
          Юр. адрес
        </p>
        <span class="text text--color-grey"><small>Для почтовых отправлений</small></span>
      </b-col>
      <b-col class="col-12 col-sm-12 col-md-4 col-lg-4">
        <b-form-group class="mb-0">
          <b-form-textarea id="textarea1"
                           v-model="text"
                           size="lg"
                           placeholder="445445, Самарская обл., г.Тольятти, Автозаводской район, ул. Малахитовая, 8"
                           :rows="6"
                           :max-rows="6">
          </b-form-textarea>
        </b-form-group>
      </b-col>
    </b-row>
      <b-row>
        <b-col class="col-12 col-sm-12 offset-md-4 offset-lg-4">
          <b-button variant="primary" class="form__btn btn btn-lg btn-primary mb-5">Сохранить изменения
          </b-button>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import { mapGetters } from 'vuex';
  export default {
    name: 'Profile',
    computed: {
      ...mapGetters('projects',{
        projects: 'projects'
      }),
    },
    data() {
      return {
        text: '312'
      };
    },
    mounted() {
      // console.log(projects);
    }
  }
</script>

<style>

</style>
