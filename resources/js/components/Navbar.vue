<template>
    <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm d-print-none">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: brandRouteName}">Lista de Tarefas</router-link>
            <button aria-controls="menu_navbar" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler"
                    data-target="#menu_navbar" data-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu_navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active" v-for="menu in menus">
                        <router-link class="nav-link" :to="{name: menu.routeName}">{{menu.name ? menu.name : ''}}</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item dropdown">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                           data-toggle="dropdown" href="#"
                           id="dropdown03">{{username}}</a>
                        <div aria-labelledby="dropdown03" class="dropdown-menu dropdown-menu-left">
                            <logout></logout>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import store from '../store/store';
    import Logout from './Logout';
    import authMixin from '../mixins/auth.mixin';

    export default {
        components: {
            'logout': Logout
        },
        mixins: [authMixin],
        data() {
            return {
                menus: [
                    {name: "Listas de Tarefas", routeName: 'home'},
                    {name: "Categorias", routeName: 'home'}
                ],
                brandRouteName: 'home'
            }
        },
        computed: {
            isAuth() {
                return store.state.auth.check;
            },
            user() {
                return store.state.auth.user;
            },
            username() {
                return this.isAuth ? store.state.auth.user.name : null;
            }
        }
    };
</script>