<template>
    <div>
        <form class="item-form" @submit.prevent="save" novalidate>
        <div>
            <input type="text" placeholder="Item name" v-model="item.name" required>
            $<input type="number" min="0" step=".01" v-model="item.price" required>
        </div>
        <div>
            <textarea v-model="item.description" placeholder="Item description" required></textarea>
        </div>
        <div>
            <select v-model="item.neighbourhood" required>
                <option value="">Select a Neighbourhood</option>
                <option v-for="cat in initialNeighbourhoods" :value="cat.id" :key="cat.id">{{cat.name}}</option>
            </select>
        </div>
        <div>
            <select v-model="item.propertyType" required>
                <option value="">Select a Property Type</option>
                <option v-for="type in propertyType" :value="type" :key="type">{{type}}</option>
            </select>
        </div>
        <img v-if="id && item.image" :src="`/storage/images/${item.image}`" width="200"/>
        <drop-zone :options="dropzoneOptions" id="dz" ref="dropzone"></drop-zone>
        <button type="submit">Save</button>
        <a @click="removeHouse(index)" class="btn btn-danger remove">delete</a>
        <ul>
            <li v-for="(error, index) in errors" :key="index">{{error}}</li>
        </ul>
    </form>
    </div>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';

    function newItem() {
        return {
            name: '',
            price: 0.00,
            description: '',
            neighbourhood: ''
        }
    }

    export default {
        components: {
            dropZone: vue2Dropzone
        },
        props: ['initial-neighbourhoods', 'id'],
        data() {
            return {
                propertyType: ['Detached', 'Semi-Detached', 'Condo', 'Townhouse'],
                dropzoneOptions: {
                    url: '/api/add-image',
                    thumbnailWidth: 200,
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    },
                    success(file, res) {
                        file.filename = res;
                    }
                },
                item: {
                    name: '',
                    price: 0.00,
                    description: '',
                    neighbourhood: ''
                },
                errors: []
            };
        },
        created() {
            if (this.id) {
                axios.get('/api/house-items/' + this.id)
                .then(res => this.item = res.data);
            }
        },
        beforeRouteLeave (to, form, next) {
            this.item = newItem();
            next();
        },
        methods: {
            save() {
                let files = this.$refs.dropzone.getAcceptedFiles();

                if (files.length > 0 && files[0].filename) {
                    this.item.image = files[0].filename;
                }
                
                let url = '/api/house-items/add';
                
                if (this.id) {
                    url = '/api/house-items/' + this.id;
                }

                axios.post(url, this.item)
                .then(res => {
                    this.$router.push('/');
                })
                .catch(error => {
                    let messages = Object.values(error.response.data.errors);
                    this.errors = [].concat.apply([], messages);
                });
            },
            removeHouse(index) {
                if (confirm('are you sure!?')) {

                let id = this.id;

                console.log(id);

                if (id > 0) {
                    axios.delete('/api/house-items/' + id).
                    then(res => {
                        this.$router.push('/houses/');
                    });
                }

                }
            },
        }
    }
</script>