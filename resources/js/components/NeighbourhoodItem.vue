<template>
    <div>
        <form class="item-form" @submit.prevent="save" novalidate>
        <div>
            <input type="text" placeholder="Item name" v-model="item.name" required>
            <div v-if="errors.name">{{ errors.name }}</div>
            $<input type="number" min="0" step=".01" v-model="item.price" required>
            <div v-if="errors.price">{{ errors.price }}</div>
        </div>
        <div>
            <textarea v-model="item.description" placeholder="Item description" required></textarea>
            <div v-if="errors.description">{{ errors.description }}</div>
        </div>
        <div>
            <select v-model="item.neighbourhood" required>
                <option value="">Select a Neighbourhood</option>
                <option v-for="cat in initialNeighbourhoods" :value="cat.id" :key="cat.id">{{cat.name}}</option>
            </select>
            <div v-if="errors.neighbourhood">{{ errors.neighbourhood }}</div>
        </div>
        <div>
            <select v-model="item.propertyType" required>
                <option value="">Select a Property Type</option>
                <option v-for="type in propertyType" :value="type" :key="type">{{type}}</option>
            </select>
            <div v-if="errors.propertyType">{{ errors.propertyType }}</div>
        </div>
        <drop-zone :options="dropzoneOptions" id="dz" ref="dropzone"></drop-zone>
        <div v-if="errors.image">{{ errors.image }}</div>
        <button type="submit">Save</button>
        <!-- <ul>
            <li v-for="(error, index) in errors" :key="index">{{error}}</li>
        </ul> -->
    </form>
    </div>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';

    export default {
        components: {
            dropZone: vue2Dropzone
        },
        props: ['initial-neighbourhoods'],
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
                    neighbourhood: '',
                    propertyType: ''
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
        methods: {
            save() {
                let files = this.$refs.dropzone.getAcceptedFiles();

                if (files.length > 0 && files[0].filename) {
                    this.item.image = files[0].filename;
                }

                axios.post('/api/house-items/add', this.item)
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
                    console.log(messages);
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
                    // this.errors = [].concat.apply([], messages);
                    console.log(this.errors.name);
                });
            }
        }
    }
</script>