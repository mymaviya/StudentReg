<template>
    <div class="row justify-content-center mt-2">
        <div class="col-12" v-if="$gate.isAdminOrAuthor()">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">{{title}}</h3>

            <div class="card-tools">
                <button class="btn btn-sm btn-success" @click="newModal">Add User<i class="fas fa-user-plus fa-fw ml-2"></i></button>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Reg at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name|upCase}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type|upCase}}</td>
                    <td>{{user.created_at|myDate}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary mr-1" href="#" @click="editModal(user)">
                            <i class="fa fa-user-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="#" @click="delUser(user.id)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
                            <div class="form-group">
                            <label>Name</label>
                                <input v-model="form.name" type="text" name="name" placeholder="Enter Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                            <label>Email</label>
                                <input v-model="form.email" type="email" name="email" placeholder="Enter Email Address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Description</label>
                                <textarea v-model="form.bio" name="bio" id="bio" placeholder="Description (optional)"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                            <has-error :form="form" field="bio"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Role</label>
                                <select v-model="form.type" name="type" id="type"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" >
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="password" name="password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
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
                title: 'Users',
                users: {},
                form: new Form({
                    id:'',
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                    profile : ''

                })
            }
        },
        methods:{
            getResults(page = 1) {
			axios.get('api/user?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		    },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
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
                if(this.$gate.isAdminOrAuthor()){
                     axios.get("api/user").then(({data}) => (this.users = data));
                }

            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
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
