<template>
    <div class="card">
        <div class="card-body mb-4">
            <div v-if="showSpinner">
                <Spinner/>
            </div>
            <div v-else>
                <h5 class="card-title">Listas de Tarefas:
                    <span class="font-weight-bold">
                        {{taskListName}}
                    </span>
                </h5>

                <ul class="list-group">
                    <li :key="task.id" class="list-group-item" v-for="task in tasks">{{task.description}}</li>
                </ul>

                <!-- Button trigger modal -->
                <button class="btn btn-primary mt-4" data-target="#Taskmodal" data-toggle="modal" type="button">
                    Nova Tarefa
                </button>

                <FormTask @createTask="createTask"
                          :taskCategories="taskCategories"/>
            </div>

        </div>
    </div>

</template>

<script>
    import axios from 'axios';
    import CONFIG from './../../services/config';
    import helper from "./../../services/helper";
    import Spinner from 'vue-simple-spinner';
    import FormTask from "./FormTask";

    export default {
        name: "TodoList",
        components: {
            Spinner,
            FormTask
        },
        data() {
            return {
                showSpinner: true,
                taskListId: this.$route.params.task_list,
                tasks: [],
                taskListName: '',
                taskCategories: [],
            }
        },
        created() {
            const header = helper.getHeader();
            const taskListId = this.taskListId;
            const getTaskListData = this.getTaskListData;

            axios.get(`${CONFIG.API_URL}/v1/tasks/by_task_list/${taskListId}`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);
                    console.log(response.data.data);
                    this.tasks = response.data.data;

                    if (!this.tasks[0]) {
                        getTaskListData()
                    } else {
                        this.taskListName = this.tasks[0].task_list.name
                    }
                })
                .catch(error => {
                    this.showSpinner = false;
                    helper.setToken(error.response.headers.authorization);
                });

            axios.get(`${CONFIG.API_URL}/v1/task_categories`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);
                    this.taskCategories = response.data.data;
                    this.showSpinner = false;
                })
                .catch(error => {
                    this.showSpinner = false;
                    helper.setToken(error.response.headers.authorization);
                });
        },
        methods: {
            createTask(task) {
                const header = helper.getHeader();
                task.task_list_id = this.taskListId;

                axios.post(`${CONFIG.API_URL}/v1/tasks`, task, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                        this.tasks.push(response.data.data);
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            },
            getTaskListData() {
                const header = helper.getHeader();
                const taskListId = this.taskListId;

                axios.get(`${CONFIG.API_URL}/v1/task_lists/${taskListId}`, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                        this.taskListName = response.data.data.name;
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            }
        }
    }
</script>

<style scoped>

</style>