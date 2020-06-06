import 'vue-resource';
import CONFIG from './config';
import Vue from 'vue';
import JwtToken from './jwt-token.js';
import store from '../store/store';
import router from '../router';

Vue.http.options.root = CONFIG.API_URL;

Vue.http.interceptors.push((request, next) => {
    if (JwtToken.token) {
        request.headers.set('Authorization', JwtToken.getAuthorizationHeader());
    }
    next();
});

Vue.http.interceptors.push((request, next) => {
    next( response => {
        let authorization = response.headers.get('Authorization');
        if (authorization) {
            JwtToken.token = authorization.split(' ')[1];
        }
        switch (response.status) {
            case 401:
                JwtToken.token = null;
                store.commit('auth/unauthenticated');
                return router.push('login');
        }
    })
});

export class Jwt {
    static accessToken(username, password) {
        return Vue.http.post('auth/login', {username, password});
    }

    static logout() {
        return Vue.http.post('auth/logout');
    }
}