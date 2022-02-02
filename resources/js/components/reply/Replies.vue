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
      }
    }
}
</script>

<style>

</style>