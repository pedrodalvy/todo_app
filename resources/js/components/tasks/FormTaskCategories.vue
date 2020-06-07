<template>
    <form @submit.prevent="addTaskCategory"
          class="form-inline mx-md-4 mb-4 p-0" id="form_new_task">

        <div class="row align-middle">
            <div class="form-group  px-md-0">
                <input class="form-control mb-1 mr-md-2"
                       id="name" placeholder="Nova Categoria"
                       type="text" v-model="taskCategory.name">

                <div>
                    <v-swatches v-model="color"
                                shapes="circles"
                                trigger-size="33"
                                :trigger-style="{ width: '35px', height: '35px' }">

                    </v-swatches>
                </div>
            </div>
            <div class="">
                <button class="btn btn-primary mx-md-2" type="submit">Adicionar</button>

                <button @click="hideForm"
                        class="btn btn-danger mx-2">
                    Cancelar
                </button>
            </div>

        </div>

    </form>
</template>

<script>
    import VSwatches from 'vue-swatches'
    import 'vue-swatches/dist/vue-swatches.css'

    export default {
        name: "FormTaskCategories",
        components: {VSwatches},
        data() {
            return {
                taskCategory: { name: '', color: '' },
                showForm: true,
                color: '#1CA085',
            }
        },
        methods: {
            addTaskCategory() {
                this.taskCategory.color = this.color;
                this.$emit('createTaskCategory', this.taskCategory);

                this.taskCategory = { name: '' };
                this.color = '#1CA085';
            },
            hideForm() {
                this.$emit('hideForm', !this.showForm);
            }
        },
    }

</script>

<style scoped>

</style>