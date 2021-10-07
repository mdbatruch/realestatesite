<template>
    <form @submit.prevent="saveNeighbourhoods" novalidate>
        <a @click="addNeighbourhood" class="add">+ Add Neighbourhood</a>
        <div v-for="(neighbourhood, index) in neighbourhoods" :key="neighbourhood.id">
            <input type="text" v-model="neighbourhood.name" :ref="neighbourhood.name">
            <div v-if="name_errors">{{ name_errors }}</div>
            <input type="text" :value="neighbourhood.subtitle" @input="update($event, 'subtitle', index)" :ref="neighbourhood.subtitle">
            <div v-if="subtitle_errors">{{ subtitle_errors }}</div>
            <textarea  :value="neighbourhood.description" @input="update($event, 'description', index)" :ref="neighbourhood.description" cols="30" rows="10"></textarea>
            <div v-if="description_errors">{{ description_errors }}</div>
            <input type="number" :value="neighbourhood.display_order" @input="update($event, 'display_order', index)">
            <a @click="removeNeighbourhood(index)" class="remove">delete</a>
            <div>
                <img v-if="neighbourhood.image" :src="`/images/${neighbourhood.image}`" width="100">
                <label v-else>Image: </label>
                <!-- <input type="text" v-model.lazy="neighbourhood.image"> -->
                <input type="text" :value="neighbourhood.image" @change="update($event, 'image', index)">
                <div v-if="image_errors">{{ image_errors }}</div>
            </div>
            <hr>
        </div>
        <button type="submit">Save</button>
        <div v-if="feedback">{{ feedback }}</div>
    </form>
</template>

<script>
    export default {
        // props: ['initial-neighbourhoods'],
        state: {
            neighbourhoods: [],
            items: [],
            feedback: '',
            errors: [],
            name_errors: '',
            subtitle_errors: '',
            description_errors: '',
            image_errors: ''
        },
        computed: {
            neighbourhoods() {
                return this.$store.state.neighbourhoods;
            },
            feedback() {
                return this.$store.state.feedback;
            },
            errors() {
                return this.$store.state.errors;
            },
            name_errors() {
                return this.$store.state.name_errors;
            },
            subtitle_errors() {
                return this.$store.state.subtitle_errors;
            },
            description_errors() {
                return this.$store.state.description_errors;
            },
            image_errors() {
                return this.$store.state.image_errors;
            }
        },
        methods: {
            removeNeighbourhood(index) {
                if (confirm('are you sure')) {

                    this.$store.dispatch('removeNeighbourhood', index);
                // let id = this.neighbourhoods[index].id;

                // if (id > 0) {
                //     axios.delete('api/neighbourhoods/' + id);
                // }

                // this.neighbourhoods.splice(index, 1);

                }
            },

        addNeighbourhood() {
                // this.neighbourhoods.push({
                this.$store.commit('ADD_NEIGHBOURHOOD', {
                    id: 0,
                    name: '',
                    image: '',
                    display_order: this.neighbourhoods.length + 1
                });
                this.$nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus();
                })
            },
        saveNeighbourhoods() {

            this.$store.dispatch('saveNeighbourhoods');
            
            // axios.post('api/neighbourhoods/upsert', {
            //     neighbourhoods: this.neighbourhoods
            // })
            //     .then((res) => {
            //         if (res.data.success) {
            //             this.feedback = 'Saved!';
            //             this.neighbourhoods = res.data.neighbourhoods;
            //         }
            //     });
            },
            update($event, property, index) {
                this.$store.commit('UPDATE_NEIGHBOURHOOD', {
                    index,
                    property,
                    value: $event.target.value
                });
            }
        },
    }
</script>

<style scoped>
    img {
        vertical-align: middle;
    }

    hr {
        margin-bottom:30px;
    }

    a {
        color: #f00;
    }
</style>