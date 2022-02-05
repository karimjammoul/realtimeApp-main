<template>
  <div>
    <v-textarea
            v-model="reply.reply"
            color="teal"
    >
        <template v-slot:label>
        <div>
            Reply
        </div>
        </template>
    </v-textarea>
    <v-card-actions>
        <v-btn
            color="primary"
            fab
            small
            dark
            @click="update"
        >
            <v-icon>mdi-content-save-check</v-icon>
        </v-btn>
        <v-btn
            color="black"
            fab
            small
            dark
            @click="cancel"
        >
            <v-icon>mdi-cancel</v-icon>
        </v-btn>
    </v-card-actions>
  </div>
</template>

<script>
export default {
    props: ['reply'],
    methods: {
        cancel(reply) {
            EventBus.$emit('cancelEditing', reply);
        },
        update() {
            axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {
                body: this.reply.reply
            })
            .then(res => this.cancel(this.reply.reply))
        }
    }
}
</script>

<style>

</style>