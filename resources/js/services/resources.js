import 'vue-resource';
import CONFIG from './config';
import Vue from 'vue';
import JwtToken from './jwt-token.js';

Vue.http.options.root = CONFIG.API_URL;
Vue.http.interceptors.push((request, next) => {
    if (JwtToken.token) {
        request.headers.set('Authorization', JwtToken.getAuthorizationHeader());
    }
    next();
});

export class Jwt {
    static accessToken(username, password) {
        return Vue.http.post('auth/login', {username, password});
    }

    static logout() {
        return Vue.http.post('auth/logout');
    }
}