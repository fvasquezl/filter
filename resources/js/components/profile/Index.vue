<style>
    .widget-user-header {
        background-position: center center;
        background-size: cover;
    }
</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('./img/user_cover.jpg');height:250px">
                        <h3 class="widget-user-username">Elizabeth Pierce</h3>
                        <h5 class="widget-user-desc">Web Designer</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name</label>
                                            <input type="text"
                                                   name="name"
                                                   class="form-control"
                                                   :class="{ 'is-invalid': form.errors.has('name') }"
                                                   id="name"
                                                   placeholder="Name"
                                                   v-model="form.name">
                                            <has-error :form="form" field="name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                            <input type="email"
                                                   name="email"
                                                   class="form-control"
                                                   :class="{ 'is-invalid': form.errors.has('email') }"
                                                   id="email"
                                                   placeholder="Email"
                                                   v-model="form.email">
                                            <has-error :form="form" field="email"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Experience</label>
                                            <textarea class="form-control"
                                                      name="bio"
                                                      :class="{ 'is-invalid': form.errors.has('bio') }"
                                                      id="bio"
                                                      placeholder="Experience"
                                                      v-model="form.bio">
                                            </textarea>
                                        <has-error :form="form" field="bio"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Profile Photo</label>
                                            <input class="form-control-file"
                                                   type="file"
                                                   name="photo"
                                                   id="photo"
                                                   @change="updateProfile">
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="control-label">Password (leave emptu if not changing)</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control"
                                                   :class="{ 'is-invalid': form.errors.has('password') }"
                                                   id="password"
                                                   placeholder="Password">
                                            <has-error :form="form" field="password"></has-error>
                                    </div>
                                    <div class="form-group">
                                            <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
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
            return{
                form: new Form({
                    id:'',
                    name:'',
                    email:'',
                    password:'',
                    type:'',
                    bio:'',
                    photo:'',
                })
            }
        },
        mounted() {
            console.log('Component Mounted')
        },
        methods:{
            updateProfile(e){
                let file= e.target.files[0];
                let reader = new FileReader();

                if(file['size'] < 2111775){
                    reader.onloadend = (file) => {
                        this.form.photo = reader.result;
                    };
                    reader.readAsDataURL(file)
                }else{
                    Swal.fire({
                        type:'error',
                        title:'Oops...',
                        text:'You are uploading a large file',
                    })
                }

            },
            updateInfo(){
                this.form.put('api/profile')
                    .then((res)=>{
                        this.form.photo = res.data.data.photo;
                    })
                    .catch()
            },
        },
        computed:{
            getProfilePhoto(){

                return "img/profile/"+this.form.photo;
            }
        },
        created() {
            axios.get('api/profile')
                .then(({data})=>(this.form.fill(data)));  // aqui llamar de nuevo
        }
    }
</script>

<style scoped>

</style>