<template>
  <div>
      <div class="row">
        <div class="mb-3 col-lg-4"  id="databases">
            <label for="database" class="form-label">Database</label>
            <div>
                <v-select :options="database" label="databases"
                    @option:selected="(selected) => {
                            dbSelected = selected.databases
                        }"
                    >
                    </v-select>
            </div>
        </div>
        <div class="mb-3 col-lg-4"  id="databases" v-if="dbSelected">
            <label for="tables" class="form-label">Tables</label>
            <select name="" id="" class="form-select" v-model="tableSelected">
                <option v-for="table in tables" :value="table" :key="table">
                    {{ table }}
                </option>
            </select>
        </div>
        <div class="mb-3 col-lg-4 d-flex align-items-end"  id="databases" v-if="tableSelected !== '' && dbSelected !== ''">
            <label for="tables" class="form-label"></label>
            <button class="btn btn-success" :disabled="disabledGenerate" type="button" @click="generateAllCode">Generate Code</button>
        </div>
      </div>


        <div class="row mt-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="Select-tab" data-bs-toggle="tab" data-bs-target="#Select" type="button" role="tab" aria-controls="Select" aria-selected="true">Select</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Edit-tab" data-bs-toggle="tab" data-bs-target="#Edit" type="button" role="tab" aria-controls="Edit" aria-selected="true">Edit</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Insert-tab" data-bs-toggle="tab" data-bs-target="#Insert" type="button" role="tab" aria-controls="Insert" aria-selected="false">Insert</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Update-tab" data-bs-toggle="tab" data-bs-target="#Update" type="button" role="tab" aria-controls="Update" aria-selected="false">Update</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Delete-tab" data-bs-toggle="tab" data-bs-target="#Delete" type="button" role="tab" aria-controls="Delete" aria-selected="false">Delete</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Select" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row my-2">
                        <div class="col-lg-4">
                            <h3>Model</h3>
                            <textarea class="form-control" name="" id="" cols="70" rows="15" v-model="selectCodeModel"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Controller</h3>
                            <textarea class="form-control" name="" id="" cols="70" rows="15" v-model="selectCodeController"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="Edit" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row my-2">
                        <div class="col-lg-4">
                            <h3>Model</h3>
                            <textarea class="form-control" name="" id="" cols="70" rows="15" v-model="selectCodeModel"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Controller</h3>
                            <textarea class="form-control" name="" id="" cols="70" rows="15" v-model="selectCodeController"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Front End</h3>
                            <textarea class="form-control" id="" cols="70" rows="15" v-model="editFE"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Insert" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row  my-2">
                        <div class="col-lg-4">
                            <h3>Model</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="insertCodeModel"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Controller</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="insertCodeController"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Front End</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="insertFE"></textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="Update" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row my-2">
                        <div class="col-lg-6">
                            <h3>Model</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="updateCodeModel"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <h3>Controller</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="updateCodeController"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Delete" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row my-2">
                        <div class="col-lg-4">
                            <h3>Model</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="deleteCodeModel"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Controller</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="deleteCodeController"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <h3>Front End</h3>
                            <textarea  class="form-control" name="" id="" cols="70" rows="15" v-model="deleteFE"></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>      
  </div>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default {
    props: ['database'],
    components: {
        vSelect
    },
    data() {
        return {
            dbSelected: '',
            tableSelected: '',
            columns : [],
            tables : [],
            base_url : window.location.origin,
            pk: '',
            selectColumnsSelected: [],
            updateColumnsSelected: [],
            insertColumnsSelected: [],
            selectCodeModel: '',
            insertCodeModel: '',
            updateCodeModel: '',
            deleteCodeModel: '',
            editCodeModel: '',
            deleteFE: '',
            insertFE: '',
            editFE: '',
            selectCodeController: '',
            insertCodeController: '',
            updateCodeController: '',
            deleteCodeController: '',
            editCodeController: '',
            headers: new Headers({
                    'Content-Type': 'application/json; charset=UTF-8',
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content'),
                    credentials: "same-origin",
                }),
        }
    },
    watch: {
        dbSelected() {
            this.getTables()
        },
        tableSelected() {
            this.getColumns()
        }
    },
    computed: {
        disabledGenerate() {
            return this.dbSelected === '' && this.tableSelected === ''
        }
    },
    methods : {
        generateAllCode() {
            this.generateInsertCode()
            this.generateEditCode()
            this.generateUpdateCode()
            this.generateDeleteCode()
            this.generateSelectCode()
        },
        getColumns() {
            let fetchData = {
                method: 'POST',
                body: JSON.stringify({
                    database: this.dbSelected,
                    table: this.tableSelected
                }),
                headers: this.headers
            }
            fetch(`${this.base_url}/getTableColumns`, fetchData)
                .then(response => response.json())
                .then(data => (this.columns = data.columns, this.pk = data.pk ))
        },

        getTables() {
            let self = this
            self.tables = []
            let fetchData = {
                method: 'POST',
                body: JSON.stringify({
                    database: this.dbSelected
                }),
                headers : this.headers
            }

            fetch(`${self.base_url}/getDBTables`, fetchData)
                .then(response => response.json())
                .then(data => (self.tables = data));

        },

        generateInsertCode() {
            this.generateInsertModel();
            this.generateInsertController();
            this.generateInsertFE();
        },

        // Messy Spacing? When generating code, it consumes it. It's important to have less usage of \t and \n
        generateInsertFE() {
            let fe = `<form method="POST" id="insert${this.tableSelected.charAt(0).toUpperCase() + this.tableSelected.slice(1)}">\n`;
            let columnsSelected = this.columns

            for(let i = 0; i < columnsSelected.length; i++) {
                fe += `\t<div class="form-group">
\t\t<label for="${columnsSelected[i]}">${columnsSelected[i]}</label>
\t\t<input type="text" class="form-control" id="${columnsSelected[i]}" name="${columnsSelected[i]}" placeholder="${columnsSelected[i]}">
\t</div>`
            }
            fe += `\n\n<button class="btn btn-success" type="button">Submit</button>`
            fe += `\n</form>\n\n`

            fe += `$('#insert${this.tableSelected.charAt(0).toUpperCase() + this.tableSelected.slice(1)}').submit(function(e){
    e.preventDefault();\n
    var form = $(this);\n
    var form_data = new FormData(form[0]);\n\n
    $.ajax({\n
            type:'POST',\n
            url: 'url',\n
            data: form_data,\n
            processData: false,\n
            contentType: false,\n
            beforeSend:function(data){\n
                $.LoadingOverlay("show");\n
                $(".btn-save").prop('disabled', true); \n
                $(".btn-save").text("Please wait...");\n
            },\n
            success:function(data){\n
                $.LoadingOverlay("hide");\n
                $(".btn-save").prop('disabled', false); \n
                if (data.success == 1) {\n
                    showCpToast("success", "Success!", data.message);\n
                    setTimeout(function() {
                         location.reload();
                    }, 3000)
                } else {\n
                    showCpToast("warning", "Warning!", data.message);\n
                }\n
            }\n
        });\n
    }`;

            this.insertFE = fe

        },
        generateInsertModel() {
            // let columnsInsert = this.insertColumnsSelected.join(', ')
            let columnsInsert = this.columns.join(', ');
            let columnsSelected = this.columns
            let bind_php = '';
            
            let param = ''
            for(let i = 0; i < columnsSelected.length; i++) {
               if (i < (columnsSelected.length - 1)) {
                    param += '?, '
                    bind_php += "$data['" + columnsSelected[i] + "'] ?? '',\n\t\t\t\t"
               } else {
                    param += '?'
                    bind_php += "$data['" + columnsSelected[i] + "'] ?? ''"
               }
            }

            let qry = `$sql = "INSERT INTO ${this.tableSelected} (${columnsInsert}) VALUES (${param})";`;
            let bind = `$bind_data = array(
                            ${bind_php}
                        );`;

            let completeCode = `
            public function insert_${this.tableSelected}($data) {
                ${qry} \n\n
                ${bind} \n\n
                $this->db->query($sql, $bind_data);
                return ($this->db->affected_rows() != 1) ? false : true;
            }
            `
            this.insertCodeModel = completeCode
        },

        generateInsertController() {
            // let columnsInsert = this.insertColumnsSelected.join(', ')
            let bind_php = '$data = [\n\t\t\t';
            // let columnsSelected = this.updateColumnsSelected
            let columnsSelected = this.columns

            for(let i = 0; i < columnsSelected.length; i++) {
                if (i < (columnsSelected.length - 1)) {
                    bind_php += "'" + columnsSelected[i] + "' => $this->input->post('" + columnsSelected[i] + "')  ?? '', \n\t\t\t"
                } else {
                    bind_php += "'" + columnsSelected[i] + "' => $this->input->post('" + columnsSelected[i] + "')  ?? '' \n\t\t\t];"
                }
            }

            let completeCode = `
                public function insert_${this.tableSelected}() {
                    ${bind_php} \n
                    return $this->model->insert_${this.tableSelected}($data);
                }
            `
            this.insertCodeController = completeCode
        },

        generateEditCode() {
            this.generateEditModel();
            this.generateEditController();
            this.generateEditFE();
        },

        generateEditModel() {
            this.generateSelectModel(true)
        },

        generateEditController() {
            this.generateSelectModel(true)
        },

        generateEditFE() {
            let fe = `<form method="POST" id="update${this.tableSelected.charAt(0).toUpperCase() + this.tableSelected.slice(1)}">\n`;
            let columnsSelected = this.columns

            for(let i = 0; i < columnsSelected.length; i++) {
                fe += `\t<div class="form-group">
\t\t<label for="${columnsSelected[i]}">${columnsSelected[i]}</label>
\t\t<input type="text" class="form-control"  id="${columnsSelected[i]}"name="${columnsSelected[i]}" value="<?= $${columnsSelected[i]} ?? '' ?>" placeholder="${columnsSelected[i]}">
\t</div>`
            }
            fe += `\n\n<button class="btn btn-success" type="button">Submit</button>`
            fe += `\n</form>\n`

            fe += `$('#update${this.tableSelected.charAt(0).toUpperCase() + this.tableSelected.slice(1)}').submit(function(e){
    e.preventDefault();\n
    var form = $(this);\n
    var form_data = new FormData(form[0]);\n\n
    $.ajax({\n
            type:'POST',\n
            url: 'url',\n
            data: form_data,\n
            processData: false,\n
            contentType: false,\n
            beforeSend:function(data){\n
                $.LoadingOverlay("show");\n
                $(".btn-save").prop('disabled', true); \n
                $(".btn-save").text("Please wait...");\n
            },\n
            success:function(data){\n
                $.LoadingOverlay("hide");\n
                $(".btn-save").prop('disabled', false); \n
                if (data.success == 1) {\n
                    showCpToast("success", "Success!", data.message);\n
                    setTimeout(function() {
                         location.reload();
                    }, 3000)
                } else {\n
                    showCpToast("warning", "Warning!", data.message);\n
                }\n
            }\n
        });\n
    }`;
            this.editFE = fe

        },

        generateUpdateCode() {
            this.generateUpdateModel();
            this.generateUpdateController();
        },

        generateUpdateModel() {
            if (this.pk == '') {
                alert('Primary key missing!');
                return;
            }
            let columnsUpdate = '';
            let bind_php = '';
            // let columnsSelected = this.updateColumnsSelected
            let columnsSelected = this.columns

            for(let i = 0; i < columnsSelected.length; i++) {
                if (i < (columnsSelected.length - 1)) {
                    columnsUpdate += columnsSelected[i] + '= ?, '
                    bind_php += "$data['" + columnsSelected[i] + "'] ?? '', \n\t\t\t\t"
                } else {
                    columnsUpdate += columnsSelected[i] + '= ? '
                    bind_php += "$data['" + columnsSelected[i] + "'] ?? ''"
                }
            }

            let qry = `$sql = "UPDATE ${this.tableSelected} SET ${columnsUpdate} WHERE ${this.pk} = ?";`;
            let bind = `$bind_data = array(
                            ${bind_php}
                        );`;

            let completeCode = `
                public function update_${this.tableSelected}($data) {
                    ${qry} \n\n
                    ${bind} \n\n
                    $this->db->query($sql, $bind_data);
                    return ($this->db->affected_rows() != 1) ? false : true;
                }
            `
            this.updateCodeModel = completeCode

        },

        generateUpdateController() {
            if (this.pk == '') {
                alert('Primary key missing!');
                return;
            }
            let bind_php = '$data = [\n\t\t\t';
            // let columnsSelected = this.updateColumnsSelected
            let columnsSelected = this.columns

            for(let i = 0; i < columnsSelected.length; i++) {
                if (i < (columnsSelected.length - 1)) {
                    bind_php += "'" + columnsSelected[i] + "' => $this->input->post('" + columnsSelected[i] + "')  ?? '', \n\t\t\t"
                } else {
                    bind_php += "'" + columnsSelected[i] + "' => $this->input->post('" + columnsSelected[i] + "')  ?? '' \n\t\t\t];"
                }
            }

            let completeCode = `
                public function update_${this.tableSelected}() {
                    ${bind_php} \n
                    return $this->model->update_${this.tableSelected}($data);
                }
            `
            this.updateCodeController = completeCode
        },

        generateDeleteCode() {
            this.generateDeleteModel()
            this.generateDeleteController()
            this.generateDeleteFE()
        },

        generateDeleteFE() {
            let fe = `
            <!-- Button trigger modal -->
    <button type="button" value="<?= $${this.pk}=>" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">
    Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="deleteConfirm" value="<?= $${this.pk}=>" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>\n\n`

    fe += `
        $('#click').on(deleteConfirm(e.currentTarget.value))\n
        function deleteConfirm(id) {
            $.ajax({
                method: "POST",
                data:  { id : id },
                url: base_url,
                beforeSend:function(data){\n
                    $.LoadingOverlay("show");\n
                    $(".btn-save").prop('disabled', true); \n
                    $(".btn-save").text("Please wait...");\n
                },\n
                success: function(data) {\n
                    $.LoadingOverlay("hide");\n
                    if(json_data.success){\n
                        $('#deleteModal').modal('hide');
                        showCpToast("success", "Deleted!", "${this.tableSelected} has been deleted!");
                        setTimeout(function(){location.reload()}, 2000);
                    } else{
                        showCpToast("warning", "Warning!", json_data.message);
                        $('#approveModal').modal('hide');
                    }
                }
            });
        }`;

        this.deleteFE = fe

        },

        generateDeleteModel() {
            if (this.pk == '') {
                alert('Primary key missing!');
                return;
            }

            let qry = `$sql = "DELETE FROM ${this.tableSelected} WHERE ${this.pk} = ?";`;
            let bind = `$bind_data = array(
                            $${this.pk}
                        );`;

            let completeCode = `
                public function delete_${this.tableSelected}($${this.pk}) {
                    ${qry} \n\n
                    ${bind} \n\n
                    return $this->db->query($sql, $bind_data);
                }
            `
            this.deleteCodeModel = completeCode
        },

        generateDeleteController() {
             let completeCode = `
                public function delete_${this.tableSelected}_details() {
                    $id = $this->input->post($${this.pk});
                    $data = $this->model->delete_${this.tableSelected}($id);
                    
                    return view('', ['data' => $data]);
                }
            `

            this.deleteCodeController = completeCode
        },

        generateSelectCode() {
            this.generateSelectModel();
            this.generateSelectController();
        },

        generateSelectModel(edit = false) {
            // let columnsSelected = this.selectColumnsSelected
            let columnsSelected = this.columns


            let qry = `$sql = "SELECT ${columnsSelected.join(', ')} FROM ${this.tableSelected} WHERE ${this.pk} = ?";`;
            let bind = `$bind_data = array(
                            $${this.pk}
                        );`;

            let completeCode = `
                public function get_${this.tableSelected}_details($${this.pk}) {
                    ${qry} \n\n
                    ${bind} \n\n
                    return $this->db->query($sql, $bind_data)->result_array();
                }
            `

            this.selectCodeModel = completeCode
            if (edit == true) {
                this.editCodeModel = completeCode
            }
        },

        generateSelectController(edit = false) {
            let completeCode = `
                public function get_${this.tableSelected}_details($${this.pk}) {
                    $data = $this->model->get_${this.tableSelected}($${this.pk});
                    
                    return view('views/${this.tableSelected}', ['data' => $data]);
                }
            `

            this.selectCodeController = completeCode

            if (edit === true)  this.editCodeController = completeCode
        }
    }
}
</script>

<style>

</style>