<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Send message to e-mail</h3>
            </div>
            <div class="panel-body">
                <form @submit="saveForm()">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Send to (e-mail)</label>
                            <input type="email" v-model="email" class="form-control form-re" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Subject</label>
                            <input type="text" v-model="subject" class="form-control form-re" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <label class="control-label">Message</label>
                            <textarea v-model="msg" class="form-control form-re form-msg" required>
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-xs-12 form-group">
                            <button class="btn btn-success">Send</button>
                        </div>
                    </div>
                </form>
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
    export default {
        data: function(){
            return {
                email: '',
                subject: '',
                msg: ''
            }
        },
        methods:{
            saveForm(){
                event.preventDefault()
                let app = this,
                    data = {
                        'email': app.email,
                        'subject': app.subject,
                        'msg': app.msg
                    }
                app.axios.post('/v1/emailsSanding', data)
                    .then(function(resp) {
                            //console.log('email ok', resp.data)
                    })
                    .catch(function(resp){
                        console.log('email err', resp.data)
                    })
            }
        }
    }
</script>
