<template>
        <div class="col-md-12" >
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">{{Pagetitle}}</h3>

            <div class="card-tools">

            </div>
            </div>
            <!-- /.card-header -->
            <form @submit.prevent="editmode ? updateProperty() : createProperty()" >
            <div class="card-body p-0">

                    <div class="container">
                            <h5 class="p-3">Student's Details:</h5>
                            <div class="row gt-3">
                                <input v-model="form.user_id" type="hidden" name="user_id">
                                <div class="form-group col-md-4">
                                    <label>First Name</label>
                                        <input v-model="form.fname" type="text" name="fname" placeholder="Enter First Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('fname') }">
                                        <has-error :form="form" field="fname"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Middle Name</label>
                                        <input v-model="form.mname" type="text" name="mname" placeholder="Enter Middle Name (optional)"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('mname') }">
                                        <has-error :form="form" field="mname"></has-error>
                                </div>


                                <div class="form-group col-md-4">
                                    <label>Last Name</label>
                                        <input v-model="form.lname" type="text" name="lname" placeholder="Enter Last Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('lname') }">
                                        <has-error :form="form" field="lname"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Date of Birth</label>
                                        <input v-model="form.dob" type="date" name="dob" placeholder="Enter First Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('dob') }">
                                        <has-error :form="form" field="dob"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                <label>Class</label>
                                    <select
                                    v-model="form.class_id"
                                    name="class_id"
                                    id="class_id"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('class_id') }">
                                    <option disabled value="">Select Class</option>
                                    <option
                                        v-for="grade in this.classes"
                                        :key="grade.id"
                                        :value="grade.id"
                                    >{{grade.name}}</option>
                                    </select>
                                    <has-error :form="form" field="class_id"></has-error>
                                </div>


                                <div class="form-group col-md-4">
                                <label>Gender</label>
                                    <select v-model="form.gender" name="gender" id="gender"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }" >
                                        <option selected disabled value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <has-error :form="form" field="gender"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Father's Name</label>
                                        <input v-model="form.father" type="text" name="father" placeholder="Enter Father's Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('father') }">
                                        <has-error :form="form" field="father"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Mother's Name</label>
                                        <input v-model="form.mother" type="text" name="mother" placeholder="Enter Mother's Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('mother') }">
                                        <has-error :form="form" field="mother"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Guardian's Name</label>
                                        <input v-model="form.guardian" type="text" name="guardian" placeholder="Enter Guardian's Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('guardian') }">
                                        <has-error :form="form" field="guardian"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Upload Photo</label>
                                        <input type="file" @change="updateProfile" name="image" accept="image/*">
                                </div>

                            </div>
                            <h5 class="p-3">Address:</h5>
                            <div class="row gt-3">

                                 <div class="form-group col-md-12">
                                    <label>Street</label>
                                        <input v-model="form.street" type="text" name="street" placeholder="Enter Street"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('street') }">
                                        <has-error :form="form" field="street"></has-error>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <select
                                    v-model="form.state_id"
                                    name="state_id"
                                    id="state_id"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('state_id') }"
                                    @change="fetchCity">
                                    <option disabled value="">Select State</option>
                                    <option
                                        v-for="state in this.states"
                                        :key="state.state_id"
                                        :value="state.state_id"
                                    >{{state.state_name}}</option>
                                    </select>
                                    <has-error :form="form" field="state_id"></has-error>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <select
                                    v-model="form.city_id"
                                    name="city_id"
                                    id="city_id"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('city_id') }"
                                     >
                                    <option disabled value="">Select City</option>
                                    <option
                                        v-for="city in this.cities"
                                        :key="city.city_id"
                                        :value="city.city_id"
                                    >{{city.city_name}}</option>
                                    </select>
                                    <has-error :form="form" field="city_id"></has-error>
                                </div>


                            </div>
                            <h5 class="p-3">Contact Details:</h5>
                            <div class="row gt-3">
                                <div class="form-group col-md-4">
                                    <label>Father's Mobile</label>
                                        <input v-model="form.fmobile" type="text" name="fmobile" placeholder="Enter Father's Contact"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('fmobile') }">
                                        <has-error :form="form" field="fmobile"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Guardian's Mobile</label>
                                        <input v-model="form.gmobile" type="text" name="gmobile" placeholder="Enter Guardian's Contact"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('gmobile') }">
                                        <has-error :form="form" field="gmobile"></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>email</label>
                                        <input v-model="form.email" type="email" name="email" placeholder="Enter Email"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                </div>
                            </div>



                    </div>



            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button v-show="editmode" type="submit" class="btn btn-success float-right">Update</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary float-right">Create</button>
            </div>
            </form>
        </div>
        <!-- /.card -->
        </div>




</template>

<script>
import { round } from 'mathjs'

    export default {
        data(){
            return{
                searchResult: false,
                editmode: false,
                Pagetitle: 'New Registration',
                states:{},
                cities:{},
                classes:{},
                avatar:'',
                form: new Form({
                    id:'',
                    user_id:this.$userId,
                    fname : '',
                    mname : '',
                    lname : '',
                    dob : '',
                    image : '',
                    class_id : '',
                    gender : '',
                    father : '',
                    mother : '',
                    guardian : '',
                    street : '',
                    city_id : '759',
                    state_id : '24',
                    fmobile : '',
                    gmobile : '',
                    status : ''

                })
            }
        },
        mounted(){
            this.fetchData();
            Fire.$on('LoadData',()=>{
                    this.fetchData();
                })
            console.log(this.$userId)
        },
        methods:{
            fetchData(){
                axios.get("api/state").then(({data}) => (this.states = data));
                axios.get("api/classes").then(({data}) => (this.classes = data));
                axios.get("api/city/24").then(({data}) => (this.cities = data));
            },
            fetchCity(){
                axios.get("api/city/"+this.form.state_id).then(({data}) => (this.cities = data));
            },
            createProperty(){
                this.$Progress.start()
                this.form.post('api/regstudent')
                .then(()=>{
                    Fire.$emit('LoadData');

                    Toast.fire({
                        icon: 'success',
                        title: 'Registered Successfully'
                        });

                    this.$Progress.finish();
                    //window.location.href = '/home';
                })
                .catch(()=>{

                })
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                if(file['size']<211175){
                    reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                    this.form.image = reader.result;
                    }
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Error!',
                        text: 'You are uploading a large file.',
                        icon: 'error',
                    })
                }
                reader.readAsDataURL(file);
            },

            LoadData(){
               this.fetchData();

            }

        },
        created(){

        }

    }
</script>

