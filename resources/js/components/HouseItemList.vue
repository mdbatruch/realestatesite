<template>
    <div class="menu-item-list">
        <select v-model="neighbourhoodId" @change="fetchHouses" required>
            <option value="">Select a Neighbourhood</option>
            <option v-for="cat in initialNeighbourhoods" :value="cat.id" :key="cat.id">{{cat.name}}</option>
        </select>
        <ul>
            <draggable v-model="myArray">
                <transition-group>
                    <li v-for="house in houses" :key="house.id">
                        <router-link :to="{name: `edit-house`, params: {id: house.id}}">
                            {{house.name}}
                        </router-link>
                    </li>
                 </transition-group>
            </draggable>   
        </ul>
    </div>
</template>

<script>

    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable,
        },
        props: ['initialNeighbourhoods'],
        data() {
            return {
                neighbourhoodId: this.initialNeighbourhoods[0].id,
                houses: []
            }
        },
        created() {
            this.fetchHouses();
        },
        methods: {
            fetchHouses() {
                axios.get(`/api/neighbourhoods/${this.neighbourhoodId}/houses`)
                .then(res => this.houses = res.data);
                // console.log(this.houses);
            }
        }
    }

</script>

<style scoped>
    ul li a {
        color: red;
    }
</style>
