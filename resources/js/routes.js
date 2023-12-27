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
import Attribute from './components/admin/attribute/Attribute'
import UpdateAttribute from './components/admin/attribute/UpdateAttribute'
import AddAttribute from './components/admin/attribute/AddAttribute'
import AttributeFamily from './components/admin/attribute_family/AttributeFamily'
import UpdateAttributeFamily from './components/admin/attribute_family/UpdateAttributeFamily'
import AddAttributeFamily from './components/admin/attribute_family/AddAttributeFamily'
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
    path: '/category/category', 
    name:'category',
    component: Category
  },
  { 
    path: '/category/edit_category/:id', 
    name:'edit_category',
    component: UpdateCategory
  },
  { 
    path: '/category/create_category', 
    name:'create_category',
    component: AddCategory
  },
  { 
    path: '/user/user', 
    name:'user',
    component: User
  },
  { 
    path: '/user/edit_user/:id', 
    name:'edit_user',
    component: UpdateUser
  },
  { 
    path: '/user/create_user', 
    name:'create_user',
    component: AddUser
  },
  { 
    path: '/product/product', 
    name:'product',
    component: Product
  },
   { 
    path: '/product/edit_product/:id', 
    name:'edit_product',
    component: UpdateProduct
  },
  { 
    path: '/product/create_product', 
    name:'create_product',
    component: AddProduct
  },
  { 
    path: '/attribute/attribute', 
    name:'attribute',
    component: Attribute
  },
   { 
    path: '/attribute/edit_attribute/:id', 
    name:'edit_attribute',
    component: UpdateAttribute
  },
  { 
    path: '/attribute/create_attribute', 
    name:'create_attribute',
    component: AddAttribute
  },
  { 
    path: '/attribute/attribute_family', 
    name:'attribute_family',
    component: AttributeFamily
  },
   { 
    path: '/attribute/edit_attribute_family/:id', 
    name:'edit_attribute_family',
    component: UpdateAttributeFamily
  },
  { 
    path: '/attribute/create_attribute_family', 
    name:'create_attribute_family',
    component: AddAttributeFamily
  },
   { 
    path: '/order/order', 
    name:'order',
    component: Order
  },
  { 
    path: '/order/order_details/:id', 
    name:'order_details',
    component: ViewOrder
  },
  { 
    path: '/order/order_invoice/:id', 
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