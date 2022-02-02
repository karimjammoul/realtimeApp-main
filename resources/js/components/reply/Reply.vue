<template>
  <div class="mt-4">
      <v-card>
          <v-card-title>
              <div class="headline">{{data.user}}</div>
              <div class="ml-2">Said {{data.created_at}}</div>
          </v-card-title>
          <v-divider></v-divider>

          <edit-reply 
          v-if="editing"
          :reply=data
          ></edit-reply>

          <v-card-text v-else v-html="data.reply"></v-card-text>

          <v-divider></v-divider>

          <div v-if="!editing">
            <v-card-actions v-if="own">
                <v-btn
                    color="primary"
                    fab
                    small
                    dark
                    @click="edit"
                >
                    <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn
                    color="error"
                    fab
                    small
                    dark
                    @click="destroy"
                >
                    <v-icon>mdi-cancel</v-icon>
                </v-btn>
            </v-card-actions>
          </div>

      </v-card>
  </div>
</template>

<script>
import EditReply from './EditReply.vue'
export default {
    props: ['data', 'index'],
    components: {EditReply},
    data() {
        return {
            editing: false
        }
    },
    computed: {
        own() {
            return User.own(this.data.user_id)
        },
        reply() {
            return this.data.reply
        }
    },
    created() {
        this.listen()
    },
    methods: {
        destroy() {
            EventBus.$emit('deleteReply', this.index)
        },
        edit() {
            this.editing = true
        },
        listen() {
            EventBus.$on('cancelEditing', () => {
                this.editing = false
            })
        }
    }
}
</script>

<style>

</style>