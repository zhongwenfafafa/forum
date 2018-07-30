<template>
    <div class="alert alert-flash" role="alert" :class="'alert-' + level" v-show="show" v-text="body">
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data () {
            return {
                body: '',
                show: false,
                level: 'success'
            };
        },
        created () {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', message => this.flash(message));
        },
        methods: {
            flash ({message, level}) {
                this.body = message;
                this.level = level;
                this.show = true;

                this.hide();
            },

            hide () {
                setTimeout( () => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style scoped>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>