<template>
    <div class="row justify-content-center mt-2">
        <div class="col-12" v-if="$gate.isAdminOrAuthor()">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">{{title}}</h3>

            <div class="card-tools">
                <button class="btn btn-sm btn-success" @click="newModal">Add New<i class="fas fa-user-plus fa-fw ml-2"></i></button>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>School Name</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="employee in employees.data" :key="employee.id">
                    <td>{{employee.id}}</td>
                    <td>{{employee.em_name|upCase}}</td>
                    <td>{{employee.name|upCase}}</td>
                    <td>{{employee.created_at|myDate}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary mr-1" href="#" @click="editModal(employee)">
                            <i class="fa fa-user-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="#" @click="delUser(employee.id)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <pagination :data="employees" @pagination-change-page="getResults"></pagination>
            </div>
        </div>
        <!-- /.card -->
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

                <!-- Modal -->
                <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addUserLabel">Add New User</h5>
                        <h5 v-show="editmode" class="modal-title" id="addUserLabel">Update User's info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">
                            <input v-model="form.school_id" type="hidden" name="school_id">
                            <div class="form-group">
                            <label>Employee's Name</label>
                                <input v-model="form.em_name" type="text" name="em_name" placeholder="Enter Full Employee's name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('em_name') }">
                            <has-error :form="form" field="em_name"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Date of Joining</label>
                                <input v-model="form.doj" type="date" name="doj"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('doj') }">
                            <has-error :form="form" field="doj"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Gender</label>
                                <select v-model="form.gender" name="gender" id="gender"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }" >
                                        <option selected disabled value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <has-error :form="form" field="gender"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Contact</label>
                                <input v-model="form.mobile" type="text" name="mobile" placeholder="Enter mobile No."
                                class="form-control" :class="{ 'is-invalid': form.errors.has('mobile') }">
                            <has-error :form="form" field="mobile"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Email</label>
                                <input v-model="form.email" type="email" name="email" placeholder="Enter Email Address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Monthly Salary</label>
                                <input v-model="form.salary" type="text" name="salary" placeholder="Enter Salary"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('salary') }">
                            <has-error :form="form" field="salary"></has-error>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                title: 'All Employees List',
                employees: {},
                form: new Form({
                    id:'',
                    school_id :this.$schoolID,
                    em_name : '',
                    gender : '',
                    email : '',
                    doj : '',
                    mobile : '',
                    salary : ''

                })
            }
        },
        methods:{
            getResults(page = 1) {
			axios.get('api/employee?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		    },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/employee/'+this.form.id)
                .then(()=>{
                        $('#addUser').modal('hide');
                        Swal.fire(
                        'Updated!',
                        'User Information has been updated.',
                        'success'
                        )
                }).catch(()=>{
                    this.$Progress.fail();
                    Swal('Failed!', 'There was somthing wrong. Please Try Again!','warning');
                });
                this.$Progress.finish();
                Fire.$emit('LoadData');
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addUser').modal('show');
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addUser').modal('show');
                this.form.fill(user);
            },
            delUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to server
                        if (result.value) {
                            this.form.delete('api/user/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'User has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('LoadData');
                            }).catch(()=>{
                                Swal.fire('error!', 'There is somthing wrong. Please Try Again!','warning');
                            });
                        }

                    })
            },
            loadUsers(){
                if(this.$gate.isAdmin()){
                     axios.get("api/employee").then(({data}) => (this.employees = data));
                }else{
                     axios.get("api/employee/"+this.$schoolID).then(({data}) => (this.employees = data));   
                }

            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/employee')
                .then(()=>{
                    Fire.$emit('LoadData');
                    $('#addUser').modal('hide');

                    Toast.fire({
                        icon: 'success',
                        title: 'User Created successfully'
                        });

                    this.$Progress.finish();
                })
                .catch(()=>{

                })

            }

        },
        created() {
            this.loadUsers();
            Fire.$on('LoadData',()=>{
                this.loadUsers();
            })
            //setInterval(()=>this.loadUsers(),3000);
        }
    }
</script>
