<template>
  <div class="app flex-row bg-theme">
    <div class="container-fluid bg-theme">

      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h1 my-3">Заполните данные</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h4 my-1">Выберите файл</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-10 col-lg-10 d-flex mb-4">
          <input type="file" id="files" ref="files" class="form-control-file" v-on:change="handleFileUploads()">
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h4 my-1">Напишите комментарий</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6 col mb-4">
          <input  type="text" id="comment" class="form-control">
        </b-col>
      </b-row>
      <b-row >
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-10 col-lg-10 d-flex">
          <b-button variant="primary" class="form__btn btn btn-lg btn-primary mb-4 mr-3" v-on:click="sendFiles" :disabled="disabled">Отправить</b-button>
          <div v-if="loader" class="loader"></div>
        </b-col>
      </b-row>
      <b-row v-if="errors !== ''">
        <b-col class="offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6">
          <b-alert v-for="(item, index) in errors" show :key="index" variant="danger" class="mb-4">
            <span v-html="item"></span>
          </b-alert>
        </b-col>
      </b-row>
      <b-row v-if="message !== ''">
        <b-col class="offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6">
          <b-alert v-for="(item, index) in message" show :key="index" variant="success" class="mb-4">
            {{ item }}
          </b-alert>
        </b-col>
      </b-row>

    </div>
  </div>
</template>

<script>
    import axios from 'axios';
    import { mapGetters } from 'vuex';

    export default {
      data() {
        return {
          errors: '',
          message: '',
          disabled: false,
          loader: false,
          userFiles: [],
          uploadFiles: [],
          test: {},
          test2: [],
        };
      },
      computed: {
      },
      name: 'Files',
      mounted: function () {
      },
      methods: {
        sendFiles: function () {

          this.errors = '';

          let formData = new FormData();

          if (this.userFiles.length === 0 || this.userFiles.length > 10){
            this.errors = ["Выберите файл для загрузки!"];
            return false
          }

          for( let i = 0; i < this.userFiles.length; i++ ){
            let file = this.userFiles[i];
            formData.append('files[' + i + ']', file);
          }

          this.disabled = true;
          this.loader = true;

          axios.post( 'https://api.fun-gifs.ru/api/putFiles',
            formData,
            {
              headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                'Content-Type': 'multipart/form-data'
              }
            }
          ).then(response => {
            if (response.data.status === 'error'){
              this.errors = response.data.data.errors;
              this.disabled = false;
              this.loader = false;
              return false;
            }else if(response.data.status === 'message'){
              return false;
            }else if(response.data.status === 'ok'){
              this.$store.dispatch('common/addAlert', { message: response.data.data.message[0] });
              this.userFiles = '';
              this.$refs.files.value = '';
              this.disabled = false;
              this.loader = false;
            }
          })
            .catch(e => {
              console.log(e);
              this.errors = ["Ошибка сервера! Попробуйте загрузить файлы еще раз, либо обратитесь в поддержку."];
              this.disabled = false;
              this.loader = false;
            });

        },
        handleFileUploads: function (e) {
          this.userFiles = this.$refs.files.files;
        },
      }
    }
</script>

<style>
  .link-container {
    text-align: center;
    position: relative;
    word-break: break-all;
    max-width: 100px;
    min-width: 100px;
  }

  .file-link {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
  }

  .link-container:hover {
    color: #0ba2ff;
    text-decoration: none;
  }

  .bg-theme {
    background-color: #f6f7f7;
  }
  .loader {
    border: 5px solid #f3f3f3; /* Light grey */
    border-top: 5px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
