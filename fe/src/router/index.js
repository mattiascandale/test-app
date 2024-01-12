import { createRouter, createWebHistory } from 'vue-router'
import PeopleView from '../views/People/View.vue'
import PeopleNew from '../views/People/New.vue'
import PeopleEdit from '../views/People/Edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/people',
    },
    {
      path: '/people',
      name: 'people',
      component: PeopleView
    },
    {
      path: '/people/new',
      name: 'peopleNew',
      component: PeopleNew
    },
    {
      path: '/people/:id/edit',
      name: 'peopleEdit',
      component: PeopleEdit
    }

  ]
})

export default router
