<template>

        <div class="col-md-12" >
            <div class="callout callout-warning">
              <h5><i class="fas fa-info"></i> Registration:</h5>
              Get your Registration Soon!
            </div>

            <div class="row gt-3">
                <div class="col-md-3" v-for="ward in this.wards" :key="ward.id">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid" :src="'/images/photos/' + ward.photo" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ward.fname|upCase}} <span v-if="ward.mname">{{ward.mname|upCase}}</span> {{ward.lname|upCase}}</h3>

                            <p class="text-muted text-center">{{ward.name}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Registration No.</b> <a class="float-right">00{{ward.id}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Registration Fee</b> <a class="float-right">{{ward.reg_fee|numFormat|money}}</a>
                            </li>

                            </ul>

                            <a v-if="ward.status" href="#" class="btn btn-primary btn-block"><b>Download</b></a>
                            <a v-if="!ward.status" href="#" class="btn btn-warning btn-block"><b>Pay Registration Fee</b></a>
                            </div>
                        <!-- /.card-body -->
                        </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>





        </div>

</template>

<script>
import { round } from 'mathjs'

    export default {
        data(){
            return{
                searchResult: false,
                editmode: false,
                Pagetitle: 'Welcome',
                wards:{},
                states:{},
                cities:{},
                form: new Form({
                    id:'',
                    user_id:this.$userId,
                    fname : '',
                    mname : '',
                    lname : '',
                    dob : '',
                    class : '',
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
                axios.get("api/regstudent/"+this.$userId).then(({data}) => (this.wards = data));

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
                    window.location.href = '/home';
                })
                .catch(()=>{

                })
            },

            LoadData(){
               this.fetchData();

            }

        },
        created(){

        }

    }
</script>

