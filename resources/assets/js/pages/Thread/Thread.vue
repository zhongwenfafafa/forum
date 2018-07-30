<template>
    
</template>

<script>
    import Replies from '../../components/Reply/Replies'
    import SubscribeButton from '../../components/Thread/SubscribeButton'

    export default {
        components: {
            Replies, SubscribeButton
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