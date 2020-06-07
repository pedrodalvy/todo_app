<template>
    <div aria-hidden="true" aria-labelledby="modalLabel" class="modal fade" id="Taskmodal" ref="modal" role="dialog"
         tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Adicionar Nova Tarefa</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input class="form-control" id="description" type="text" v-model="task.description">
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="form-control" id="category" v-model="task.task_category_id">
                                <option v-for="taskCategory in taskCategories"
                                        :value="taskCategory.id" :key="taskCategory.id">{{taskCategory.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Data de Início</label>
                            <input class="form-control" id="start_date" type="datetime-local" v-model="task.start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Data de Conclusão</label>
                            <input class="form-control" id="end_date" type="datetime-local" v-model="task.end_date">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
                    <button @click="createTask" class="btn btn-primary" type="button">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let task = {
        task_category_id: '',
        description: '',
        end_date: '',
        start_date: '',
    };

    export default {
        name: "FormTask",
        props: ['taskCategories'],
        data() {
            return {
                task: {
                    task_category_id: '',
                    description: '',
                    end_date: '',
                    start_date: '',
                },
            }
        },
        mounted() {
            $(this.$refs.modal).on('hidden.bs.modal', () => {
                this.task = {
                    task_category_id: '',
                    description: '',
                    end_date: '',
                    start_date: '',
                };
            });
        },
        methods: {
            createTask() {
                this.$emit('createTask', this.task);
                $('#Taskmodal').modal('toggle');
            }
        }
    }
</script>

<style scoped>

</style>