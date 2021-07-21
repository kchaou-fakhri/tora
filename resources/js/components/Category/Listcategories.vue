<template>
<div class="card">
  <div class="card-body" >   


 <div class="md-toolbar-section-start">
          <h1 class="md-title">Categories<button @click="$bvModal.show('modal-center')" type="button" class="btn btn-primary" 
          id="btn-ellipse"><i class="fas fa-plus"></i></button> </h1>
        </div> 
     

    <table  class="table table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col" >id</th>
      <th scope="col">Category Name</th>
      <th scope="col">Nb Products</th>
      <th id="created" scope="col">Created at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr v-for="(item,i) in categories" :key="i">
      <th scope="row">{{i + 1}}</th>
      <td>{{item.categoryname}}</td>
      <td>0</td>
      <td id="created">{{item.created_at}}</td>
       <td id="action"> <button type="button" class="btn btn-danger" @click="showDeleteModel(item)"
          id="btn-ellipse-edit"><i class="fas fa-trash"></i></button>
           <button  type="button" @click="showUpdateModel(item)" class="btn btn-success" 
          id="btn-ellipse-edit"><i class="fas fa-pen"></i></button>
           <button  type="button" @click="showSmallModel(item)" class="btn btn-primary" 
          id="btn-ellipse-edit"><i class="fas fa-plus"></i></button>
          
           <button  type="button" @click="showSmallCategoryModel(item)" class="btn btn-secondary" 
          id="btn-ellipse-edit"><i class="fas fa-eye"></i></button>
          
          </td>
     
    </tr>

  </tbody>
</table>

  <nav  aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link"  @click="pagination(1)" tabindex="-1">First</a>
    </li>
    <li class="page-item"  v-for="(item, i) in productSize"
     :key="i" @click="pagination(i +1)" href=""><a class="page-link" >{{i+1}}</a></li>
    
    <li class="page-item">
      <a class="page-link" @click="pagination(productSize)" >Last</a>
    </li>
  </ul>
</nav>




  </div>
    <div>
  

  

 <!-- ******************************************************************************************************
  *********************************************** create ***************************************************
  **********************************************************************************************************-->


<div id="modal">
 
  <b-modal id="modal-center" hide-footer centered title="Create Category">

 <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="email" v-model="data.categoryname" 
    :class="{ 'form-control': isActive, 'is-invalid': hasError }"
     id="exampleInputEmail1"  placeholder="Name of category">
    <small :style="inerror">Name is required</small>
  </div>
  <hr>
  <div class="float-right">
  
      <b-button size="sm" variant="outline-secondary" @click="$bvModal.hide('modal-center')">
        Cancel
      </b-button>
        <b-button size="sm" variant="success" @click="create">
        save
      </b-button>
  </div>
   
  </b-modal>
</div>

 <!-- ******************************************************************************************************
  *********************************************** delete ***************************************************
  **********************************************************************************************************-->

<div>
  

  <b-modal id="delete" hide-footer  centered title="">
    <i class="far fa-times-circle"></i>
   <h4>Are you sure?</h4>
   <p>Do you really want to delete these records? This process cannot be undone.</p>

    <div class="float-center">
        <button  class="btn btn-secondary">Cancel</button>

      <button  @click="DeleteCategory" class="btn btn-danger">Delete</button>

  </div>
  </b-modal>
</div>


 <!-- ******************************************************************************************************
  *********************************************** update ***************************************************
  **********************************************************************************************************-->

<div>
 
  <b-modal id="update-modal" hide-footer centered title="Update Category">

 <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="email" v-model="editdata.categoryname" 
    :class="{ 'form-control': isActive, 'is-invalid': hasError }"
     id="exampleInputEmail1"  placeholder="Name of category">
    <small :style="inerror">Name is required</small>
  </div>
  <hr>
  <div class="float-right">
  
      <b-button size="sm" variant="outline-secondary" @click="$bvModal.hide('update-modal')">
        Cancel
      </b-button>
        <b-button size="sm" variant="success" @click="updateCategory">
        save
      </b-button>
  </div>
   
  </b-modal>
</div>


<!-- ***************************************************************************************************************
  *********************************************** create small category ***********************************************
  **********************************************************************************************************-->


<div id="modal">
 
  <b-modal id="small-category" hide-footer centered
   :title="'Small category of '+ DisplayNameOfSmallCategory">

 <div class="form-group">
    <label for="exampleInputEmail1">Small Category Name</label>
    <input type="email" v-model="smallCategory.name"
        :class="{ 'form-control': isActive, 'is-invalid': hasError }"
     id="exampleInputEmail1"  placeholder="Name of small category">
    <small :style="inerror">Name is required</small>
  </div>
  <hr>
  <div class="float-right">
  
      <b-button size="sm" variant="outline-secondary" @click="$bvModal.hide('small-category')">
        Cancel
      </b-button>
        <b-button size="sm" variant="success" @click="createSmallCategory">
        save
      </b-button>
  </div>
   
  </b-modal>
</div>


<!-- ******************************************************************************************************
  *********************************************** Display small category ***********************************************
  **********************************************************************************************************-->


<div id="modal">
 
  <b-modal id="display-small-category" size="lg" hide-footer centered
   :title="'Small category of '+ DisplayNameOfSmallCategory">
<div style="margin: 3% 6%">
  <table  class="table table-sm table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Created at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr  v-for="(item,i) in tempSmallCategory" :key="i">
      <th scope="row">{{i +1}}</th>
      <td>{{item.name}}</td>
      <td>{{item.created_at}}</td>
      <td><button type="button" class="btn btn-danger" @click="showDeleteModelSmall(item)"
          id="btn-ellipse-edit"><i class="fas fa-trash"></i></button>
           <button  type="button" @click="showUpdateSmallCategoryModel(item)" class="btn btn-success" 
          id="btn-ellipse-edit"><i class="fas fa-pen"></i></button></td>
    </tr>
    
    </tbody>
    </table>
</div>
 
  <hr>
  <div class="float-right">
  
      <b-button size="sm" variant="outline-primary" @click="$bvModal.hide('display-small-category')">
        Ok
      </b-button>
       
  </div>
   
  </b-modal>
</div>


 <!-- ******************************************************************************************************
  *********************************************** delete small Category ************************************
  **********************************************************************************************************-->

<div>
  

  <b-modal id="delete-small-category" hide-footer  centered title="">
    <i class="far fa-times-circle"></i>
   <h4>Are you sure?</h4>
   <p>Do you really want to delete these records? This process cannot be undone.</p>

    <div class="float-center">
        <button  class="btn btn-secondary" @click="$bvModal.hide('delete-small-category')">Cancel</button>

      <button  @click="DeleteSmallCategory"  class="btn btn-danger">Delete</button>

  </div>
  </b-modal>
</div>

<!-- ******************************************************************************************************
  *********************************************** update small category ***************************************************
  **********************************************************************************************************-->

<div>
 
  <b-modal id="update-small-modal" hide-footer centered title="Update Small Category">

 <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="email" v-model="editdata.name" 
    :class="{ 'form-control': isActive, 'is-invalid': hasError }"
     id="exampleInputEmail1"  placeholder="Name of category">
    <small :style="inerror">Name is required</small>
  </div>
  <hr>
  <div class="float-right">
  
      <b-button size="sm" variant="outline-secondary" @click="$bvModal.hide('update-small-modal')">
        Cancel
      </b-button>
        <b-button size="sm" variant="success" @click="updateSmallCategory">
        save
      </b-button>
  </div>
   
  </b-modal>
</div>



      
    </div>
</div>


  
</template>

<script>

export default {
  data() {
    return{
      isActive : true,
      hasError : false,
      categories : [],
      tempCategory : [],
      productSize : '',
      tempSmallCategory : [],
      DisplayNameOfSmallCategory : '',
      inerror : {
        color : '#dc3545',
        display : 'none'
      },
      data: {
            categoryname : ''
      },
      editdata : {

      },
      smallCategory : {
        name : '', 
        category_id : ''
      }
    }
  },

  methods: {
    

    pagination(group){
  
   
   this.categories = []
  
   var b = group-1
   
    for(var i = b*5; i<=(group *5) -1; i++){
      if(this.tempCategory[i] != null){
        this.categories.push(this.tempCategory[i])
      }
      else
      break
       
    }
    
  },
    async create() {
      if(this.data.categoryname.trim() == "") return(
      this.hasError = true,
      this.inerror.display = 'block')
      
      
      
     await axios.post('/api/category/created', this.data)
  .then((response)=> {
    if(response.status == 200){
      this.$bvModal.hide('modal-center')
      this.data.categoryname =''
      response.data.data.created_at = response.data.data.created_at.substr(0,
       response.data.data.created_at.indexOf("T"));
        this.inerror.display = 'none'
       
            this.categories.push(response.data.data)
            this.refreshData();

    }
   
  })
  .catch(function (error) {
    console.log(error);
  });
    },
    showDeleteModel(item){
        this.$bvModal.show('delete');
        this.data = item;
    },
    showDeleteModelSmall(item){
        this.$bvModal.show('delete-small-category');
        this.data = item;
    },

    async DeleteCategory(){
      
      await  axios.post('/api/category/delete', this.data)
  .then((response)=> {
    this.$bvModal.hide('delete');
 
  this.categories = this.arrayRemove(this.categories, this.data)
     this.refreshData();
     })
  .catch(function (error) {
    console.log(error);
  });
    },

    async DeleteSmallCategory(){
         await  axios.post('/api/smallcategory/delete', this.data)
  .then((response)=> {
    this.$bvModal.hide('delete-small-category');
 
  this.tempSmallCategory = this.arrayRemove(this.tempSmallCategory, this.data)
    this.refreshDataOfSmallCategory();
     })
  .catch(function (error) {
    console.log(error);
  });
    },

    showUpdateModel(category){
      this.$bvModal.show('update-modal');
      this.editdata = category;
     
    },

    showUpdateSmallCategoryModel(category){
      this.$bvModal.show('update-small-modal');
      this.editdata = category;
    },

   async updateCategory(){
  if(this.editdata.categoryname.trim() == "") return(
      this.hasError = true,
      this.inerror.display = 'block')
      
      
      
     await axios.post('/api/category/update', this.editdata)
  .then((response)=> {
    if(response.status == 200){
      this.refreshData();
      this.$bvModal.hide('update-modal')
      this.inerror.display = 'none'
           
    }
   
  })
  .catch(function (error) {
    console.log(error);
  });
    },

    async updateSmallCategory(){
  if(this.editdata.name.trim() == "") return(
      this.hasError = true,
      this.inerror.display = 'block')
      
      
      
     await axios.post('/api/smallcategory/update', this.editdata)
  .then((response)=> {
    if(response.status == 200){
      this.refreshDataOfSmallCategory();
      this.$bvModal.hide('update-small-modal')
      this.inerror.display = 'none'
           
    }
   
  })
  .catch(function (error) {
    console.log(error);
  });
    },

    showSmallModel(category){
        this.DisplayNameOfSmallCategory = category.categoryname;
        this.smallCategory.category_id  = category.id;
        this.$bvModal.show('small-category')
    },

  async  createSmallCategory(){
  if(this.smallCategory.name.trim() == "") return(
      this.hasError = true,
      this.inerror.display = 'block')
      
     
      console.log(this.smallCategory)
      
     await axios.post('/api/smallcategory/created', this.smallCategory)
  .then((response)=> {
    if(response.status == 200){
      this.$bvModal.hide('small-category')
        this.inerror.display = 'none'
          this.smallCategory.name = ''
       
           

    }
   
  })
  .catch(function (error) {
    console.log(error);
  });
    },


   async showSmallCategoryModel(category){
      this.$bvModal.show('display-small-category');
      
       await axios.get('/api/smallcategory/findbyid/'+category.id)
  .then((response)=> {
    if(response.status == 200){
      
     this.tempSmallCategory = response.data
   this.tempSmallCategory.forEach(element => {
        element.created_at = element.created_at.substr(0, element.created_at.indexOf("T"));
       
      });
    
    }
    console.log(this.tempSmallCategory);
   
  })
  .catch(function (error) {
    console.log(error);
  });
   
  },
  

    refreshData(){
        this.categories.sort(function (a, b) {
          var keyA = new Date(a.created_at),
            keyB = new Date(b.created_at);
          // Compare the 2 dates
          if (keyA < keyB) return -1;
          if (keyA > keyB) return 1;
          return 0;
        });
 
    },

    refreshDataOfSmallCategory(){
        this.tempSmallCategory.sort(function (a, b) {
          var keyA = new Date(a.created_at),
            keyB = new Date(b.created_at);
          // Compare the 2 dates
          if (keyA < keyB) return -1;
          if (keyA > keyB) return 1;
          return 0;
        });
      console.log(this.tempSmallCategory)
 
    },

     arrayRemove(arr, value) { 
    
        return arr.filter(function(ele){ 
            return ele != value; 
        });
    }
    
    
  },







  async created(){
   await axios.get('/api/category/')
  .then((response)=> {
    if(response.status == 200){
      
     this.categories = response.data
   this.categories.forEach(element => {
        element.created_at = element.created_at.substr(0, element.created_at.indexOf("T"));
       
      });
         this.productSize = Math.floor(this.categories.length/5)+1
         this.tempCategory = this.categories
         this.pagination(1)
    
    }
   
  })
  .catch(function (error) {
    console.log(error);
  });
    },
  
  
}
</script>



<style  scoped>
@import url('./style.css');
  

</style>

