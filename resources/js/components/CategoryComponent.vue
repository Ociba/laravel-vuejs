// categoryComponent.vue
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Category Page</div>

                    <div class="card-body">
                         <div class="row">
                           <div class="col-md-6">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="category">Category:</label>
                                        <div class="">
                                        <input type="text" class="form-control" v-model="category" id="category" placeholder="Enter category">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 ">
                                        <button type="submit" @click.prevent="saveCategory" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(category,index) in categories.data" :key="category.id">
                                        <td>{{index + 1}}</td>
                                        <td>{{category.category}}</td>
                                        <td>
                                        <button @click="editCategory(category.id)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">edit</button>
                                        <button @click="deleteCategory(category.id)" class="btn btn-danger">delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <pagination :data="categories"@pagination-change-page="getResults"></pagination>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3" for="category">Category:</label>
                                                    <div class="">
                                                    <input type="text" class="form-control" v-model="editcategory" id="category" placeholder="Enter category">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 ">
                                                    <button type="submit" @click.prevent="updateCategory" class="btn btn-primary" data-dismiss="modal">Submit</button>
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
               categories: {},
               id: '',
               category: '',
               editcategory: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getResults();
        },
        methods:{
            saveCategory(){
                axios.post('/save-category',{
                    category:this.category,
                })
                .then(response =>{
                    this.category= ''
                    this.getResults();
                });
            },
            // Our method to GET results from a Laravel endpoint
             getResults(page = 1) {
                axios.get('/get-category?page=' + page)
                    .then(response => {
                        console.log(response.data)
                        this.categories = response.data;
                    });
             },
             //edit category
             editCategory(id){
                 axios.get('edit-category/' + id)
                .then(response =>{
                     console.log(response);
                     this.id =response.data.id;
                     this.editcategory =response.data.category;
                 });
             },
             //Update category
             updateCategory(){
                 axios.put('/update-category',{
                     id:this.id,
                     category:this.editcategory
                 })
                 .then(response=>{
                     this.getResults();
                 });
             },
             //Delete category
             deleteCategory(id){
                  axios.delete('delete_category/' + id)
                 .then(response =>{
                    this.getResults();
                });
             }
        }
    }
</script>
