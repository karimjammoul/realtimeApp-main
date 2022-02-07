<template>
  <div>
      <reply 
      v-for="(reply, index) in question.replies" 
      :key="reply.id"
      :index=index
      :data="reply"
      ></reply>
  </div>
</template>

<script>
import Reply from './Reply.vue'
export default {
    props: ['question'],
    components: {Reply},
    created() {
      this.listen()
    },
    methods: {
      listen() {
        EventBus.$on('newReply', (reply) => {
          this.question.replies.unshift(reply)
        })

        EventBus.$on('deleteReply', (index) => {
          axios.delete(`/api/question/${this.question.slug}/reply/${this.question.replies[index].id}`)
          .then(res => {
            this.question.replies.splice(index, 1)
          })
        })

        Echo.private('App.Models.User.' + User.id())
          .notification((notification) => {
              this.question.replies.unshift(notification.reply)
          });

        Echo.channel('deleteReplyChannel')
          .listen('DeleteReplyEvent', (e) => {
            for(let i = 0; i < this.question.replies.length; i++) {
              if(this.question.replies[i].id == e.id) {
                this.question.replies.splice(i, 1)
              }
            }
          })
      }
    }
}
</script>

<style>

</style>