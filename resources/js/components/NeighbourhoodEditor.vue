<template>
    <div>
        <h1 class="text-white">Neighbourhood Editor</h1>
        <router-link :to="{name: 'neighbourhoods'}">Neighbourhoods</router-link>
        <router-link :to="{name: 'houses'}">Houses</router-link>
        <router-link :to="{name: 'add-item'}">Add Item</router-link>
        <router-view :initial-neighbourhoods="neighbourhoods"></router-view>
        <!-- <router-view></router-view> -->
    </div>
</template>

<script>

    import VueRouter from 'vue-router';
    import NeighourhoodManager from './NeighbourhoodManager.vue';
    import NeighourhoodItem from './NeighbourhoodItem.vue';
    import HouseItem from './HouseItem.vue';
    import HouseItemList from './HouseItemList.vue';
    import store from '../store';

    export default  {
        store,
        props: ['neighbourhoods'],
        created() {
            this.$store.commit('SET_NEIGHBOURHOODS', _.cloneDeep(this.neighbourhoods));
        },
        router: new VueRouter({
            mode: 'history',
            base: 'neighbourhood-editor',
            routes: [
                {
                    path: '/neighbourhoods',
                    name: 'neighbourhoods',
                    component: NeighourhoodManager
                },
                {
                    path: '/',
                    redirect: {name: 'neighbourhoods'}
                },
                {
                    path: '/houses',
                    name: 'houses',
                    component: HouseItemList
                },
                {
                    path: '/edit-house/:id',
                    name: 'edit-house',
                    component: HouseItem,
                    props: true
                },
                {
                    path: '/add-item',
                    name: 'add-item',
                    component: NeighourhoodItem
                },
                {
                    path: '*',
                    name: '/'
                }
            ]
        })
    }

</script>
<style scoped>
    a {
        border: solid 1px black;
        padding: 10px;
        margin: 0;
        color: #f00;
    }
    .router-link-active {
        font-weight: bold;
        border-bottom: none;
    }
</style>
