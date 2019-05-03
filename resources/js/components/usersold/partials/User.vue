<template>
    <div class="media">

            <img class="mr-3" src="http://via.placeholder.com/84x84&text=..." :alt="user.name">

        <div class="media-body">
            <h4 class="media-hading">{{user.name}} <small class="text-muted">{{user.created_at}}</small></h4>
            <ul class="list-inline">
                <li class="list-inline-item">Email: {{user.email}}</li>
                <li class="list-inline-item">Departamento: {{user.department}}</li>

            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'user'
        ]
    }
</script>

