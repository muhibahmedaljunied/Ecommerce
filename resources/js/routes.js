import Dashboard from './components/Dashboard'
import Category from './components/admin/category/Category'
import UpdateCategory from './components/admin/category/UpdateCategory'
import AddCategory from './components/admin/category/AddCategory'
import User from './components/admin/user/User'
import UpdateUser from './components/admin/user/UpdateUser'
import AddUser from './components/admin/user/AddUser'
import Product from './components/admin/product/Product'
import UpdateProduct from './components/admin/product/UpdateProduct'
import AddProduct from './components/admin/product/AddProduct'
import Country from './components/admin/country/Country'
import UpdateCountry from './components/admin/country/UpdateCountry'
import AddCountry from './components/admin/country/AddCountry'
import Size from './components/admin/size/Size'
import UpdateSize from './components/admin/size/UpdateSize'
import AddSize from './components/admin/size/AddSize'
import Order from './components/admin/order/Order'
import ViewOrder from './components/admin/order/ViewOrder'
import OrderInvoice from './components/admin/order/OrderInvoice'
// ----------------------------------customer---------------------------
import Login from './components/customer/Login'
import Register from './components/customer/Register'
import Home from './components/customer/layouts/Home'
import CategoryCustomer from './components/customer/CategoryCustomer'
import SingleProduct from './components/customer/SingleProduct'
import Cart from './components/customer/Cart'
import Shipping from './components/customer/Shipping'
import Shipping2 from './components/customer/Shipping2'

import Payment from './components/customer/Payment'

// -------------------------------------------------------------------
 const routes = [
  { 
    path: '/', 
    component: Dashboard
  },
  { 
    path: '/dashboard', 
    component: Dashboard
  },
   { 
    path: '/customer/home', 
    component: Home
  },
  { 
    path: '/category', 
    name:'category',
    component: Category
  },
  { 
    path: '/edit_category/:id', 
    name:'edit_category',
    component: UpdateCategory
  },
  { 
    path: '/create_category', 
    name:'create_category',
    component: AddCategory
  },
  { 
    path: '/user', 
    name:'user',
    component: User
  },
  { 
    path: '/edit_user/:id', 
    name:'edit_user',
    component: UpdateUser
  },
  { 
    path: '/create_user', 
    name:'create_user',
    component: AddUser
  },
  { 
    path: '/product', 
    name:'product',
    component: Product
  },
   { 
    path: '/edit_product/:id', 
    name:'edit_product',
    component: UpdateProduct
  },
  { 
    path: '/create_product', 
    name:'create_product',
    component: AddProduct
  },
  { 
    path: '/country', 
    name:'country',
    component: Country
  },
   { 
    path: '/edit_country/:id', 
    name:'edit_country',
    component: UpdateCountry
  },
  { 
    path: '/create_country', 
    name:'create_country',
    component: AddCountry
  },
  { 
    path: '/size', 
    name:'size',
    component: Size
  },
   { 
    path: '/edit_size/:id', 
    name:'edit_size',
    component: UpdateSize
  },
  { 
    path: '/create_size', 
    name:'create_size',
    component: AddSize
  },
   { 
    path: '/order', 
    name:'order',
    component: Order
  },
  { 
    path: '/order_details/:id', 
    component: ViewOrder
  },
  { 
    path: '/order_invoice/:id', 
    component: OrderInvoice
  },
  // --------------------------------------customer----------------------
  { 
    path: '/customer/login', 
    component: Login
  },
  { 
    path: '/customer/register', 
    component: Register
  },
 { 
    path: '/customer/category/:id', 
    component: CategoryCustomer
  },
  { 
    path: '/customer/single-product/:id', 
    component: SingleProduct
  },
  { 
    path: '/customer/cart', 
    component: Cart
  },
  { 
    path: '/customer/shipping', 
    component: Shipping
  },
  { 
    path: '/customer/shipping2', 
    component: Shipping2
  },
  { 
    path: '/customer/payment', 
    component: Payment
  },
  { 
    path: '/customer/payment/:message', 
    component: Payment
  },
]

export default routes;