<template>
    <div>
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Send a message to selected e-mail</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" v-if="email.resultOk">
                            <div class="alert alert-success col-lg-12" role="alert">
                                Your message to {{ prevEmail.name }} is  sent! You could send next one.
                            </div>
                        </div>
                        <form @submit="saveForm()">
                            <div class="row">
                                <div class="form-group  col-md-12">
                                    <label class="control-label">Send to (e-mail)</label>
                                    <input type="email" v-model="email.name" class="form-control form-re" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Subject</label>
                                    <input type="text" v-model="email.subject" class="form-control form-re" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Message</label>
                                    <textarea v-model="email.msg" class="form-control form-re form-msg" required>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button class="btn btn-success">Send</button>
                                    <button class="btn btn-primary" @click="repeatLast">Repeat last</button>
                                    <button class="btn btn-danger" @click="clearForm">Clear form</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="panel panel-default">
            <div class="panel-heading">Message history</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sent to</th>
                        <th>Aubject</th>
                        <th>Message</th>
                        <th>Sent at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="historyItem in emailsHistory.data">
                        <td>{{ historyItem.id }}</td>
                        <td>{{ historyItem.email }}</td>
                        <td>{{ historyItem.subject }}</td>
                        <td>{{ historyItem.msg }}</td>
                        <td>{{ historyItem.created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <VuePagination   :pagination="emailsHistory"
                             @paginate="getSendingHistory()"
                             :offset="4">
            </VuePagination>
        </div>
            </div>
        </div>
    </div>
</template>
<style>
    .form-msg
    {
        min-height: 150px;
    }
</style>
<script>
    import VuePagination from './Pagination.vue'
    export default {
        data: function(){
            return {
                email: {
                    name: '',
                    subject: '',
                    msg: '',
                    resultOk: false
                },
                prevEmail: {},
                emailsHistory: {},
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1,
                offset: 4,
            }
        },
        components: {
            VuePagination,
        },
        methods:{
            saveForm(){
                event.preventDefault()
                let app = this
                app.axios.post('/v1/emailsSending', app.email)
                    .then(resp => {
                        app.prevEmail = app.email
                        app.email = {};
                        app.email.resultOk = true
                        app.getSendingHistory()
                    })
                    .catch(resp => alert('email err', resp.data))
            },
            repeatLast(){
                event.preventDefault()
                let app = this
                app.axios.get('/v1/emailsSending/repeatLast')
                    .then(resp =>{
                        app.email = resp.data
                    }
                ).catch(err => alert('error', err))
            },
            getSendingHistory(){
                let app = this
                app.axios.get(`/v1/emailsSending?page=${app.emailsHistory.current_page}`)
                .then(resp => {
                    app.emailsHistory = resp.data
                }).catch(err => alert(err.message))
            },
            clearForm(){
                this.email = {}
            }
        },
        mounted() {
            this.getSendingHistory()
        }
    }
</script>
