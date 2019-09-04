<template>
    <div>
        <div class="form-group">
            <router-link
                :to="{name: 'createCompany'}"
                class="btn btn-success"
            >Create new company</router-link>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Companies list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Website</th>
                        <th>Email</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="company, index in companies">
                        <td>{{ company.name }}</td>
                        <td>{{ company.address }}</td>
                        <td>{{ company.website }}</td>
                        <td>{{ company.email }}</td>
                        <td>
                            <router-link :to="{name: 'editCompany', params: {id: company.id}}" class="btn btn-primary m-1">Edit</router-link>
                            <a href="#" class="btn btn-xs btn-danger m-1" @click="deleteEntry(company.id, index)">delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                companies: []
            }
        },
        mounted(){
            this.getCompaniesData()
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    let app = this
                    app.$http.delete('/v1/companies/' + id)
                        .then(function(resp) {
                            app.companies.slice(index, 1)
                            app.getCompaniesData()
                        })
                        .catch(function(resp){
                            alert("Could not delete company")
                        })
                }
            },
            getCompaniesData(){
                let app = this
                app.$http.get('/v1/companies')
                    .then(function(resp){
                        app.companies = resp.data;
                    })
                    .catch(function(resp){
                        console.log(resp)
                        alert('Could not load companies')
                    })
            }
        }
    }
</script>
