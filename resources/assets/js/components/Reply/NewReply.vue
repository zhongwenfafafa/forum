<template>
    <div>
        <div class="form-group" v-if="signedIn">
            <textarea name="body"
                      id="body"
                      class="form-control"
                      placeholder="说点什么吧..."
                      rows="5"
                      required
                      v-model="body">
            </textarea>

            <button type="submit" class="btn btn-default" @click="addReply">
                提交
            </button>
        </div>

        <p class="text-center" v-else>
            请先<a href="/login">登录</a>,然后再发表回复
        </p>
    </div>
</template>

<script>
    export default {
        props: ['endpoint'],
        data () {
            return {
                body: "",
            };
        },

        computed:{
            signedIn () {
                return window.App.signIn;
            }
        },

        methods: {
            addReply () {
                axios.post(this.endpoint, { body: this.body })
                    .then( data => {
                        this.body = '';

                        flash('Your reply has been posted.');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>

<style scoped>

</style>