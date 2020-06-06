export default [
    {
        name: 'home',
        path: '/',
        components: require('./components/Home')
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