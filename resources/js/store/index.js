import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        neighbourhoods: [],
        items: [],
        feedback: ''
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
        }
    },
    actions: {
        saveNeighbourhoods({commit, state}) {
            axios.post('/api/neighbourhoods/upsert', {
                neighbourhoods: state.neighbourhoods
            })
                .then((res) => {
                    if (res.data.success) {
                        commit('SET_FEEDBACK', 'Saved!');
                        setTimeout(() => commit('SET_FEEDBACK', ''), 2000);
                        commit('SET_NEIGHBOURHOODS', res.data.neighbourhoods);
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