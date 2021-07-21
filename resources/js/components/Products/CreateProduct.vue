<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Add Product</h5>
<div v-if="createSuccess == true" class="alert alert-success" role="alert">
  Product create successfully
</div>

      <form>
        <div class="row" id="row-create-product">
          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputEmail1"
                >Product Name <b style="color: red">*</b></label
              >
              <input
                type="text"
                :class="{
                  'form-control': input.isActiveName,
                  'is-invalid': input.hasErrorName,
                  'is-valid': input.nameIsValide,
                }"
                v-model="data.name"
                v-on:change="ifEmpty('name')"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                placeholder="Name of Product"
              />
              <small :style="style.inerrorname">Name is required</small>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputPassword1"
                >Description <b style="color: red">*</b></label
              >
              <input
                type="text"
                v-model="data.description"
                id="exampleInputPassword1"
                 @change="ifEmpty('description')"
                placeholder="Description of Product"
                :class="{
                  'form-control': input.isActiveDescription,
                  'is-invalid': input.hasErrorDescription,
                  'is-valid': input.hasDescription,
                }"
              />
              <small :style="style.inerrordescription"
                >Description is required</small
              >
            </div>
          </div>
        </div>
        <div class="row" id="row-create-product">
          <div class="form-group col-6">
            <label for="exampleFormControlSelect1"
              >Type Of Product <b style="color: red">*</b></label
            >
            <select
              :class="{
                'form-control': input.isActiveType,
                'is-invalid': input.hasErrorType,
                 'is-valid': input.hasType,
              }"
              @change="onChange($event)"
              v-model="data.category_id"
              id="exampleFormControlSelect1"
            >
              <option v-for="(item, i) in categories" :key="i" :value="item.id">
                {{ item.categoryname }}
              </option>
            </select>
            <small :style="style.categoryinerror">Category is required</small>
          </div>
          <div class="form-group col-6">
            <label for="exampleFormControlSelect1">More filter</label>
            <select
              class="form-control"
              @change="onChangeSmall($event)"
              v-model="data.Smallcategory_id"
              id="exampleFormControlSelect1"
              :disabled="type"
            >
              <option
                v-for="(item, i) in smallCategory"
                :key="i"
                :value="item.id"
              >
                {{ item.name }}
              </option>
            </select>
          </div>
        </div>
        <div class="row" id="row-create-product">
          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputEmail1"
                >Price<b style="color: red">*</b></label
              >
              <input
                  @change="ifEmpty('price')"
                type="number"
                :class="{
                  'form-control': input.isActivePrice,
                  'is-invalid': input.hasErrorPrice,
                  'is-valid': input.hasPrice,
                }"
                v-model="data.price"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                placeholder="Price of Product"
              />
              <small :style="style.priceinerror">Price is required</small>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputPassword1"
                >Quntity <b style="color: red">*</b></label
              >
              <input
                type="number"
                v-model="data.quntity"
                 @change="ifEmpty('quntity')"
                :class="{
                  'form-control': input.isActiveQuntity,
                  'is-invalid': input.hasErrorQuntity,
                  'is-valid': input.hasQuntity,
                }"
                id="exampleInputPassword1"
                placeholder="Quntity of Product"
              />
              <small :style="style.quntityinerror">Quntity is required</small>
            </div>
          </div>
        </div>
        <div id="row-create-product-col-4" class="row">
          <div class="col-4">
            <label>Image One <b style="color: red">*</b></label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input
                  type="file"
                  :class="{
                    'custom-file-input': input.isActiveFile1,
                    'is-invalid': input.hasErrorFile1,
                     'is-valid': input.hasFile1,
                  }"
                  id="inputGroupFile01"
                  ref="file1"
                  v-on:change="handleFileUpload1()"
                />
                <label
                  v-if="data.image1 != ''"
                  class="custom-file-label"
                  for="inputGroupFile01"
                  >{{ data.image1 }}</label
                >

                <label v-else class="custom-file-label" for="inputGroupFile01"
                  >Choose file</label
                >
              </div>
            </div>
            <small :style="style.imageOneinerror">Image one is required</small>
          </div>

          <div class="col-4">
            <label>Image Tow <b style="color: red">*</b></label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input
                  type="file"
                  id="inputGroupFile01"
                  :class="{
                    'custom-file-input': input.isActiveFile2,
                    'is-invalid': input.hasErrorFile2,
                    'is-valid': input.hasFile2,
                  }"
                  ref="file2"
                  v-on:change="handleFileUpload2()"
                />
                <label
                  v-if="data.image2 != ''"
                  class="custom-file-label"
                  for="inputGroupFile01"
                  >{{ data.image2 }}</label
                >

                <label v-else class="custom-file-label" for="inputGroupFile01"
                  >Choose file</label
                >
              </div>
            </div>
            <small :style="style.imageTowinerror">Image tow is required</small>
          </div>

          <div class="col-4">
            <label>Image Three <b style="color: red">*</b></label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input
                  type="file"
                  :class="{
                    'custom-file-input': input.isActiveFile3,
                    'is-invalid': input.hasErrorFile3,
                    'is-valid': input.hasFile3,
                  }"
                  id="inputGroupFile01"
                  ref="file3"
                  v-on:change="handleFileUpload3()"
                />
                <label
                  v-if="data.image3 != ''"
                  class="custom-file-label"
                  for="inputGroupFile01"
                  >{{ data.image3 }}</label
                >

                <label v-else class="custom-file-label" for="inputGroupFile01"
                  >Choose file</label
                >
              </div>
            </div>
            <small :style="style.imageThreeinerror"
              >Image three is required</small
            >
          </div>
        </div>
        <button @click="create" id="btn-create-product" class="btn btn-primary">
          Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inerror: {
        color: "#dc3545",
        display: "none",
      },
      style: {
        inerrorname: { color: "#dc3545", display: "none" },
        inerrordescription: { color: "#dc3545", display: "none" },
        categoryinerror: { color: "#dc3545", display: "none" },
        priceinerror: { color: "#dc3545", display: "none" },
        quntityinerror: { color: "#dc3545", display: "none" },
        imageOneinerror: { color: "#dc3545", display: "none" },
        imageTowinerror: { color: "#dc3545", display: "none" },
        imageThreeinerror: { color: "#dc3545", display: "none" },
      },
      input: {
        isActiveName: true,
        hasErrorName: false,
        nameIsValide: false,
        isActiveDescription: true,
        hasErrorDescription: false,
        hasDescription: false,
        isActiveType: true,
        hasErrorType: false,
        hasType: false,
        isActivePrice: true,
        hasErrorPrice: false,
        hasPrice: false,
        isActiveQuntity: true,
        hasErrorQuntity: false,
        hasQuntity: false,
        isActiveFile1: true,
        hasErrorFile1: false,
        hasFile1: false,
        isActiveFile2: true,
        hasErrorFile2: false,
        hasFile2: false,
        isActiveFile3: true,
        hasErrorFile3: false,
        hasFile3: false,
      },
      type: true,
      categories: [],
      smallCategory: [],
      data: {
        name: "",
        description: "",
        price: "",
        quntity: "",
        category_id: "",
        Smallcategory_id: "",
        image1: "",
        image2: "",
        image3: "",
      },
      createSuccess : false
    };
  },

  methods: {
    async create() {
     
      if (this.verifcationInput() == 0) return;
      let formData = new FormData();
      formData.append("name", this.data.name);
      formData.append("description", this.data.description);
      formData.append("price", this.data.price);
      formData.append("quntity", this.data.quntity);
      formData.append("category_id", this.data.category_id);
      formData.append("Smallcategory_id", this.data.Smallcategory_id);
      formData.append("image1", this.data.image1);
      formData.append("image2", this.data.image3);
      formData.append("image3", this.data.image3);
      await axios
        .post("api/product/created", formData)
        .then((response) => {
          if (response.status == 200) {
           this.ifSuccess()
          }
        })
        .catch(function (error) {
          console.log(error);
        });
      console.log(this.data);
    },

   async ifSuccess(){
     this.createSuccess = true
  

   this.data.name =''
   this.data.description =''
   this.data.category_id =''
   this.data.Smallcategory_id =''
   this.data.quntity =''
   this.data.price =''
   this.data.image1 = ""
   this.data.image2 = ""
   this.data.image3 = ""

    this.style.inerrorname.display = "none";
          this.input.hasErrorName = false;
             this.input.nameIsValide = false;

    this.style.inerrordescription.display = "none";
        this.input.hasErrorDescription = false;
         this.input.hasDescription = false;
  
    this.style.categoryinerror.display = "none";
        this.input.hasErrorType = false;
          this.input.hasType = false;

    this.style.priceinerror.display = "none";
     this.input.hasErrorPrice = false;
        this.input.hasPrice = false;

    this.style.quntityinerror.display = "none";
     this.input.hasErrorQuntity = false;
       this.input.hasQuntity = false;

     this.style.imageOneinerror.display = "none";
      this.input.hasErrorFile1 = false;
       this.input.hasFile1 = false;

     this.style.imageTowinerror.display = "none";
      this.input.hasErrorFile2 = false;
       this.input.hasFile2 = false;
    
     this.style.imageThreeinerror.display = "none";
      this.input.hasErrorFile3 = false;
       this.input.hasFile3 = false;


        await this.sleep(5000);
   this.createSuccess = false

    },

      sleep(ms) {
      return new Promise((resolve) => {
        setTimeout(resolve, ms);
      });
    },

    /*******************************************************************
     * *************************** verif input if empty on click   *****
     * *****************************************************************
     */
    verifcationInput(){
var isEmpty = false;
      
      if (this.data.name == "") {
          this.style.inerrorname.display = "block";
          this.input.hasErrorName = true;
          isEmpty = true;
        }

      if (this.data.description == "") {
        this.style.inerrordescription.display = "block";
        this.input.hasErrorDescription = true;
        isEmpty = true;
      }

     if (this.data.category_id == "") {
                this.style.categoryinerror.display = "block";
                this.input.hasErrorType = true;
                isEmpty = true;
              }

     if (this.data.price == "") {
        this.style.priceinerror.display = "block";
        this.input.hasErrorPrice = true;
        isEmpty = true;
     }

       if (this.data.quntity == "") {
          this.style.quntityinerror.display = "block";
          this.input.hasErrorQuntity = true;
          isEmpty = true;
        }
     
      if (this.data.image1 == "") {
        this.style.imageOneinerror.display = "block";
        this.input.hasErrorFile1 = true;
        isEmpty = true;
      }
      
   if (this.data.image2 == "") {
        this.style.imageTowinerror.display = "block";
        this.input.hasErrorFile2 = true;
        isEmpty = true;
   }


      if (this.data.image3 == "") {
        this.style.imageThreeinerror.display = "block";
        this.input.hasErrorFile3 = true;
        isEmpty = true;
      }

     
     

      if (isEmpty == true) {
        return 0;
      }
    },

/*******************************************************************
     * *************************** verif input if empty on textChange ****************
     * *****************************************************************
     */

    ifEmpty(input) {
      var isEmpty = false;
      if(input == 'name'){
          if (this.data.name == "") {
          this.style.inerrorname.display = "block";
          this.input.hasErrorName = true;
          isEmpty = true;
        }
        else
        {
          this.input.nameIsValide = true;
           this.style.inerrorname.display = "none";
          this.input.hasErrorName = false;
          isEmpty = false;
        }
      }
      if(input == 'description'){
        if (this.data.description == "") {
        this.style.inerrordescription.display = "block";
        this.input.hasErrorDescription = true;
        isEmpty = true;
         }
        else{
            this.input.hasDescription = true;
            this.style.inerrordescription.display = "none";
            this.input.hasErrorDescription = false;
            isEmpty = false;
        }  
      }
      if(input == 'type'){
        if (this.data.category_id == "") {
                this.style.categoryinerror.display = "block";
                this.input.hasErrorType = true;
                isEmpty = true;
              }
              else{
                this.input.hasType = true;
                this.style.categoryinerror.display = "none";
                this.input.hasErrorType = false;
                isEmpty = false;
              }
      }
      
      if(input == 'price'){
         if (this.data.price == "") {
        this.style.priceinerror.display = "block";
        this.input.hasErrorPrice = true;
        isEmpty = true;
      }
      else{
           this.input.hasPrice = true
             this.style.priceinerror.display = "none";
        this.input.hasErrorPrice = false;
        isEmpty = false;

      }
      }

      if(input == 'quntity'){
          if (this.data.quntity == "") {
          this.style.quntityinerror.display = "block";
          this.input.hasErrorQuntity = true;
          isEmpty = true;
        }
        else{
          this.input.hasQuntity = true
           this.style.quntityinerror.display = "none";
          this.input.hasErrorQuntity = false;
          isEmpty = false;
        }
      }
     
     if(input == 'image1'){
       if (this.data.image1 == "") {
        this.style.imageOneinerror.display = "block";
        this.input.hasErrorFile1 = true;
        isEmpty = true;
      }
      else
      {
        this.input.hasFile1 == true
        this.style.imageOneinerror.display = "none";
        this.input.hasErrorFile1 = false;
        isEmpty = false;
      }
     }
      
     if(input == 'image2'){
       if (this.data.image2 == "") {
        this.style.imageTowinerror.display = "block";
        this.input.hasErrorFile2 = true;
        isEmpty = true;
      }
      else
      {
        this.input.hasFile2 == true
        this.style.imageTowinerror.display = "none";
        this.input.hasErrorFile2 = false;
        isEmpty = false;
      }
     } 

      if(input == 'image3'){
       if (this.data.image3 == "") {
        this.style.imageThreeinerror.display = "block";
        this.input.hasErrorFile3 = true;
        isEmpty = true;
      }
      else
      {
        this.input.hasFile3 == true
        this.style.imageThreeinerror.display = "none";
        this.input.hasErrorFile3 = false;
        isEmpty = false;
      }
     } 

     
     

      if (isEmpty == true) {
        return 0;
      }
    },

    handleFileUpload1() {
     
      var type = Array.from(this.$refs.file1.files[0].type);

      for (var i = 0; i < type.length; i++) {
        if (type[i] == "/") {
          type = this.$refs.file1.files[0].type.substring(i + 1);
          break;
        }
      }

      if (
        type.trim() == "jpg" ||
        type.trim() == "png" ||
        type.trim() == "jpeg"
      ) {
        this.data.image1 = this.$refs.file1.files[0];
      }
       this.ifEmpty('image1');
    },
    handleFileUpload2() {
      
      var type = Array.from(this.$refs.file2.files[0].type);

      for (var i = 0; i < type.length; i++) {
        if (type[i] == "/") {
          type = this.$refs.file2.files[0].type.substring(i + 1);
          break;
        }
      }

      if (
        type.trim() == "jpg" ||
        type.trim() == "png" ||
        type.trim() == "jpeg"
      ) {
        this.data.image2 = this.$refs.file2.files[0];
      }
        this.ifEmpty('image2');
    },
    handleFileUpload3() {
      var type = Array.from(this.$refs.file3.files[0].type);

      for (var i = 0; i < type.length; i++) {
        if (type[i] == "/") {
          type = this.$refs.file3.files[0].type.substring(i + 1);
          break;
        }
      }

      if (
        type.trim() == "jpg" ||
        type.trim() == "png" ||
        type.trim() == "jpeg"
      ) {
        this.data.image3 = this.$refs.file3.files[0];
      }
              this.ifEmpty('image3');

    },

    onChangeSmall(event) {
      this.Smallcategory_id = event.target.value;
    },

    onChange(event) {
      this.ifEmpty('type')
      this.categories.forEach((element) => {
        if (element.id == event.target.value) {
          this.smallCategory = element.small_category;
          this.type = false;
        }
      });
    },
  },

  async created() {
    await axios
      .get("/api/category/withsmallcategory/")
      .then((response) => {
        if (response.status == 200) {
          this.categories = response.data;
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>



<style scoped>
@import url("./style.css");
</style>