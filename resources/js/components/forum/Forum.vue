<template>
  <v-container fluid grid-list-md>
    <v-layout row wrap>
      <v-flex xs8>
        <v-toolbar
          color="cyan"
          dark
          dense
          class="mt-2"
        >
          <v-toolbar-title>Questions</v-toolbar-title>
        </v-toolbar>
        <question
        v-for="question in questions"
        :key="question.id"
        :data=question
        ></question>

        <div class="text-center">
          <v-pagination
            v-model="meta.current_page"
            :length="meta.total"
            @input="changePage"
          ></v-pagination>
        </div>

      </v-flex>
      
      <v-flex xs4>
        <app-sidebar></app-sidebar>
      </v-flex>

    </v-layout>
  </v-container>
</template>

<script>
import Question from './Question.vue'
import AppSidebar from './AppSidebar.vue'
export default {
  components: {
    Question, AppSidebar
  },

  data() {
    return {
      questions: {},
      meta: {},
    }
  },

  created() {
    this.fetchQuestions()
  },
  methods: {
    fetchQuestions(page) {
      let url = page ? '/api/question?page=' + page : '/api/question'
      axios.get(url)
        .then(res => {
          this.questions = res.data.data
          this.meta = res.data.meta
        })
        .catch(error => console.log(error.response.data))
    },
    changePage(page) {
      this.fetchQuestions(page)
    }
  }
}
</script>

<style>

</style>