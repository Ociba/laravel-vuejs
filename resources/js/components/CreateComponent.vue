// CreateComponent.vue
<template>
    <div class="row justify-content-center col-md-12">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">Create New Student</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label" for="name">Name:</label>
                            <div class="">
                                <input type="text" class="form-control" v-model="name" id="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Email:</label>
                            <div class="">
                                <input type="text" class="form-control" v-model="email" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone">Phone:</label>
                            <div class="">
                                <input type="number" class="form-control" v-model="phone" id="phone" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" @click.prevent="saveStudent" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-defaul">
                <div class="card-header">All Student</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student,index) in students.data" :key="student.id">
                                <th scope="row">{{index + 1}}</th>
                                <td>{{student.name}}</td>
                                <td>{{student.email}}</td>
                                <td>{{student.phone}}</td>
                                <td>
                                    <button type="button" @click="editStudent(student.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">edit</button>
                                    <button type="button" @click="deleteStudent(student.id)"  class="btn btn-danger btn-sm">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="students"@pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
         <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label" for="name">Name:</label>
                            <div class="">
                                <input type="text" class="form-control" v-model="editname" id="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Email:</label>
                            <div class="">
                                <input type="text" class="form-control" v-model="editemail" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone">Phone:</label>
                            <div class="">
                                <input type="number" class="form-control" v-model="editphone" id="phone" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" @click.prevent="updateStudent" data-dismiss="modal" class="btn btn-primary">Submit</button>
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
</template>
<script>
    export default {
        data(){
            return{
                students: {},
                id: '',
                name: '',
                email: '',
                phone: '',
                editname: '',
                editemail: '',
                editphone: ''
            }
        },
        mounted() {
            console.log('Component mounted.'),
            // Fetch initial results
       this.getResults();
        },
        methods: {
            saveStudent(){
                axios.post('/student',{
                    name: this.name,
                    email: this.email,
                    phone: this.phone
                })
                .then(response =>{ //This makes the input field empty after creating data
                    this.name='';
                    this.email='';
                    this.phone='';
                     // Fetch initial results
              this.getResults();
                });
            },
             // Our method to GET results from a Laravel endpoint
             getResults(page = 1) {
                axios.get('/all_students?page=' + page)
                    .then(response => {
                        console.log(response.data)
                        this.students = response.data;
                    });
             },
             editStudent(id){
                 //alert(id); checking ids
                 axios.get('edit_student/' + id)
                 .then(response =>{
                     console.log(response);
                     this.id =response.data.id;
                     this.editname =response.data.name;
                     this.editemail =response.data.email;
                     this.editphone =response.data.phone;
                 });
             },
             updateStudent(){
                // alert('test');
                axios.put('/update_student', {
                    id    :this.id,
                    name  :this.editname,
                    email :this.editemail,
                    phone :this.editphone
                })
                .then(response =>{
                    this.getResults();
                });
             },
             deleteStudent(id){
                 axios.delete('delete_student/' + id)
                 .then(response =>{
                    this.getResults();
                });
             }
        },
    }
</script>