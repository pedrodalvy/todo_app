<template>
    <div class="card">

        <div class="card-body mb-4">
            <h5 class="card-title">Todas as Listas de Tarefas</h5>

            <Spinner v-if="showSpinner" />
            <div class="list-group mb-4">
                <a class="list-group-item list-group-item-action"
                   href="javascript:void(0);" v-for="taskList in taskLists" :key="taskList.id" @click="todoList(taskList.id)">
                    {{taskList.name}}
                </a>
            </div>

            <div v-if="!showForm">
                <button @click="showForm = !showForm"
                        class="btn btn-primary float-right mb-4 mt-0">
                    <i class="fa fa-plus mr-2"></i>
                    <span>Criar Lista</span>
                </button>
            </div>

            <div v-if="showForm">
                <FormTaskList
                        @createTaskList="createTaskList"
                        @hideForm="hideForm"/>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import CONFIG from '../services/config';
    import helper from "../services/helper";
    import FormTaskList from "./tasks/FormTaskList";
    import Spinner from 'vue-simple-spinner'
    import router from 'vue-router';

    export default {
        name: "Home",
        data() {
            return {
                taskLists: [],
                showForm: false,
                taskList: null,
                showSpinner: true,
            }
        },
        components: {
            FormTaskList,
            Spinner,
        },
        created() {
            const header = helper.getHeader();

            axios.get(`${CONFIG.API_URL}/v1/task_lists`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);
                    this.taskLists = response.data.data;
                    this.showSpinner = false;
                })
                .catch(error => {
                    helper.setToken(error.response.headers.authorization);
                })
        },
        methods: {
            createTaskList(taskList) {
                this.showForm = false;
                const header = helper.getHeader();
                axios.post(`${CONFIG.API_URL}/v1/task_lists`, taskList, header)
                    .then( response => {
                        helper.setToken(response.headers.authorization);
                        this.taskLists.push(response.data.data);
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            },
            hideForm(showForm) {
                this.showForm = showForm;
            },
            todoList(key) {
                this.$router.push({ name: 'todo', params: {task_list: key} })
            }

        }
    }
</script>

<style scoped>

</style>