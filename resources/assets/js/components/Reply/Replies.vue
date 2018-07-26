<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>

        <new-reply @created="add" :endpoint="endpoint"></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply'
    import NewReply from './NewReply'

    export default {
        components: {
            Reply, NewReply
        },

        data () {
            return {
                items: [],
                endpoint: location.pathname + '/replies',
            }
        },

        created() {
            this.fetch();
        },

        computed: {
            url() {
                return `${location.pathname}/replies`;
            }
        },
        
        methods: {

            fetch() {
                axios.get(this.url)
                    .then(this.refresh);
            },

            refresh(response) {
                console.log(response)
            },

            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed');

                flash('Reply has been deleted!');
            },

            add(reply) {
                this.items.push(reply.data);

                this.$emit('added')
            }
        }
    }
</script>

<style scoped>

</style>