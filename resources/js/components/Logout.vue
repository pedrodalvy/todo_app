<template>
    <a @click.prevent="logout()" class="dropdown-item" href="#">Logout</a>
</template>

<script>
    import store from '../store/store';
    import router from '../router';

    export default {
        name: "Logout",
        methods: {
            logout() {
                let goToLogin = () => router.push({name: 'login'});
                store.dispatch('auth/logout')
                    .then(goToLogin)
                    .catch(goToLogin);
            }
        }
    }
</script>