<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                v-bind="attrs"
                v-on="on">
                    <v-icon>mdi-bell</v-icon>
                    <v-badge color="red">
                    {{unreadCount}}
                    </v-badge>
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="item in unread" :key="item.id">
                    <v-list-item-title>{{item.data.question}}</v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>

                <v-list-item v-for="item in read" :key="item.id">
                    <v-list-item-title>{{item.data.question}}</v-list-item-title>
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
    },
    methods: {
        getNotifications() {
            axios.post('/api/notifications')
            .then(response => {
                console.log(response.data)
                this.read = response.data.read
                this.unread = response.data.unread
                this.unreadCount = response.data.unread.length
            })
            .catch(error => {
                console.log(error)
            })
        }
    },
}
</script>

<style>

</style>