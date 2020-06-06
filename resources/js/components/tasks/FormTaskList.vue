<template>
    <form @submit.prevent="addTaskList" class="form-inline mx-4 mb-4" id="form_new_task">
        <div class="form-group col-md-6 px-0">
            <input class="form-control"
                   id="name" placeholder="Nova Lista de Tarefas"
                   type="text" v-model="taskList.name">
        </div>
        <button class="btn btn-primary mx-2" type="submit">Adicionar</button>

        <button @click="hideForm"
                class="btn btn-danger mx-2">
            Cancelar
        </button>
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
    #name {
        width: 100%;
    }

    #form_new_task {
        width: 100%;
    }
</style>