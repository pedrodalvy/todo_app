export default [
    {
        name: 'home',
        path: '/',
        components: require('./components/Home'),
        meta: {
            auth: true
        }
    },
    {
        name: 'login',
        path: '/login',
        components: require('./components/Login')
    },
    {
        path: '*',
        redirect: '/login'
    }
]