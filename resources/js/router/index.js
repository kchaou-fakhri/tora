import VueRouter from 'vue-router'
import vue from 'vue'

import dashboard from './../components/Dashboard/test'
import categories from './../components/Category/Listcategories'
import listProducts from  './../components/Products/ListOfProducts'
import createProduct from './../components/Products/CreateProduct.vue'

vue.use(VueRouter)

const routes = [
    {
        path : '/test',
        component : dashboard
    },
    {
        path : '/category',
        component : categories
    },
    {
        path : '/products',
        component : listProducts

    },
    {
        path : '/createproduct',
        component : createProduct
        
    }
]


const router = new VueRouter({
    mode: 'hash',
    routes
})

export default router;