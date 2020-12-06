// BreedComponent.vue
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Breed Page</div>

                    <div class="card-body">
                         <div class="row">
                           <div class="col-md-6">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="breed">Breed:</label>
                                        <div class="">
                                        <input type="text" class="form-control" v-model="breed" id="breed" placeholder="Enter Breed">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 ">
                                        <button type="submit" @click.prevent="saveBreed" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="bg-primary">
                                        <th>No.</th>
                                        <th>Breed</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(breed,index) in breeds.data" :key="breed.id">
                                        <td>{{index + 1}}</td>
                                        <td>{{breed.breed}}</td>
                                        <td>
                                        <button @click="editBreed(breed.id)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">edit</button>
                                        <button @click="deleteBreed(breed.id)" class="btn btn-danger">delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <pagination :data="breeds"@pagination-change-page="getResults"></pagination>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Breed</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="breed">Breed:</label>
                                                    <div class="">
                                                    <input type="text" class="form-control" v-model="editbreed" id="breed" placeholder="Enter Breed">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 ">
                                                    <button type="submit" @click.prevent="updateBreed" class="btn btn-primary" data-dismiss="modal">Submit</button>
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
               breeds: {},
               id: '',
               breed: '',
               editbreed: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getResults();
        },
        methods:{
            saveBreed(){
                axios.post('/save-breed',{
                    breed:this.breed,
                })
                .then(response =>{
                    this.breed= ''
                    this.getResults();
                });
            },
            // Our method to GET results from a Laravel endpoint
             getResults(page = 1) {
                axios.get('/get-breed?page=' + page)
                    .then(response => {
                        console.log(response.data)
                        this.breeds = response.data;
                    });
             },
             //edit breed
             editBreed(id){
                 axios.get('edit-breed/' + id)
                .then(response =>{
                     console.log(response);
                     this.id =response.data.id;
                     this.editbreed =response.data.breed;
                 });
             },
             //Update breed
             updateBreed(){
                 axios.put('/update-breed',{
                     id:this.id,
                     breed:this.editbreed
                 })
                 .then(response=>{
                     this.getResults();
                 });
             },
             //Delete breed
             deleteBreed(id){
                  axios.delete('delete_breed/' + id)
                 .then(response =>{
                    this.getResults();
                });
             }
        }
    }
</script>
