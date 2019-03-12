<template>
  <div class="app flex-row bg-theme">
    <div class="container-fluid bg-theme">

      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h1 my-3">Заполните данные поста</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <div class="alert alert-success alert-dismissable" v-if="success">
            {{success}}
          </div>
        </b-col>
      </b-row>

      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h4 my-1">Выберите файл</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-10 col-lg-10 d-flex mb-4">
          <input language="ru" type="file" id="files" ref="files" multiple="multiple" class="form-control-file" v-on:change="handleFileUploads()">
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h4 my-1">Напишите комментарий</h1>
        </b-col>
      </b-row>
      <b-row>
        <b-col style="position: relative;" class="offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6 col mb-4 d-flex justify-content-start" >
          <!--<input  >-->
          <VueEmoji width="260" height="260" ref="emoji" @input="onInput" />
          <div class="count">{{this.count()}}</div>
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

      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5">
          <h1 class="h1 my-3">Неопубликовано</h1>
        </b-col>
      </b-row>
      <b-row v-if="!postsError">
        <b-col class="offset-md-1 col-md-8 col-lg-8 offset-lg-1 col-sm-12">
          <table aria-busy="false" aria-colcount="3" aria-rowcount="25" class="table b-table table-sm">
            <thead class="col-md-8 col-lg-8 col-sm-8">
            <tr>
              <th aria-colindex="1" class="text-center">Номер</th>
              <th aria-colindex="2" class="text-center">Комментарий</th>
              <th aria-colindex="3" class="text-right">Загружено</th>
            </tr>
            </thead><!---->
            <tbody class=""><!---->
            <tr v-for="(item, index) in posts" :key="index" :aria-rowindex="index" class="">
              <td aria-colindex="1" class="text-center">{{ index+1 }}</td>
              <td aria-colindex="2" class="text-center">{{ item.comment }}</td>
              <td aria-colindex="3" class="text-right">{{ item.created_at }}</td>
            </tr>
            </tbody>
          </table>
        </b-col>
      </b-row>

      <b-row v-if="postsError">
        <b-col class="offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6">
          <b-alert show variant="danger" class="mb-4">
            {{ postsError }}
          </b-alert>
        </b-col>
      </b-row>

    </div>
  </div>
</template>

<script>
    import axios from 'axios';
    import { mapGetters } from 'vuex';
    import VueEmoji from 'emoji-vue';

    export default {
      data() {
        return {
          errors: '',
          message: '',
          success: '',
          comment: '',
          disabled: false,
          loader: false,
          userFiles: [],
          uploadFiles: [],
          test: {},
          test2: [],
        };
      },
      components: {
        VueEmoji
      },
      computed: {
        ...mapGetters('posting', {
          posts: 'posts',
          postsError: 'postsError',
        })
      },
      name: 'Files',
      mounted: function () {
      },
      methods: {
        count: function(){
          return 255 - this.comment.length;
        },
        sendFiles: function () {

          this.errors = '';
          this.success = '';

          let formData = new FormData();

          if (this.userFiles.length === 0 || this.userFiles.length > 10){
            this.errors = ["Выберите файл для загрузки! Можно загрузить не больше 10 штук!"];
            return false
          }

          for( let i = 0; i < this.userFiles.length; i++ ){
            let file = this.userFiles[i];
            formData.append('files[' + i + ']', file);
          }

          formData.append('comment',this.comment);

          this.disabled = true;
          this.loader = true;

          axios.post( 'http://api.fun-gifs.ru/api/putFiles',
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
              this.userFiles = '';
              this.success = response.data.data.message[0];
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
        onInput(event) {
          this.comment = event.data;
          //event.data contains the value of the textarea
        },
        clearTextarea(){
          this.$refs.emoji.clear()
        },
      }
    }
</script>

<style>
  .emoji-textarea {
    width: 250px;
  }
  .count {
    position: absolute;
    left: 252px;
    top: 264px;
    font-size: 12px;
  }

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
