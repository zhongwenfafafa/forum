<template>
    <div class="panel panel-default" :id="'reply'+id">
        <div class="panel-heading">
            <div class="level">
                <h5 class="flex">
                    <a :href="'/profiles/' + data.owner.name"
                       v-text="data.owner.name">
                    </a> 回复于 <span v-text="ago"></span>
                </h5>

                <div v-if="signIn">
                    <favorite :reply="data"></favorite>
                </div>

            </div>
        </div>

        <div class="panel-body">
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body" required></textarea>
                    </div>

                    <button class="btn btn-xs btn-primary">Update</button>
                    <button class="btn btn-xs btn-link" @click="cancelReply" type="button">Cancel</button>
                </form>
            </div>

            <div v-else v-html="body"> </div>
        </div>

        <div class="panel-footer level" v-if="canUpdate">
            <button class="btn btn-xs mr-1" @click="editReply">Edit</button>
            <button class="btn btn-danger btn-xs" @click="destroy">Delete</button>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite'

    import moment from 'moment';

    export default {
        props: ['data'],

        components: {
            Favorite
        },

        data () {
            return {
                editing: false,
                body: this.data.body,
                id: this.data.id,
            }
        },

        computed: {
            signIn () {
                return window.App.signIn;
            },

            canUpdate () {
                return this.authorize(user => this.data.user_id == user.id);
            },

            ago() {
                return moment(this.data.created_at).utc(8).fromNow() + ' ...';
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                })
                    .then(res => {
                        this.editing = false;

                        flash('Updated!')
                    })
                    .catch(error => {
                        let err = error.response.data;
                        err = err instanceof Array  ? err[0]: err;

                        flash(err,'danger');

                    });
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id)

                /*$(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted!');
                });*/
            },

            editReply() {
                this.old_body_data = this.body;
                this.editing = true;
            },

            cancelReply() {
                this.body = this.old_body_data;
                this.old_body_data = '';
                this.editing = false;
            }
        }
    }
</script>

<style scoped>

</style>