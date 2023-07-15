<template>
    <div class="col-12">
        <div class="neighbourhood-add my-4">
            <a @click="addNeighbourhood" class="add btn btn-info text-dark">+ Add Neighbourhood</a>
        </div>
        <form @submit.prevent="saveNeighbourhoods" novalidate class="row py-2">
            <div v-for="(neighbourhood, index) in neighbourhoods" :key="neighbourhood.id" class="d-flex flex-column col col-med-3">
                <div class="form-field mb-2">
                    <input type="text" placeholder="Neighbourhood Name" v-model="neighbourhood.name" :ref="neighbourhood.name">
                    <div v-if="name_errors" class="text-danger">{{ name_errors }}</div>
                </div>
                <div class="form-field mb-2">
                    <input type="text" placeholder="City Location" :value="neighbourhood.subtitle" @input="update($event, 'subtitle', index)" :ref="neighbourhood.subtitle">
                    <div v-if="subtitle_errors" class="text-danger">{{ subtitle_errors }}</div>
                </div>
                <div class="form-field mb-2">
                    <textarea :value="neighbourhood.description" placeholder="Neighbourhood Description" @input="update($event, 'description', index)" :ref="neighbourhood.description" cols="30" rows="10"></textarea>
                    <div v-if="description_errors" class="text-danger">{{ description_errors }}</div>
                </div>
                <div class="form-field mb-2">
                    <input type="number" placeholder="Order Number" :value="neighbourhood.display_order" @input="update($event, 'display_order', index)">
                    <a @click="removeNeighbourhood(index)" class="btn btn-danger text-white remove">delete</a>
                </div>
                <div class="form-field mb-2">
                    <img v-if="neighbourhood.image" :src="`/images/${neighbourhood.image}`" class="w-100 d-block mb-2">
                    <label class="text-white" v-else>Image: </label>
                    <input type="text" placeholder="Neighbourhood Image Name" :value="neighbourhood.image" @change="update($event, 'image', index)">
                    <div v-if="image_errors" class="text-danger">{{ image_errors }}</div>
                </div>
                <hr>
            </div>
            <div class="save-container col col-12">
                <button type="submit" class="btn btn-success text-dark">Save</button>
            </div>
            <div v-if="feedback" class="text-white">{{ feedback }}</div>
        </form>
    </div>
</template>

<script>
    export default {
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
                }
            },

        addNeighbourhood() {
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