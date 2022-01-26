<template>
  <v-container fluid>
      <v-card>
        <v-form @submit.prevent="update">

            <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
            ></v-text-field>

            <v-textarea
                v-model="form.body"
                color="teal"
            >
                <template v-slot:label>
                <div>
                    Question
                </div>
                </template>
            </v-textarea>

            <v-card-actions>
                <v-btn
                    color="primary"
                    fab
                    small
                    dark
                    type="submit"
                >
                    <v-icon>mdi-content-save-check</v-icon>
                </v-btn>
                <v-btn
                    color="error"
                    fab
                    small
                    dark
                    @click="cancel"
                >
                    <v-icon>mdi-cancel</v-icon>
                </v-btn>
            </v-card-actions>

        </v-form>
      </v-card>
  </v-container>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            form: {
                title: null,
                body: null,
            }
        }
    },
    created() {
        this.form = this.data
    },
    methods: {
        cancel() {
            EventBus.$emit('cancelEditing')
        },
        update() {
            axios.patch(`/api/question/${this.form.slug}`, this.form)
            .then(res => this.cancel())
        }
    }
}
</script>

<style>

</style>