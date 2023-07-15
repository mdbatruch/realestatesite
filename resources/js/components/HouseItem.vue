<template>
    <div>
        <form class="item-form d-flex flex-column py-2 mt-4" @submit.prevent="save" novalidate>
            <div class="form-field mb-2">
                <input type="text" placeholder="Item name" v-model="item.name" required>
                <div v-if="errors.name" class="text-danger">{{ errors.name }}</div>
            </div>
            <div class="form-field mb-2">
                $<input type="number" min="0" step=".01" v-model="item.price" required>
                <div v-if="errors.price" class="text-danger">{{ errors.price }}</div>
            </div>
            <div class="form-field mb-2">
                <textarea v-model="item.description" placeholder="Item description" required></textarea>
                <div v-if="errors.description" class="text-danger">{{ errors.description }}</div>
            </div>
            <div class="form-field mb-2">
                <select v-model="item.neighbourhood" required>
                    <option value="">Select a Neighbourhood</option>
                    <option v-for="cat in initialNeighbourhoods" :value="cat.id" :key="cat.id">{{cat.name}}</option>
                </select>
                <div v-if="errors.neighbourhood" class="text-danger">{{ errors.neighbourhood }}</div>
            </div>
            <div class="form-field mb-2">
                <select v-model="item.propertyType" required>
                    <option value="">Select a Property Type</option>
                    <option v-for="type in propertyType" :value="type" :key="type">{{type}}</option>
                </select>
                <div v-if="errors.propertyType" class="text-danger">{{ errors.propertyType }}</div>
            </div>
            <div class="form-filed mb-2">
                <img v-if="id && item.image" :src="`/storage/images/${item.image}`" width="200" class="mb-2" />
                <drop-zone :options="dropzoneOptions" id="dz" ref="dropzone"></drop-zone>
                <div v-if="errors.image" class="text-danger">{{ errors.image }}</div>
            </div>
            <div class="form-field d-flex">
                <div class="inner-form-field mb-2 mr-2">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                <div class="inner-form-field mb-2">
                    <a @click="removeHouse(index)" class="btn btn-danger remove">Delete</a>
                </div>
            </div>
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
                errors: {
                    'name' : "",
                    'price': "",
                    'description' : "",
                    'neighbourhood' : "",
                    'propertyType' : "",
                    'image' : ""
                }
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

                    // reset error values
                    this.errors.name = '';
                    this.errors.price = '';
                    this.errors.description = '';
                    this.errors.neighbourhood = '';
                    this.errors.propertyType = '';
                    this.errors.image = '';

                    let messages = Object.values(error.response.data.errors);
                    let errors = [].concat.apply([], messages);

                    for (var i = 0; i < errors.length; i++) {
                        console.log(errors[i]);

                        if (errors[i] == 'The name field is required.') {
                            this.errors.name = errors[i];
                        }

                        if (errors[i] == 'The price field is required.') {
                            this.errors.price = errors[i];
                        }

                        if (errors[i] == 'The description field is required.') {
                            this.errors.description = errors[i];
                        }

                        if (errors[i] == 'The neighbourhood field is required.') {
                            this.errors.neighbourhood = errors[i];
                        }

                        if (errors[i] == 'The property type field is required.') {
                            this.errors.propertyType = errors[i];
                        }
                        
                        if (errors[i] == 'The image field is required.') {
                            this.errors.image = errors[i];
                        }
                    }
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