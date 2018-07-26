<template>
    
</template>

<script>
    import Replies from '../../components/Reply/Replies'
    import Sidebar from '../../components/Reply/Sidebar'

    export default {
        components: {
            Replies, Sidebar
        },
        props: ['initialRepliesCount'],

        data () {
            return {
                repliesCount: this.initialRepliesCount,
            };
        },

        methods: {
            backRepliesCount () {
                this.repliesCount--;
            },

            addRepliesCount () {
                this.repliesCount++;
            }
        }
    }
</script>

<style scoped>

</style>