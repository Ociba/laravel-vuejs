// ProductComponent.vue
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product</div>

                    <div class="card-body">
                      <div class="row">
                           <div class="col-md-6">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Name:</label>
                                        <div class="">
                                        <input type="text" class="form-control" v-model="name" id="name" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="number">N0:</label>
                                        <div class="">
                                        <input type="number" class="form-control" v-model="number" id="number" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="color">Color:</label>
                                        <div class="">
                                        <input type="text" class="form-control" v-model="color" id="color" placeholder="Enter Color">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="price">Price:</label>
                                        <div class="">
                                        <input type="text" class="form-control"v-model="price" id="price" placeholder="Enter Price">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 ">
                                        <button type="submit" @click.prevent="saveProduct" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                    <tr class="bg-success">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>number</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(product,index) in products.data" :key="product.id">
                                        <td>{{index + 1}}</td>
                                        <td>{{product.name}}</td>
                                        <td>{{product.number}}</td>
                                        <td>{{product.color}}</td>
                                        <td>{{product.price}}</td>
                                        <td>
                                        <button @click="editProduct(product.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">edit</button>
                                        <button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm">delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <pagination :data="students"@pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                             <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Name:</label>
                                                    <div class="">
                                                    <input type="text" class="form-control" v-model="editname" id="name" placeholder="Enter Product Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="number">No:</label>
                                                    <div class="">
                                                    <input type="number" class="form-control" v-model="editnumber" id="number" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="color">Color:</label>
                                                    <div class="">
                                                    <input type="text" class="form-control" v-model="editcolor" id="color" placeholder="Enter Color">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="price">Price:</label>
                                                    <div class="">
                                                    <input type="text" class="form-control"v-model="editprice" id="price" placeholder="Enter Price">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 ">
                                                    <button type="submit" @click.prevent="updateProduct" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products: {},
                id: '',
                name: '',
                number: '',
                color: '',
                price: '',
                editname: '',
                editnumber: '',
                editcolor: '',
                editprice: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
            //Fetch initial data
            this.getResults();
        },
        methods: {
            saveProduct(){
                axios.post('/save_product',{
                    name:this.name,
                    number:this.number,
                    color:this.color,
                    price:this.price
                })
                .then(response =>{
                    this.name='',
                    this.number='',
                    this.color='',
                    this.price=''
                    this.getResults();
                });
            },
             // Our method to GET results from a Laravel endpoint
             getResults(page = 1) {
                axios.get('/all_products?page=' + page)
                    .then(response => {
                        console.log(response.data)
                        this.products = response.data;
                    });
             },
              editProduct(id){
                 //alert(id); checking ids
                 axios.get('edit_product/' + id)
                 .then(response =>{
                     console.log(response);
                     this.id =response.data.id;
                     this.editname =response.data.name;
                     this.editnumber =response.data.number;
                     this.editcolor =response.data.color;
                     this.editprice =response.data.price;
                 });
             },
              updateProduct(){
                // alert('test');
                axios.put('/update_product', {
                    id    :this.id,
                    name  :this.editname,
                    number :this.editnumber,
                    color :this.editcolor,
                    price :this.editprice
                })
                .then(response =>{
                    this.getResults();
                });
             },
              deleteProduct(id){
                 axios.delete('delete_product/' + id)
                 .then(response =>{
                    this.getResults();
                });
             }
        },
    }
</script>
