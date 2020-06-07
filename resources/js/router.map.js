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
        name: 'categories',
        path: '/task_categories',
        components: require('./components/tasks/TaskCategories'),
        meta: {
            auth: true
        }
    },
    {
        name: 'todo',
        path: '/todo_list/:task_list',
        components: require('./components/tasks/TodoList'),
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
        redirect: '/'
    }
]