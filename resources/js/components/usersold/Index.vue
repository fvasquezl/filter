<template>
    <div class="row">
        <div class="col-sm-3">
            filters
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <user v-for="user in users" :user="user" :key="user.id"></user>
                    <pagination :meta ="meta" v-on:pagination:switched="getUsers"></pagination>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import User from './partials/User.vue';
    import Pagination from '../pagination/Pagination.vue';

    export default {
        components:{
            User,
            Pagination
        },
        data () {
            return {
                users:[],
                meta:{}
            }
        },
        mounted(){
            this.getUsers();
        },
        methods:{
            getUsers(page =1){
                axios.get('api/users',{params:{page}}).then((response)=>{
                    this.users = response.data.data;
                    this.meta = response.data.meta
                })
            }
        }
    }
</script>