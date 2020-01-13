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
          <h1 class="h4 my-1">Выберите тэги</h1>
        </b-col>
      </b-row>

      <b-row>
        <b-col class="col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-2">
          <b-form-group
            label=""
            label-for="basicCustomCheckboxes"
            :label-cols="0"
          >
            <b-form-checkbox-group stacked id="basicCustomCheckboxes">
              <div class="custom-control custom-checkbox mb-2" v-for="(tag,key) in tags" :key="key">
                <input type="checkbox"
                       class="custom-control-input"
                       v-model="tags[key].value"
                       :id="key">
                <label class="custom-control-label" :for="key">{{tag.name}}</label>
              </div>
            </b-form-checkbox-group>
          </b-form-group>
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
              <th aria-colindex="3" class="text-center">Загружено</th>
              <th aria-colindex="4" class="text-right">Действия</th>
            </tr>
            </thead><!---->
            <tbody v-for="(item, index) in posts" :key="index" :aria-rowindex="index">
            <tr>
              <td aria-colindex="1" class="text-center">{{ index+1 }}</td>
              <td aria-colindex="2" class="text-center">{{ item.comment }}</td>
              <td aria-colindex="3" class="text-right">{{ item.created_at }}</td>
              <td aria-colindex="4" class="text-right">
                <div class="cell-posting">
                  <div class="remove-post" v-on:click="modalRemovePost(item)">delete</div>
                  <div class="posting-post" v-on:click="modalPostingPost(item)">post</div>
                </div>
              </td>
            </tr>
            <tr >
              <td colspan="4" aria-colindex="1" class="text-sm-center text-md-left" style="border-top: 0; border-bottom: 2px solid rgba(0,0,0,.2)">
                <video width="300" height="200" controls>
                  <source :src="'https://file-store.gifkawood.ru/'+item.files[0].path" :type="getFileType(item)">
                  Your browser does not support the video tag.
                </video>
              </td>
            </tr>
            <tr >
              <td colspan="4" aria-colindex="1" class="text-sm-center text-md-left" style="border-top: 0; border-bottom: 2px solid rgba(0,0,0,.2)">
                тэги
                <b-form-checkbox-group stacked id="basicCustomCheckboxes">
                  <span class="custom-control custom-checkbox mb-2 inline" v-for="(tag,key) in item.tags" :key="key">
                    <input v-on:change="changePostTag(tag,item.id)"
                           type="checkbox"
                           class="custom-control-input"
                           v-model="tag.value"
                           :id="'post_'+key">
                    <label class="custom-control-label" :for="'post_'+key">{{tag.name}}</label>
                  </span>
                </b-form-checkbox-group>
              </td>
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

    <!-- Modal -->
    <div class="modal-wrapper" v-if="modal.show">
      <div class="modal mt-5" v-if="modal.show" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Предупреждение</h5>
              <button type="button" class="close" data-dismiss="modal" v-on:click="closePopup()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{modal.text}}</p>
            </div>
            <div v-if="modal.type === 'delete'" class="modal-footer">
              <button type="button" class="btn btn-secondary" v-on:click="removePost(modal.item)">Delete</button>
              <button type="button" class="btn btn-primary" v-on:click="closePopup()" data-dismiss="modal">Close</button>
            </div>
            <div v-if="modal.type === 'post'" class="modal-footer">
              <div v-if="loaderModal" class="loader"></div>
              <button type="button" class="btn btn-secondary" :disabled="disabledModal" v-on:click="postingPost(modal.item)">Posting</button>
              <button type="button" class="btn btn-primary" v-on:click="closePopup()" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
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
          disabledModal: false,
          loader: false,
          loaderModal: false,
          userFiles: [],
          uploadFiles: [],
          test: {},
          test2: [],
          modal:{
            show: false,
            type: false,
            text: '',
            postId: '',
          },
          tags: [],
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
        axios.get( 'http://api.gifkawood.ru/api/tags',
        ).then(response => {
          let tag = response.data;
          let tags = this.tags;
          Object.keys(tag).forEach(function (key) {
            tags.push({id:tag[key].id,name:tag[key].name,value:false});
          });
        })
          .catch(e => {
            console.log(e);
          });
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
          let tags = this.tags;
          let tagsValues = [];
          Object.keys(tags).forEach(function (key) {
            if (tags[key].value){
              tagsValues.push(tags[key].id)
            }
          });
          formData.append('tags',tagsValues);

          this.disabled = true;
          this.loader = true;

          axios.post( 'http://api.gifkawood.ru/api/putFiles',
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
              this.$store.dispatch('posting/setPosts');
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
        getFileType(item){
          let str = item.files[0].path;
          return 'video/' + str.slice(-(str.length - str.indexOf('.'))+1,str.length);
        },
        modalRemovePost(item){
          this.modal = {
            show: true,
            type: 'delete',
            text: 'Уверены что хотите удалить пост?',
            item: item,
          }
        },
        modalPostingPost(item){
          this.modal = {
            show: true,
            type: 'post',
            text: 'Хотите запостить сейчас?',
            item: item,
          }
        },
        closePopup(){
          this.modal = {
            show: false,
              type: false,
              text: '',
              postId: '',
          }
        },
        removePost(item){
          const options = {
            method: 'POST',
            headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
              item
            },

            url: 'http://api.gifkawood.ru/api/removePost',
          };
          axios(options)
            .then(response => {
              if (response.data.status === 'error'){
                this.closePopup();
                this.errors = response.data.data.errors;
                return false;
              }else if(response.data.status === 'ok'){
                this.closePopup();
                this.success = response.data.data.message[0];
                this.$store.dispatch('posting/setPosts');
              }
            })
            .catch(e => {
              this.closePopup();
              console.log(e);
            });
        },
        postingPost(item){
          this.disabledModal = true;
          this.loaderModal = true;
          const options = {
            method: 'POST',
            headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
              item
            },
            url: 'http://api.gifkawood.ru/api/postingPost',
          };
          axios(options)
            .then(response => {
              if (response.data.status === 'error'){
                this.closePopup();
                this.errors = response.data.data.errors;
                this.disabledModal = false;
                this.loaderModal = false;
                return false;
              }else if(response.data.status === 'ok'){
                this.closePopup();
                this.success = response.data.data.message[0];
                this.$store.dispatch('posting/setPosts');
                this.disabledModal = false;
                this.loaderModal = false;
              }
            })
            .catch(e => {
              this.closePopup();
              this.disabledModal = false;
              this.loaderModal = false;
              console.log(e);
            });
        },
        changePostTag: function (tag,id) {
          console.log(tag);
          console.log(id);
        }
      }
    }
</script>

<style>
  .alert-success {
    white-space: pre-line;
  }
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

  .loader-post-process {
    width: 100px;
    height: 100px;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  .cell-posting {
    position: relative;
    height: 100px;
  }
  .remove-post {
    position: absolute;
    right: 0;
    bottom: 10px;
    color: red;
    text-decoration: underline;
  }
  .remove-post:hover {
    cursor: pointer;
  }
  .posting-post {
    position: absolute;
    right: 0;
    top: 5px;
    background: #15c90c;
    color: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 1px 1px 3px rgba(0,0,0,.4);
    cursor: pointer;
  }
  .posting-post:hover {
    cursor: pointer;
  }

  .modal-wrapper {
    background: rgba(0,0,0,.7);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 10000;
  }
  .main .container-fluid {
    padding: 0 10px;
  }
  .modal {
    display: block;
  }
</style>
