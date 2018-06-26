<template>
<div class="">
  <nav class="panel column is-offset-2 is-8">
  <p class="panel-heading">
    Phonebook
    <button class="button is-primary is-outlined " @click="openAdd()">
        Add New
    </button>
  </p>

  <div class="panel-block">
    <p class="control has-icons-left">
      <input class="input is-small is-primary" type="text" placeholder="search" v-model="searchQuery">
      <span class="icon is-small is-left">
        <i class="fas fa-search" aria-hidden="true"></i>
      </span>
    </p>
  </div>


  <a class="panel-block" v-for="item,key in temp">
    <span class="column is-9">
      {{item.name}}
    </span>

    <span class="panel-icon column is-1">
      <i class="has-text-danger fa fa-trash-o" area-hidden="true" @click="del(key, item.id)"></i>
    </span>
    <span class="panel-icon column is-1">
      <i class="has-text-info fa fa-edit" area-hidden="true" @click="openUpdate(key)"></i>
    </span>
    <span class="panel-icon column is-1">
      <i class=" has-text-primary fa fa-eye" area-hidden="true" @click="openShow(key)"></i>
    </span>
  </a>



</nav>
<add :openmodal='addActive' @closeRequest='close'></add>
<show :openmodal='showActive' @closeRequest='closeDetails'></show>
<update :openmodal='updateActive' @closeRequest='closeDetails'></update>


</div>

</template>

<script>
    let add = require('./add.vue');
    let show = require('./show.vue');
    let update = require('./update.vue');

    export default{

      components:{add,show,update},
      data(){
        return{
          addActive:'',
          showActive:'',
          updateActive:'',
          lists:'',
          errors:'',
          searchQuery:'',
          temp:''
        }
      },
      watch:{
        searchQuery(){
          if (this.searchQuery.length > 0) {
            this.temp = this.lists.filter((item) => {
              return item.name.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1
            })
          }else{
            this.temp = this.lists
          }
        }
      },
      mounted(){
        axios.post('/getData',).then((response) => this.lists = this.temp = response.data)
          .catch((error) => this.errors = error.response.data.errors)
      },
      methods:{
        openAdd(){
          this.addActive = 'is-active';
        },
        openShow(key){
          this.$children[1].list = this.temp[key]
          this.showActive = 'is-active';
        },
        openUpdate(key){
          this.$children[2].list = this.temp[key]
          this.updateActive = 'is-active';
        },
        del(key,id){
          if (confirm("Are you surre?")) {
            axios.delete(`/phonebook/${id}`).then((response) => this.lists.splice(key,1))
              .catch((error) => this.errors = error.response.data.errors)
          }
        },
        close(){
          this.addActive =  '';
        },
        closeDetails(){
          this.showActive = this.updateActive = '';
        }
      }
    }

</script>
