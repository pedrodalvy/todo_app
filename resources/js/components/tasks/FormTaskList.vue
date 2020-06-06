<template>
    <form @submit.prevent="addTaskList" class="form-inline mx-md-4 mb-4 p-0" id="form_new_task">
        <div class="row">
            <div class="form-group col-md-6 px-md-0">
                <input class="form-control"
                       id="name" placeholder="Nova Lista de Tarefas"
                       type="text" v-model="taskList.name">
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary mx-md-2" type="submit">Adicionar</button>

                <button @click="hideForm"
                        class="btn btn-danger mx-2">
                    Cancelar
                </button>
            </div>

        </div>
    </form>
</template>

<script>
    export default {
        name: "FormTaskList",
        data() {
            return {
                taskList: { name: '' },
                showForm: true
            }
        },
        methods: {
            addTaskList() {
                this.$emit('createTaskList', this.taskList);
                this.taskList = { name: '' };
            },
            hideForm() {
                this.$emit('hideForm', !this.showForm);
            }
        },
    }

</script>

<style scoped>
.row, .row input {
    width: 100%;
}
</style>