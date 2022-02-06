<template>
  <div>
    <v-toolbar dark prominent src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">
    
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Vuetify</v-toolbar-title>
      <v-spacer></v-spacer>

      <app-notification v-if="loggedIn"></app-notification>

      <div class="hidden-sm-and-down">

        <router-link
         v-for="item in items"
         :key="item.title"
         :to="item.to"
         v-if="item.show">
          <v-btn text>{{ item.title }}</v-btn>
        </router-link>
      </div>

      <v-btn icon>
        <v-icon>mdi-export</v-icon>
      </v-btn>

    </v-toolbar>
  </div>
</template>

<script>
import AppNotification from './AppNotification.vue'
export default {
  components: {
    AppNotification
  },
  data() {
    return {
      loggedIn: User.loggedIn(),
      items: [
        { title : 'Forum', to:'/forum', show: true },
        { title : 'Ask Question', to:'/ask', show: User.loggedIn() },
        { title : 'Category', to:'/category', show: User.admin() },
        { title : 'Login', to:'/login', show: !User.loggedIn() },
        { title : 'Logout', to:'/logout', show: User.loggedIn() },
      ]
    }
  },

  created() {
    EventBus.$on('logout', () => {
      User.logout()
    })
  }
}
</script>

<style>

</style>