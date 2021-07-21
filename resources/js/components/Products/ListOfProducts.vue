<template>
  <div class="card">
    <div class="card-body">
      <div class="row" style="margin-bottom: 2%">
        <div class="col-4">
          <h5 class="card-title">Liste Products</h5>
        </div>
        <div class="col-4">
          <div class="input-group">
            <input
              class="form-control py-2 border-right-0 border"
              v-model="search"
              type="search"
              placeholder="search by name"
              id="example-search-input"
            />
            <span class="input-group-append">
              <button
                class="btn btn-outline-secondary border-left-0 border"
                @click="searchMethode"
                type="button"
              >
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>

        <div class="col-4">
          <select
            class="form-control"
            @change="onChange($event)"
            v-model="data.category_id"
            id="exampleFormControlSelect1"
          >
            <option value="" disabled selected>Select Type</option>
            <option value="all" selected>All</option>
            <option
              v-for="(item, i) in categories"
              :key="i"
              :value="item.categoryname"
            >
              {{ item.categoryname }}
            </option>
          </select>
        </div>
      </div>
      <div v-if="createSuccess == true" class="alert alert-success" role="alert">
  Product Updated successfully
</div>
 <div v-if="deleteSuccess == true" class="alert alert-success" role="alert">
  Product Deleted successfully
</div>

      <table
        id="dtBasicExample"
        class="table table-striped table-bordered table-sm"
        cellspacing="0"
        width="50%"
      >
        <thead>
          <tr>
            <td>#</td>
            <th class="th-sm">ref</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Images</th>
            <th class="th-sm">Type</th>
            <th class="th-sm">Quntity</th>
            <th class="th-sm">Price</th>
            <th class="th-sm">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, i) in tempProducts" :key="i">
            <th>{{ i + 1 }}</th>
            <th scope="row">{{ item.id }}</th>
            <td>{{ item.name }}</td>
            <td>
              <img
                :src="item.image1"
                id="img-zoom"
                style="border-radius: 100%"
                width="70px"
                height="70px"
              />
              <img
                :src="item.image2"
                id="img-zoom"
                class="img-hide"
                style="border-radius: 100%"
                width="70px"
                height="70px"
              />
              <img
                :src="item.image3"
                id="img-zoom"
                   class="img-hide"
                style="border-radius: 100%"
                width="70px"
                height="70px"
              />
            </td>
            <td>{{ item.category_id }}</td>
            <td>{{ item.quntity }}</td>
            <td>{{ item.price }}</td>

            <td id="action">
              <button
                type="button"
                class="btn btn-danger"
                id="btn-ellipse-edit"
                @click="showDeleteModel(item)"
              >
                <i class="fas fa-trash"></i>
              </button>
              <button
                type="button"
                class="btn btn-success"
                id="btn-ellipse-edit"
                @click="showUpdateModel(item)"
              >
                <i class="fas fa-pen"></i>
              </button>
              <button
                type="button"
                class="btn btn-primary"
                id="btn-ellipse-edit"
                  @click="showDetailModel(item)"
              >
                <i class="fas fa-external-link-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <nav
        v-if="dispalyAllProduct == false"
        aria-label="Page navigation example"
      >
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" @click="pagination(1)" tabindex="-1">First</a>
          </li>
          <li
            class="page-item"
            v-for="(item, i) in productSize"
            :key="i"
            @click="pagination(i + 1)"
            href=""
          >
            <a class="page-link">{{ i + 1 }}</a>
          </li>

          <li class="page-item">
            <a class="page-link" @click="pagination(productSize)">Last</a>
          </li>
        </ul>
      </nav>

      <nav v-else aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" @click="paginationByType(1)" tabindex="-1"
              >First</a
            >
          </li>
          <li
            class="page-item"
            v-for="(item, i) in productSize"
            :key="i"
            @click="paginationByType(i + 1)"
            href=""
          >
            <a class="page-link">{{ i + 1 }}</a>
          </li>

          <li class="page-item">
            <a class="page-link" @click="paginationByType(productSize)">Last</a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- ******************************************************************************************************
  *********************************************** update ***************************************************
  **********************************************************************************************************-->

    <div>
      <b-modal
        id="update-modal"
        hide-footer
        centered
        :title="'Edit ' + editdata.name + ' - ref: ' + editdata.id"
      >
        <div class="form-group">
          <label for="exampleInputEmail1">Product Name</label>
          <input
            type="text"
            v-model="editdata.name"
            id="exampleInputEmail1"
             :class="{
                  'form-control': input.isActiveName,
                  'is-invalid': input.hasErrorName,
                  'is-valid': input.nameIsValide,
                }"
            placeholder="Name of Product"
          />
          <small  :style="style.inerrorname">Name is required</small>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Description Name</label>
          <input
            type="text"
            v-model="editdata.description"
                     id="exampleInputEmail1"
            placeholder="Description of product"
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

        <div class="form-group">
          <label for="exampleInputEmail1">Price</label>
          <input
            type="number"
            v-model="editdata.price"
               :class="{
                  'form-control': input.isActivePrice,
                  'is-invalid': input.hasErrorPrice,
                  'is-valid': input.hasPrice,
                }"         
                   id="exampleInputEmail1"
            placeholder="Price of Product"
          />
          <small :style="style.priceinerror">Price is required</small>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Quntity</label>
          <input
            type="number"
            v-model="editdata.quntity"
            :class="{
                  'form-control': input.isActiveQuntity,
                  'is-invalid': input.hasErrorQuntity,
                  'is-valid': input.hasQuntity,
                }"
            id="exampleInputEmail1"
            placeholder="Quntity of Product"
          />
             <small :style="style.quntityinerror">Quntity is required</small>
        </div>

        <hr />
        <div class="float-right">
          <b-button
            size="sm"
            variant="outline-secondary"
            @click="$bvModal.hide('update-modal')"
          >
            Cancel
          </b-button>
          <b-button size="sm" variant="success" @click="update">
            save
          </b-button>
        </div>
      </b-modal>
    </div>

    <!-- ******************************************************************************************************
  *********************************************** delete ***************************************************
  **********************************************************************************************************-->

    <div>
      <b-modal id="delete" hide-footer centered title="">
        <i class="far fa-times-circle"></i>
        <h4>Are you sure?</h4>
        <p>
          Do you really want to delete these item? This process cannot be
          undone.
        </p>

        <div class="float-center">
          <button class="btn btn-secondary">Cancel</button>

          <button @click="Delete" class="btn btn-danger">Delete</button>
        </div>
      </b-modal>
    </div>

    <!-- ******************************************************************************************************
  *********************************************** Display Product after search ********************************
  **********************************************************************************************************-->

    <div id="modal">
      <b-modal
        id="display-product"
        size="lg"
        hide-footer
        centered
        title="List of Products"
      >
        <div style="margin: 3% 6%">
          <table
            id="dtBasicExample"
            class="table table-striped table-bordered table-sm"
            cellspacing="0"
            width="50%"
          >
            <thead>
              <tr>
                <td>#</td>
                <th class="th-sm">ref</th>
                <th class="th-sm">Name</th>
                <th class="th-sm">Images</th>
                <th class="th-sm">Type</th>
                <th class="th-sm">Quntity</th>
                <th class="th-sm">Price</th>
                <th class="th-sm">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, i) in searchArr" :key="i">
                <th>{{ i + 1 }}</th>
                <th scope="row">{{ item.id }}</th>
                <td>{{ item.name }}</td>
                <td>
                  <img
                    :src="item.image1"
                    id="img-zoom"
                    style="border-radius: 100%"
                    width="70px"
                    height="70px"
                  />
                  <img
                    :src="item.image2"
                    id="img-zoom"
                    style="border-radius: 100%"
                    width="70px"
                    height="70px"
                  />
                </td>
                <td>{{ item.category_id }}</td>
                <td>{{ item.quntity }}</td>
                <td>{{ item.price }}</td>

                <td id="action">
                  <button
                    type="button"
                    class="btn btn-danger"
                    id="btn-ellipse-edit"
                    @click="showDeleteModel(item)"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-success"
                    id="btn-ellipse-edit"
                    @click="showUpdateModel(item)"
                  >
                    <i class="fas fa-pen"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    id="btn-ellipse-edit"
                  >
                    <i class="fas fa-external-link-alt"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a
                  class="page-link"
                  @click="paginationBySearch(1)"
                  tabindex="-1"
                  >First</a
                >
              </li>
              <li
                class="page-item"
                v-for="(item, i) in productSizeBySearch"
                :key="i"
                @click="paginationBySearch(i + 1)"
                href=""
              >
                <a class="page-link">{{ i + 1 }}</a>
              </li>

              <li class="page-item">
                <a
                  class="page-link"
                  @click="paginationBySearch(productSizeBySearch)"
                  >Last</a
                >
              </li>
            </ul>
          </nav>
        </div>

        <hr />
        <div class="float-right">
          <b-button
            size="sm"
            variant="outline-primary"
            @click="$bvModal.hide('display-product')"
          >
            Ok
          </b-button>
        </div>
      </b-modal>
    </div>

        <!-- ******************************************************************************************************
  *********************************************** Display detail Product  ********************************
  **********************************************************************************************************-->

    <div id="modal">
      <b-modal
        id="detail-product"
        size="lg"
        hide-footer
        centered
        title="Detail Products"
      >
        <div style="margin: 3% 6%">
          <div class="row" id="first-row">
            <div class="col-6 " id="first-col">
              <div class="row">
              <img :src="detailProduct.image1"  class="img-first"  alt="">

              </div>
              <div class="row">
              
                  <img :src="detailProduct.image2" class="img-rest" id="img-zoom-detail"  alt="">
               
                   <img :src="detailProduct.image3"  class="img-rest" id="img-zoom-detail"  alt="">
               
              </div>
                
            </div>
               <div class="col-6" id="seacand-col-6">
                 <div class="row" id="row-secande">
                      <div class="col-6">
                          <p class="h6">ref: </p>
                           <p class="h6">Name: </p>
                           
                             <p class="h6">Category: </p>
                              <p class="h6">Small Category: </p>
                               <p class="h6">Quntity: </p>
                                <p class="h6">Price: </p>
                                 <p class="h6">Cost: </p>
                                  <p class="h6">Quantity sold: </p>
                      </div>
                      <div class="col-6">
                        <p class="h6">{{detailProduct.id}}</p>
                          <p class="h6">{{detailProduct.name}}</p>
                         
                              <p class="h6">{{detailProduct.category_id}}</p>
                                <p class="h6">{{detailProduct.Smallcategory_id}}</p>
                                  <p class="h6">{{detailProduct.quntity}}</p>
                                    <p class="h6">{{detailProduct.price}} $</p>
                                      <p class="h6" style="color: red">{{detailProduct.price * detailProduct.quntity}} $</p>
                                        <p class="h6" style="color : green">0</p>
                                       


                      </div>
                 </div>
                 <div class="row">
                     <p class="h6 col-6">Description: </p>
                            <p class="h6 col-6">{{detailProduct.description}}</p>
                 </div>
                
              
            </div>
          </div>
        
        </div>

        <hr />
        <div class="float-right">
          <b-button
            size="sm"
            variant="outline-primary"
            @click="$bvModal.hide('detail-product')"
          >
            Ok
          </b-button>
        </div>
      </b-modal>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      style: {
        inerrorname: { color: "#dc3545", display: "none" },
        inerrordescription: { color: "#dc3545", display: "none" },
        priceinerror: { color: "#dc3545", display: "none" },
        quntityinerror: { color: "#dc3545", display: "none" },
      },
      
      input: {
        isActiveName: true,
        hasErrorName: false,
        nameIsValide: false,
        isActiveDescription: true,
        hasErrorDescription: false,
        hasDescription: false,
        isActivePrice: true,
        hasErrorPrice: false,
        hasPrice: false,
        isActiveQuntity: true,
        hasErrorQuntity: false,
        hasQuntity: false,
      },

      products: [],
      tempProducts: [],
      tempProductsByType: [],
      categories: [],
      productSize: "",
      editdata: "",
      detailProduct : '',
      productSizeBySearch: "",
      dispalyAllProduct: false,
      search: "",
      searchArr: [],
      tempsearchArr: [],

      data: {
        category_id: "",
      },
       createSuccess : false,
       deleteSuccess : false,
    };
  },

  methods: {

     verifcationInput(){
var isEmpty = false;
      
      if (this.editdata.name == "") {
          this.style.inerrorname.display = "block";
          this.input.hasErrorName = true;
          isEmpty = true;
        }

      if (this.editdata.description == "") {
        this.style.inerrordescription.display = "block";
        this.input.hasErrorDescription = true;
        isEmpty = true;
      }


     if (this.editdata.price == "") {
        this.style.priceinerror.display = "block";
        this.input.hasErrorPrice = true;
        isEmpty = true;
     }

       if (this.editdata.quntity == "") {
          this.style.quntityinerror.display = "block";
          this.input.hasErrorQuntity = true;
          isEmpty = true;
        }
     
     

     
     

      if (isEmpty == true) {
        return 0;
      }
    },
    showUpdateModel(product) {
      this.$bvModal.show("update-modal");
      this.editdata = product;
    },

    showDeleteModel(item) {
      this.$bvModal.show("delete");
      this.data = item;
    },
    showDetailModel(product){
        this.$bvModal.show("detail-product");
      this.detailProduct = product;
    },

    async Delete() {
      await axios
        .post("/api/product/delete", this.data)
        .then((response) => {
          this.$bvModal.hide("delete");

          this.tempProducts = this.arrayRemove(this.tempProducts, this.data);
          this.tempProducts = this.refreshData(this.tempProducts);
          this.products = this.arrayRemove(this.products, this.data);
          this.products = this.refreshData(this.products);
          this.searchArr = this.arrayRemove(this.searchArr, this.data);
          this.searchArr = this.refreshData(this.searchArr);
          this.tempsearchArr = this.arrayRemove(this.tempsearchArr, this.data);
          this.tempsearchArr = this.refreshData(this.tempsearchArr);

          this.deleteSuccess = true
          this.ifSuccess()
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    async ifSuccess(){
     
  

   this.editdata = ''
 

    this.style.inerrorname.display = "none";
          this.input.hasErrorName = false;
             this.input.nameIsValide = false;

    this.style.inerrordescription.display = "none";
        this.input.hasErrorDescription = false;
         this.input.hasDescription = false;
  
    

    this.style.priceinerror.display = "none";
     this.input.hasErrorPrice = false;
        this.input.hasPrice = false;

    this.style.quntityinerror.display = "none";
     this.input.hasErrorQuntity = false;
       this.input.hasQuntity = false;



        await this.sleep(5000);
   this.createSuccess = false
   this.deleteSuccess = false

    },

    sleep(ms) {
      return new Promise((resolve) => {
        setTimeout(resolve, ms);
      });
    },
    async update() {

      if(this.verifcationInput() == 0)return 0;
     
      await axios
        .post("/api/product/update", this.editdata)
        .then((response) => {
          if (response.status == 200) {
            
          this.tempProducts = this.refreshData(this.tempProducts);
          this.products = this.refreshData(this.products);
          this.searchArr = this.refreshData(this.searchArr);
          this.tempsearchArr = this.refreshData(this.tempsearchArr);
          
            this.$bvModal.hide("update-modal");
            this.createSuccess = true
           this.ifSuccess()
           
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    refreshData(arr) {
      arr.sort(function (a, b) {
        var keyA = new Date(a.created_at),
          keyB = new Date(b.created_at);
        // Compare the 2 dates
        if (keyA < keyB) return -1;
        if (keyA > keyB) return 1;
        return 0;
      });

      return arr;
    },

    arrayRemove(arr, value) {
      return arr.filter(function (ele) {
        return ele != value;
      });
    },

    searchMethode() {
      var elementToArray = [];
      var searcheToArray = this.search.split("");
      var test = false;
      var index = 0;
      this.tempsearchArr = [];
      this.products.forEach((element) => {
        elementToArray = element.name.split("");
        index = 0;
        searcheToArray.forEach((sear) => {
          elementToArray.forEach((vr) => {
            if (sear == vr) {
              index++;
            }
          });
        });
        if (index >= 1) {
          element.index = index;
          this.tempsearchArr.push(element);
        }
      });
      this.searchArr = this.tempsearchArr;
      this.$bvModal.show("display-product");
      this.paginationBySearch(1);
    },

    paginationBySearch(group) {
      this.searchArr = [];
      this.productSizeBySearch = Math.floor(this.tempsearchArr.length / 3) + 1;

      var b = group - 1;

      for (var i = b * 3; i <= group * 3 - 1; i++) {
        if (this.tempsearchArr[i] != null) {
          this.searchArr.push(this.tempsearchArr[i]);
        } else break;
      }
    },

    async getCategory() {
      await axios
        .get("/api/category/withsmallcategory/")
        .then((response) => {
          if (response.status == 200) {
            this.categories = response.data;

            this.products.forEach((element) => {
              this.categories.forEach((category) => {
                if (element.category_id == category.id) {
                  element.category_id = category.categoryname;
                }
              });
            });
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    sortProduct() {
      var temp = "";

      for (var i = 0; i < this.tempProducts.length; i++) {
        for (var j = 1; j < this.tempProducts.length; j++) {
          if (this.tempProducts[i].index > this.tempProducts[j].index) {
            temp = this.tempProducts[i];
            this.tempProducts[i] = this.tempProducts[j];
            this.tempProducts[i] = temp;
          }
        }
      }
    },

    pagination(group) {
      this.tempProducts = [];

      var b = group - 1;

      for (var i = b * 10; i <= group * 10 - 1; i++) {
        if (this.products[i] != null) {
          this.tempProducts.push(this.products[i]);
        } else break;
      }
    },

    paginationByType(group) {
      this.tempProducts = [];
      this.productSize = Math.floor(this.tempProductsByType.length / 10) + 1;
      this.dispalyAllProduct = true;
      var b = group - 1;

      for (var i = b * 10; i <= group * 10 - 1; i++) {
        if (this.tempProductsByType[i] != null) {
          this.tempProducts.push(this.tempProductsByType[i]);
        } else break;
      }
    },

    onChange(event) {
      if (event.target.value == "all") {
        this.dispalyAllProduct = false;

        this.tempProducts = this.products;
        this.productSize = Math.floor(this.products.length / 10) + 1;
        return this.pagination(1);
      }
      this.tempProductsByType = [];

      this.products.forEach((element) => {
        if (element.category_id == event.target.value) {
          this.tempProductsByType.push(element);
        }
      });

      this.paginationByType(1);
    },
  },

  mounted() {
    this.getCategory();
   // this.$bvModal.show("detail-product");
  },

  async created() {
    await axios
      .get("/api/product/")
      .then((response) => {
        if (response.status == 200) {
          this.products = response.data;
          this.productSize = Math.floor(this.products.length / 7) + 1;

          this.products.forEach((element) => {
            element.created_at = element.created_at.substr(
              0,
              element.created_at.indexOf("T")
            );
          });
        }
        this.pagination(1);
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>


<style>


</style>