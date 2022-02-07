<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                v-bind="attrs"
                v-on="on">
                    <v-icon>mdi-bell</v-icon>
                    <v-badge color="red" v-if="unreadCount > 0">
                    {{unreadCount}}
                    </v-badge>
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="item in unread" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-item-title @click="readNotification(item)">{{item.question}}</v-list-item-title>
                    </router-link>
                </v-list-item>
                <v-divider></v-divider>

                <v-list-item v-for="item in read" :key="item.id">
                    <v-list-item-title>{{item.question}}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
export default {
    data() {
        return {
            read: {},
            unread: {},
            unreadCount: 0,
        }
    },
    created() {
        if(User.loggedIn()) {
            this.getNotifications()
        }

        Echo.private('App.Models.User.' + User.id())
          .notification((notification) => {
              this.unread.unshift(notification)
              this.unreadCount++
          });
    },
    methods: {
        getNotifications() {
            axios.post('/api/notifications')
            .then(response => {
                this.read = response.data.read
                this.unread = response.data.unread
                this.unreadCount = response.data.unread.length
            })
            .catch(error => {
                console.log(error)
            })
        },
        readNotification(notification) {
            axios.post('/api/markAsRead', {
                id: notification.id
            })
            .then(response => {
                this.unread.splice(notification, 1)
                this.read.push(notification)
                this.unreadCount--
            })
        }
    },
}
</script>

<style>

</style>