import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        neighbourhoods: [],
        items: [],
        feedback: '',
        errors: {},
        name_errors: '',
        subtitle_errors: '',
        description_errors: '',
        image_errors: ''
    },
    mutations: {
        SET_NEIGHBOURHOODS(state, neighbourhoods) {
            state.neighbourhoods = neighbourhoods;
        },
        ADD_NEIGHBOURHOOD(state, neighbourhood) {
            state.neighbourhoods.push(neighbourhood);
        },
        REMOVE_NEIGHBOURHOOD(state, index) {
            state.neighbourhoods.splice(index, 1);
        },
        UPDATE_NEIGHBOURHOOD(state, {index, property, value}) {
            state.neighbourhoods[index][property] = value;
        },
        SET_FEEDBACK(state, feedback) {
            state.feedback = feedback;
        },
        SET_ERRORS(state, errors) {
            state.errors = errors;
        },
        SET_NAME_ERRORS(state, name_errors) {
            state.name_errors = name_errors;
        },
        SET_SUBTITLE_ERRORS(state, subtitle_errors) {
            state.subtitle_errors = subtitle_errors;
        },
        SET_DESCRIPTION_ERRORS(state, description_errors) {
            state.description_errors = description_errors;
        },
        SET_IMAGE_ERRORS(state, image_errors) {
            state.image_errors = image_errors;
        }
    },
    actions: {
        saveNeighbourhoods({commit, state}) {

            console.log(state.neighbourhoods);

            axios.post('/api/neighbourhoods/upsert', {
                neighbourhoods: state.neighbourhoods
            })
                .then((res) => {
                    if (res.data.success) {
                        commit('SET_FEEDBACK', 'Saved!');
                        setTimeout(() => commit('SET_FEEDBACK', ''), 2000);
                        commit('SET_NEIGHBOURHOODS', res.data.neighbourhoods);
                    }
                })
                .catch(error => {
                    
                    // reset error values
                    this.name_errors = '';
                    commit('SET_NAME_ERRORS', this.name_errors);
                    this.subtitle_errors = '';
                    commit('SET_SUBTITLE_ERRORS', this.subtitle_errors);
                    this.description_errors = '';
                    commit('SET_DESCRIPTION_ERRORS', this.description_errors);
                    this.image_errors = '';
                    commit('SET_IMAGE_ERRORS', this.image_errors);

                    let messages = Object.values(error.response.data.errors);
                    let errors = [].concat.apply([], messages);

                    for (var i = 0; i < errors.length; i++) {

                        if (errors[i] == 'The name field is required.') {
                            this.name_errors = errors[i];
                            commit('SET_NAME_ERRORS', this.name_errors);
                        }

                        if (errors[i] == 'The subtitle field is required.') {
                            this.subtitle_errors = errors[i];
                            commit('SET_SUBTITLE_ERRORS', this.subtitle_errors);
                        }

                        if (errors[i] == 'The description field is required.') {
                            this.description_errors = errors[i];
                            commit('SET_DESCRIPTION_ERRORS', this.description_errors);
                        }
                        
                        if (errors[i] == 'The image field is required.') {
                            this.image_errors = errors[i];
                            commit('SET_IMAGE_ERRORS', this.image_errors);
                        }
                    }
                });

        },
        removeNeighbourhood({commit, state}, index) {
            let id = state.neighbourhoods[index].id;

                if (id > 0) {
                    return axios.delete('/api/neighbourhoods/' + id)
                    .then((res) => commit('REMOVE_NEIGHBOURHOOD', index));
                }

                commit('REMOVE_NEIGHBOURHOOD', index)
        }
    }
});