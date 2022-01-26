<template>
    <div v-if="question">
        <edit-question 
        v-if="editing"
        :data=question
        >
        </edit-question>

        <show-question
        v-else
        :data=question>
        </show-question>
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion.vue'
import EditQuestion from './EditQuestion.vue'
export default {

    components: {
        ShowQuestion, EditQuestion
    },

    data() {
        return {
            question: {},
            editing: false
        }
    },

    created() {
        this.listen()
        this.getQuestion()
    },
    methods: {
        listen() {
            EventBus.$on('startEditing', () => {
                this.editing = true
            })

            EventBus.$on('cancelEditing', () => {
                this.editing = false
            })
        },
        getQuestion() {
            axios.get(`/api/question/${this.$route.params.slug}`)
            .then(res => this.question = res.data.data)
        }
    }
}
</script>

<style>

</style>