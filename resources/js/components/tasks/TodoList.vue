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

                <div class="bg-light p-3" v-if="!tasks[0]">
                    <h5 class="text-center mb-0">Nenhuma Tarefa Cadastrada</h5>
                </div>
                <div v-else-if="taskCategories[0]">
                    <p>Categorias:
                        <span class="badge badge-primary mr-1"
                              v-for="taskCategory in taskCategories"
                                :style="{'background-color': taskCategory.color}">
                            <small>{{taskCategory.name}}</small>
                        </span>
                    </p>
                </div>


                <div :key="task.id"
                     :style="{'border-left-color': task.category.color}"
                     class="card mb-1 border-6px shadow-sm rounded"
                     v-for="task in tasks">
                    <div :class="[task.completed ? 'taskCompleted bg-light' : '']"
                         class="card-body p-1">
                        <table class="table table-borderless p-0 m-0 table-responsive-sm">
                            <tbody>
                            <tr class="d-flex">
                                <td class="text-left col-md-5">
                                    <div class="custom-control custom-checkbox">
                                        <input :checked="task.completed" :id="`check-${task.id}`"
                                               :value="task.id"
                                               @click="checkTask({task})"
                                               class="custom-control-input"
                                               type="checkbox">

                                        <label :for="`check-${task.id}`"
                                               class="custom-control-label">
                                            {{task.description}}
                                        </label>
                                    </div>
                                </td>
                                <td class="text-left col-3 d-none d-md-block ">
                                    <small v-show="task.start_date">
                                        Previsão de Início:{{moment(task.start_date).format('DD/MM/YYYY [as] HH:mm')}}
                                    </small>
                                </td>
                                <td class="text-left col-3 d-none d-md-block">
                                    <small v-show="task.end_date">
                                        Previsão de Conclusão: {{moment(task.end_date).format('DD/MM/YYYY [as] HH:mm')}}
                                    </small>
                                </td>
                                <td class=" align-items-end col-md-1 text-right">
                                    <button class="btn btn-danger" type="button" @click="deleteTask(task.id)">
                                        <i aria-hidden="true" class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button class="btn btn-primary mt-4" data-target="#Taskmodal" data-toggle="modal" type="button">
                    Nova Tarefa
                </button>

                <FormTask :taskCategories="taskCategories"
                          @createTask="createTask"/>


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
    import moment from 'moment';


    export default {
        name: "TodoList",
        components: {
            Spinner,
            FormTask,
        },
        data() {
            return {
                showSpinner: true,
                taskListId: this.$route.params.task_list,
                tasks: [],
                taskListName: '',
                taskCategories: [],
                moment: moment,
                showFormEdit: false,
            }
        },
        created() {
            const header = helper.getHeader();
            const taskListId = this.taskListId;
            const getTaskListData = this.getTaskListData;

            axios.get(`${CONFIG.API_URL}/v1/tasks/by_task_list/${taskListId}`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);

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
            },
            checkTask(task) {
                task = task.task;
                task.completed = !task.completed;

                this.updateTask(task)
            },
            updateTask(task) {
                task.task_category_id = task.category.id;
                task.task_list_id = task.task_list.id;

                const header = helper.getHeader();

                axios.put(`${CONFIG.API_URL}/v1/tasks/${task.id}`, task, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            },
            deleteTask(taskId) {
                const header = helper.getHeader();

                axios.delete(`${CONFIG.API_URL}/v1/tasks/${taskId}`, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                        this.tasks.splice(this.tasks.findIndex(element => element.id === taskId),1);
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            },
        }
    }
</script>

<style scoped>
    .taskCompleted,
    .taskCompleted label {
        text-decoration: line-through;
    }
</style>