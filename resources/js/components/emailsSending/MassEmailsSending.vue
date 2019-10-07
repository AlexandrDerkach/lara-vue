<template>
    <div>
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Mass mode to sending emails</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" v-if="">
                            <div class="alert alert-success col-lg-12" role="alert">
                                Success sending
                            </div>
                        </div>
                        <form @submit="saveForm()">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fromModControl" id="fromBaseControl" @click="showControls(clientsMode)">
                                        <label class="form-check-label" for="fromBaseControl">Clients</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fromModControl" id="fromExcelControl" @click="showControls(leadsMode)">
                                        <label class="form-check-label" for="fromExcelControl">Leads</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Subject</label>
                                    <input type="text" v-model="mail.subject" class="form-control form-re" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Message</label>
                                    <textarea v-model="mail.msg" class="form-control form-re form-msg" required>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button class="btn btn-success">Send</button>
                                    <button class="btn btn-primary" @click="">Repeat last</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                clientsMode: 'clients',
                leadsMode: 'leads',
                loadMode: '',
                mail: {
                    msg: '',
                    subject: '',
                    resultOk: ''
                },
                prevEmail: {},
            }
        },
        methods:{
            showControls(mode){
                this.loadMode = mode
            },
            saveForm(){
                event.preventDefault()
                let app = this
                
                if(app.loadMode) {
                    let app = this
    
                    app.axios.post('/v1/massEmailsSending/getEmailsCount/' + app.loadMode)
                    .then(resp => {
                        return
                        let count = resp.data;
                        if(count > 0)
                        {
                            if(confirm(`You are ready to send ${resp.data} message(s)`))
                            {
                                app.axios.post('/v1/massEmailsSending/getEmails', {modeControl: app.loadMode, mail: app.mail})
                                .then()
                                .catch()
                            }
                        }
                        else
                        {
                            alert('There are no emails. You should create just a company.')
                        }
                    })
                    .catch(err => {
                        alert('error in sendInDBMode', err.message)
                    })
                }
                else{
                
                }
            }
        },
        mounted() {
            this.showControls()
        }
    };
</script>
