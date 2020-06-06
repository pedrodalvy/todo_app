import localStorage from "./localstorage";

export default {
    setToken(authorization = null) {
        if (authorization) {
            let token = authorization.split(' ')[1];
            localStorage.set('token', token);
        }
    },
    getHeader() {
        return { headers : { 'Authorization': 'Bearer ' + localStorage.get('token') }};
    }
}