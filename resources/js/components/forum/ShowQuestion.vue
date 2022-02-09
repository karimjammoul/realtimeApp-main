<template>
  <v-card>
      <v-container fluid>
        <v-card-title>
            <div>
                <div class="headline">
                    {{data.title}}
                </div>
                <span class="grey--text">{{data.user}} Said {{data.created_at}}</span>
            </div>
            <v-spacer></v-spacer>
            <v-btn color="teal">{{data.reply_count}} Replies</v-btn>
        </v-card-title>
        
        <v-card-text v-html="data.body"></v-card-text>

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
              <v-icon>mdi-delete</v-icon>
            </v-btn>
        </v-card-actions>
      </v-container>
  </v-card>
</template>

<script>
export default {
    props: ['data'],
    watch: {
      data: {
        handler(val) {
          this.own = User.own(val.user_id)
        }
      }
    },
    data(){
      return {
        own : null,
      }
    },
    created() {
      EventBus.$on('newReply', () => {
        this.data.reply_count++
      })

      Echo.private('App.Models.User.' + User.id())
          .notification((notification) => {
              this.data.reply_count++
          });

      EventBus.$on('deleteReply', () => {
        this.data.reply_count--
      })

      Echo.channel('deleteReplyChannel')
          .listen('DeleteReplyEvent', (e) => {
            this.data.reply_count--
          })
    },
    methods: {
      destroy() {
        axios.delete(`/api/question/${this.data.slug}`)
        .then(res => this.$router.push('/forum'))
        .catch(error => console.log(error.response.data))
      },
      edit() {
        EventBus.$emit('startEditing')
      }
    }
}
</script>

<style>

</style>