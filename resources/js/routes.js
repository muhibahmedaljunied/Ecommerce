import Dashboard from './components/Dashboard'
import Categories from './components/admin/Categories'
import UpdateCategory from './components/admin/category/UpdateCategory'
// import AddCategory from './components/admin/category/AddCategory'
import User from './components/admin/user/User'
import UpdateUser from './components/admin/user/UpdateUser'
import AddUser from './components/admin/user/AddUser'
import Products from './components/admin/Products'
import UpdateProduct from './components/admin/product/UpdateProduct'
// import AddProduct from './components/admin/product/AddProduct'
import Attributes from './components/admin/Attributes'
import UpdateAttribute from './components/admin/attribute/UpdateAttribute'
// import AddAttribute from './components/admin/attribute/AddAttribute'
import AttributeFamilies from './components/admin/AttributeFamilies'
import UpdateAttributeFamily from './components/admin/attribute_family/UpdateAttributeFamily'
// import AddAttributeFamily from './components/admin/attribute_family/AddAttributeFamily'
import Order from './components/admin/order/Order'
import ViewOrder from './components/admin/order/ViewOrder'
import OrderInvoice from './components/admin/order/OrderInvoice'
import StockManagement from './components/admin/StockManagement'
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
// -------------------------------Api-----------------------------------------
import LoginApi from './components/api/Login'
import RegisterApi from './components/api/Register'
import ListApi from './components/api/ListApi'

// -------------------------------------------------------------------
 const routes = [
  {
    path: '/api/login',
    component: LoginApi
  },
  {
    path: '/api/register',
    component: RegisterApi
  },

  {
    path: '/api/listApi',
    component: ListApi
  },

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
    component: Categories
  },
  {
    path: '/edit_category/:id',
    name:'edit_category',
    props: true,
    component: UpdateCategory
  },
  // {
  //   path: '/create_category',
  //   name:'create_category',
  //   component: AddCategory
  // },
  {
    path: '/user',
    name:'user',
    component: User
  },
  {
    path: '/edit_user/:id',
    name:'edit_user',
    props: true,
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
    component: Products
  },
   {
    path: '/edit_product/:id',
    name:'edit_product',
    props: true,
    component: UpdateProduct
  },
  {
    path: '/stocks',
    name: 'stocks',
    component: StockManagement
  },
  // {
  //   path: '/create_product',
  //   name:'create_product',
  //   component: AddProduct
  // },
  {
    path: '/attribute',
    name:'attribute',
    component: Attributes
  },
   {
    path: '/edit_attribute/:id',
    name:'edit_attribute',
    props: true,
    component: UpdateAttribute
  },
  // {
  //   path: '/create_attribute',
  //   name:'create_attribute',
  //   component: AddAttribute
  // },
  {
    path: '/attribute_family',
    name:'attribute_family',
    component: AttributeFamilies
  },
   {
    path: '/edit_attribute_family/:id',
    name:'edit_attribute_family',
    props: true,
    component: UpdateAttributeFamily
  },
  // {
  //   path: '/create_attribute_family',
  //   name:'create_attribute_family',
  //   component: AddAttributeFamily
  // },
   {
    path: '/order',
    name:'order',
    component: Order
  },
  {
    path: '/order_details/:id',
    name:'order_details',
    component: ViewOrder
  },
  {
    path: '/order_invoice/:id',
    component: OrderInvoice
  },
  {
    path: '/stocks',
    name: 'stocks',
    component: StockManagement
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
    name:'CustomerCategory',
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
