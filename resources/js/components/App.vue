<template>
    <div>
        <template v-if="isAuth">
            <navbar class="mb-2"></navbar>
        </template>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar from './Navbar';
    import authMixin from '../mixins/auth.mixin';

    export default {
        mixins: [authMixin],
        components: {
            'navbar': Navbar,
        }
    }
</script>

<style scoped>

</style>