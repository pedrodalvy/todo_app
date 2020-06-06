<template>
    <div class="card">
        <div class="card-body mb-4">
            <h5 class="card-title">Todas as Listas de Tarefas</h5>

            <div class="list-group">
                <a :key="taskList.id" class="list-group-item list-group-item-action"
                   href="#" v-for="taskList in taskLists">
                    {{taskList.name}}
                </a>
            </div>
        </div>

        <div class="mx-4" v-if="!showForm">
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
</template>

<script>
    import axios from 'axios';
    import CONFIG from '../services/config';
    import helper from "../services/helper";
    import FormTaskList from "./tasks/FormTaskList";

    export default {
        name: "Home",
        data() {
            return {
                taskLists: [],
                showForm: false,
                taskList: null,
            }
        },
        components: {
            'FormTaskList': FormTaskList
        },
        created() {
            const header = helper.getHeader();

            axios.get(`${CONFIG.API_URL}/v1/task_lists`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);
                    this.taskLists = response.data.data;
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
            },
            hideForm(showForm) {
                this.showForm = showForm;
            }

        }
    }
</script>

<style scoped>

</style>