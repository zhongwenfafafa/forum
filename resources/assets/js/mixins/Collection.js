export default {
    methods: {
        add ({data}) {
            this.items.push(data);

            this.$emit('added');
        },

        remove (index) {
            this.items.splice(index, 1);

            this.$emit('removed');

            flash('Reply has been deleted!');
        }
    }
}