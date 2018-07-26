<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <p>
                <a href="#">{{ data.name }}</a> 发布于 <span v-text="ago"></span>,
                当前共有 {{ count }} 个回复.
            </p>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: ['count', 'data'],

        computed: {
            ago() {
                return moment(this.data.created_at).utc(8).fromNow() + '...';
            }
        }

    }
</script>

<style scoped>

</style>