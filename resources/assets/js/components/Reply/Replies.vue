<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <new-reply @created="add" :endpoint="endpoint"></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply'
    import NewReply from './NewReply'
    import Collection from '../../mixins/Collection'

    export default {
        components: {
            Reply, NewReply
        },

        mixins: [Collection],

        data () {
            return {
                dataSet: false,
                endpoint: this.url(),
                items: [],
            }
        },

        created() {
            this.fetch();
        },
        
        methods: {

            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0, 0);
            },

            url(page) {
                if(! page){
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return `${location.pathname}/replies?page=${page}`;
            }
        }
    }
</script>

<style scoped>

</style>