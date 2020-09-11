import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Boards from '../components/Boards.vue'
import Create from '../views/Create.vue'
import View from '../views/View.vue'
import Edit from '../views/Edit.vue'
import Delete from '../views/Delete.vue'
import Add from '../views/Add.vue'
import Remove from '../views/Remove.vue'

Vue.use(VueRouter)

  const routes = [
  
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/add',
    name: 'Add',
    component: Add
  },
  {
    path: '/remove',
    name: 'Remove',
    component: Remove
  },
  {
    path: '/createCampaign',
    name: 'Create',
    component: Create
  },
  {
    path: '/editCampaign',
    name: 'View',
    component: View
  },
  {
    path: '/editCampaignview',
    name: 'Edit',
    component: Edit
  },
  {
    path: '/deleteCampaign',
    name: 'Delete',
    component: Delete
  },
  {
    path: '/boards',
    name: 'Boards',
    component: Boards
  },
]

const router = new VueRouter({
  routes
})

export default router
