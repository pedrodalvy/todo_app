import {Jwt} from './resources';
import localStorage from "./localstorage";

const payloadToObject = token => {
    let payload = token.split('.')[1];
    return JSON.parse(atob(payload));
};

export default {
    get token() {
        return localStorage.get('token');
    },
    set token(value) {
        value
            ? localStorage.set('token', value)
            : localStorage.remove('token');
    },
    get payload() {
        return this.token != null ? payloadToObject(this.token) : null;
    },
    accessToken(username, password) {
        return Jwt.accessToken(username, password)
            .then(response => {
                this.token = response.data.token;
            });
    },
    revokeToken() {
        let afterRevokeToken = () => this.token = null;

        return Jwt.logout()
            .then(afterRevokeToken)
            .catch(afterRevokeToken);
    },
    getAuthorizationHeader() {
        return `Bearer ${localStorage.get('token')}`;
    }
};