<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your answer</h3>
                    </div>
                    <hr>
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea class="form-control" rows="7" required v-model="body" name="body"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewAnswer",

        props: ['questionId'],

        methods: {
          create() {
              axios.post(`/questions/${this.questionId}/answers`, {
                  body: this.body
              })
              .then(({data}) => {
                  this.$toast.success(data.message, "Success");
                  this.body = '';
                  this.$emit('created', data.answer);
              })
              .catch(err => {
                  this.$toast.error(err.response.data.message, "Error");
              })
          }
        },

        data() {
            return {
                body: ''
            }
        },

        computed: {
            isInvalid() {
                return !this.signedIn || this.body.length < 10;
            }
        }
    }
</script>

<style scoped>

</style>
