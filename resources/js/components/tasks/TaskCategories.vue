<template>
    <div class="card">
        <div class="card-body mb-4">
            <h5 class="card-title">Todas as Categorias</h5>

            <div v-if="showSpinner">
                <Spinner/>
            </div>
            <div v-else>
                <div class="list-group mb-4">

                    <a :key="taskCategory.id"
                       class="list-group-item list-group-item-action"
                       href="#" v-for="taskCategory in taskCategories">
                        {{taskCategory.name}}
                    </a>

                </div>

                <nav aria-label="Page navigation" class="mt-2">
                    <ul class="pagination">

                        <li class="page-item" v-if="page.links.prev">
                            <a @click="getCategories(page.links.prev); showSpinner = true"
                               class="page-link" href="javascript:void(0);">
                                <i aria-hidden="true" class="fa fa-angle-left mr-2"></i>
                                Página anterior
                            </a>
                        </li>
                        <li class="page-item" v-if="page.links.next">
                            <a @click="getCategories(page.links.next); showSpinner = true"
                               class="page-link" href="javascript:void(0);">
                                Próxima página
                                <i aria-hidden="true" class="fa fa-angle-right ml-2"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div v-if="!showForm">
                    <button @click="showForm = !showForm"
                            class="btn btn-primary float-right mb-4 mt-0">
                        <i class="fa fa-plus mr-2"></i>
                        <span>Criar Categoria</span>
                    </button>
                </div>

                <div v-if="showForm">
                    <FormTaskCategories
                            @createTaskCategory="createTaskCategory"
                            @hideForm="hideForm"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import CONFIG from '../../services/config';
    import helper from "../../services/helper";
    import Spinner from 'vue-simple-spinner'
    import FormTaskCategories from './FormTaskCategories'

    export default {
        name: "TaskCategories",
        components: {
            Spinner,
            FormTaskCategories,
        },
        data() {
            return {
                showSpinner: true,
                taskCategories: [],
                showForm: false,
                page: {},
            }
        },
        created() {
            const apiLink = `${CONFIG.API_URL}/v1/task_categories`;
            this.getCategories(apiLink);
        },
        methods: {
            getCategories(apiLink) {
                const header = helper.getHeader();

                axios.get(apiLink, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                        this.taskCategories = response.data.data;
                        this.page = {links: response.data.links, meta: response.data.meta};
                        this.showSpinner = false;
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
                    })
            },
            createTaskCategory(taskCategory) {
                this.showForm = false;
                const header = helper.getHeader();
                axios.post(`${CONFIG.API_URL}/v1/task_categories`, taskCategory, header)
                    .then(response => {
                        helper.setToken(response.headers.authorization);
                        this.taskCategories.push(response.data.data);
                    })
                    .catch(error => {
                        helper.setToken(error.response.headers.authorization);
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