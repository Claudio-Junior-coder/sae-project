import axios from 'axios';
import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';

const token = localStorage.getItem('authToken');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

axios.defaults.withCredentials = true;

export default {
  namespaced: true,
  state: {
    activities: [],
    activity: {},
  },
  
  mutations: {
    SET_ACTIVITIES(state, activities) {
      state.activities = activities;
    },
    SET_ACTIVITY(state, activity) {
      state.activity = activity;
    },
    REMOVE_ACTIVITY(state, activityId) {
      state.activities = state.activities.filter(activity => activity.id !== activityId);
    },
  },

  actions: {
    async fetchActivities({ commit }) {
      try {
        const { data } = await axios.get('/api/activities');
        commit('SET_ACTIVITIES', data);          
      } catch (error) {
        console.error('Erro ao buscar atividades:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async fetchActivity({ commit }, activityId) {
      try {
        const response = await axios.get(`/api/activities/${activityId}`);
        commit('SET_ACTIVITY', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar a atividade com ID ${activityId}:`, error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async createActivity({ commit }, activity) {
      try {
        const response = await axios.post('/api/activities', activity);
        commit('SET_ACTIVITY', response.data); 
        Toastify({ text: "Atividade criada com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar atividade:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },
  
    async updateActivity({ commit }, activity) {
      try {
        const response = await axios.put(`/api/activities/${activity.id}`, activity);
        commit('SET_ACTIVITY', response.data);  
        Toastify({ text: "Atividade atualizada com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar atividade:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deleteActivity({ commit }, activityId) {
      try {
        const response = await axios.delete(`/api/activities/${activityId}`);
        commit('REMOVE_ACTIVITY', activityId);
        Toastify({ text: "Atividade excluída com sucesso!" }).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar atividade:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    }
    
  },
};
