<template>
    <div class="card">
        <div class="card-body mb-4">
            <div v-if="showSpinner">
                <Spinner/>
            </div>
            <div v-else>
                <h5 class="card-title">Listas de Tarefas: <span
                        class="font-weight-bold">{{ tasks[0].task_list.name }}</span></h5>

                <ul class="list-group">
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#Taskmodal">
                    Nova Tarefa
                </button>

                <FormTask />
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
            }
        },
        created() {
            const header = helper.getHeader();
            const taskListId = this.taskListId;

            axios.get(`${CONFIG.API_URL}/v1/tasks/by_task_list/${taskListId}`, header)
                .then(response => {
                    helper.setToken(response.headers.authorization);
                    console.log(response.data.data)
                    this.tasks = response.data.data;
                    this.showSpinner = false;
                })
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>