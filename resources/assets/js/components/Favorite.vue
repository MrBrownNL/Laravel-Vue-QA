<template>
    <a :title="title"
       :class="classes" @click.prevent="toggle">
        <i class="fas fa-star fa-2x"></i>
        <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
    export default {
        name: "favorite",

        props: ['model', 'label'],

        data() {
            return {
                isFavorited: this.model.is_favorited,
                count: this.model.favorites_count,
                signedIn: true,
                id: this.model.id,
            }
        },

        computed: {
            classes() {
                return [
                    'favorite', 'mt-2',
                    ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
                ];
            },
            title() {
                return "Click to mark as favorite " + this.label + " (Click again to undo)";
            },

            endpoint() {
                return `/${this.label}s/${this.id}/favorites`;
            }
        },

        methods: {
            toggle () {
                this.isFavorited ? this.destroy() : this.create();
            },

            destroy () {
                axios.delete(this.endpoint)
                     .then(res => {
                         this.count--;
                         this.isFavorited = false;
                     });

            },

            create () {
                axios.post(this.endpoint)
                     .then(res => {
                         this.count++;
                         this.isFavorited = true;
                         this.$toast.success(res.data.message,"Success", { timeout: 3000});
                    });
            },


        }
    }
</script>

<style scoped>

</style>
