<template>
    <button :class="classes" @click="subscribe" v-show="isShow">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        data () {
            return {
                isShow: window.App.user
            };
        },

        computed: {
            classes () {
                return ['btn', this.active ? 'btn-primary' : 'btn-default'];
            }
        },

        methods: {
            subscribe () {
                axios[
                    (this.active ? 'delete' : 'post')
                    ](location.pathname + '/subscriptions');

                this.active = !this.active;

                flash('Subscribed');
            }
        }
    }
</script>