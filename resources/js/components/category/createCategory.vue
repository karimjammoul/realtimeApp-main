<template>
  <v-container>
      <v-alert
        v-if="errors"
        type="error"
      >
      The Category Name is Required.
      </v-alert>
      <v-form @submit.prevent="submit">
          <v-text-field
            label="Category Name"
            v-model="form.name"
            required
        ></v-text-field>

        <v-btn type="submit" color="pink" :disabled="disabled" v-if="editSlug">Update</v-btn>
        <v-btn type="submit" color="teal" :disabled="disabled" v-else>Create</v-btn>
      </v-form>

      <v-card class="mt-2">
          <v-toolbar color="indigo" dark dense>
              <v-toolbar-title>Categories</v-toolbar-title>
          </v-toolbar>

          <v-list>
              <div  v-for="(category, index) in categories" :key="category.id">
                <v-list-item>

                    <v-list-item-action>
                        <v-btn
                            color="primary"
                            fab
                            small
                            dark
                            @click="edit(index)"
                        >
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                    </v-list-item-action>

                    <v-list-item-content>
                        <v-list-item-title>
                            {{category.name}}
                        </v-list-item-title>
                    </v-list-item-content>

                    <v-list-item-action>
                        <v-btn
                            color="error"
                            fab
                            small
                            dark
                            @click="destroy(category.slug, index)"
                        >
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </v-list-item-action>  

                </v-list-item>
                <v-divider></v-divider>
              </div>
          </v-list>
      </v-card>
  </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null
            },
            categories: {},
            editSlug: null,
            errors: null
        }
    },
    created() {
        if(!User.admin()) {
            this.$router.push('/forum')
        }
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },
    methods: {
        submit() {
            this.editSlug ? this.update() : this.create()
        },
        create() {
            axios.post('/api/category', this.form)
            .then(res => {
                this.categories.unshift(res.data)
                this.form.name = null
            })
            .catch(error => this.errors = error.response.data.errors)
        },
        update() {
            axios.patch(`/api/category/${this.editSlug}`, this.form)
            .then(res => {
                this.categories.unshift(res.data)
                this.form.name = null
            })
        },
        edit(index) {
            this.form.name = this.categories[index].name
            this.editSlug = this.categories[index].slug
            this.categories.splice(index,1)
        },
        destroy(slug, index) {
            axios.delete(`/api/category/${slug}`)
            .then(res => this.categories.splice(index,1))
        }
    },
    computed: {
        disabled() {
            return !this.form.name
        }
    }
}
</script>

<style>

</style>