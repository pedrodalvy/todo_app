<template>
    <div class="card">
        <div class="card-body mb-4">
            <h5 class="card-title">Todas as Categorias</h5>

            <Spinner v-if="showSpinner" />

            <div class="list-group mb-4">

                <a class="list-group-item list-group-item-action"
                   href="#" v-for="taskCategory in taskCategories" :key="taskCategory.id">
                    {{taskCategory.name}}
                </a>

            </div>

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
            }
        },
        created() {
            const header = helper.getHeader();

            axios.get(`${CONFIG.API_URL}/v1/task_categories`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);
                    this.taskCategories = response.data.data;
                    this.showSpinner = false;
                })
        },
        methods: {
            createTaskCategory(taskCategory) {
                this.showForm = false;
                const header = helper.getHeader();
                axios.post(`${CONFIG.API_URL}/v1/task_categories`, taskCategory, header)
                    .then( response => {
                        helper.setToken(response.headers.authorization);
                        this.taskCategories.push(response.data.data);
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