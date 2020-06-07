<template>
    <div class="card">

        <div class="card-body mb-4">
            <h5 class="card-title">Todas as Listas de Tarefas</h5>

            <div v-if="showSpinner">
                <Spinner/>
            </div>


            <div v-else>

                <div class="bg-light p-3" v-if="!taskLists[0]">
                    <h5 class="text-center mb-0">Nenhuma Lista Cadastrada</h5>
                </div>

                <div class="list-group mb-4">
                    <div class="card mb-1 shadow-sm rounded pointer"
                         @click="todoList(taskList.id)"
                         :key="taskList.id"
                         v-for="taskList in taskLists">
                        <div class="card-body p-3">
                            {{taskList.name}}
                        </div>
                    </div>

                    <nav aria-label="Page navigation" class="mt-2">
                        <ul class="pagination">
                            <li class="page-item" v-if="page.links.prev">
                                <a @click="getTaskLists(page.links.prev); showSpinner = true" class="page-link" href="javascript:void(0);">
                                    <i aria-hidden="true" class="fa fa-angle-left mr-2"></i>
                                    Página anterior
                                </a>
                            </li>
                            <li class="page-item" v-if="page.links.next">
                                <a @click="getTaskLists(page.links.next); showSpinner = true" class="page-link" href="javascript:void(0);">
                                    Próxima página
                                    <i aria-hidden="true" class="fa fa-angle-right ml-2"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
    </div>
</template>

<script>
    import axios from 'axios';
    import CONFIG from '../services/config';
    import helper from "../services/helper";
    import FormTaskList from "./tasks/FormTaskList";
    import Spinner from 'vue-simple-spinner'

    export default {
        name: "Home",
        data() {
            return {
                taskLists: [],
                showForm: false,
                taskList: null,
                showSpinner: true,
                page: {},
            }
        },
        components: {
            FormTaskList,
            Spinner,
        },
        created() {
            const apiLink = `${CONFIG.API_URL}/v1/task_lists`;
            this.getTaskLists(apiLink);
        },
        methods: {
            getTaskLists(apiLink) {
                const header = helper.getHeader();
                axios.get(apiLink, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                        this.taskLists = response.data.data;
                        this.page = {links: response.data.links, meta: response.data.meta};

                        this.showSpinner = false;
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            },
            createTaskList(taskList) {
                this.showForm = false;
                const header = helper.getHeader();
                axios.post(`${CONFIG.API_URL}/v1/task_lists`, taskList, header)
                    .then(response => {
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
                this.$router.push({name: 'todo', params: {task_list: key}})
            }

        }
    }
</script>

<style scoped>

</style>