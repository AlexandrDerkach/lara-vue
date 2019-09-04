<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-dark">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create new company</h3>
            </div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Company name</label>
                            <input type="text" v-model="company.name" class="form-control form-re" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Company address</label>
                            <input type="text" v-model="company.address" class="form-control" required>
                        </div>
                    </div>test@test.com
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Company website</label>
                            <input type="text" v-model="company.website" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Company email</label>
                            <input type="text" v-model="company.email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                company: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault()
                let app = this
                let newCompany = app.company

                axios.post('/v1/companies', newCompany)
                    .then(function (resp) {
                        if(!resp.ok){
                            alert('Fill all the fields, please...')
                        }
                        else
                        {
                            app.$router.push({path: '/companies'})
                        }
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your company")
                    })
            }
        }
    }
</script>
