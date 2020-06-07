<template>
    <div ref="modal" class="modal fade" id="Taskmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Adicionar Nova Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" id="description" v-model="task.description">
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="form-control" id="category" v-model="task.task_category_id">
                                <option>Selcione uma categoria</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Data de Início</label>
                            <input class="form-control"  type="datetime-local" id="start_date" v-model="task.start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Data de Conclusão</label>
                            <input class="form-control"  type="datetime-local" id="end_date" v-model="task.end_date">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="createTask">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FormTask",
        data() {
            return {
                task: {
                    task_category_id: '',
                    description: '',
                    end_date: '',
                    start_date: '',
                    task_list_id: '',
                },
            }
        },
        mounted(){
            $(this.$refs.modal).on('hidden.bs.modal', () => {
                console.log('ok');
            })
        },
        methods: {
            createTask() {
                console.log(this.task);
            }
        }
    }
</script>

<style scoped>

</style>