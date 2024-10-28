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
    behaviors: [],
    behavior: {},
  },
  
  mutations: {
    SET_BEHAVIORS(state, behaviors) {
      state.behaviors = behaviors;
    },
    SET_BEHAVIOR(state, behavior) {
      state.behavior = behavior;
    },
    REMOVE_BEHAVIOR(state, behaviorId) {
      state.behaviors = state.behaviors.filter(behavior => behavior.id !== behaviorId);
    },
  },

  actions: {
    async fetchBehaviors({ commit }) {
      try {
        const { data } = await axios.get('/api/behaviors');
        commit('SET_BEHAVIORS', data);          
      } catch (error) {
        console.error('Erro ao buscar comportamentos:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },

    async fetchBehavior({ commit }, behaviorId) {
      try {
        const response = await axios.get(`/api/behaviors/${behaviorId}`);
        commit('SET_BEHAVIOR', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar o comportamento com ID ${behaviorId}:`, error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },

    async createBehavior({ commit }, behavior) {
      try {
        const response = await axios.post('/api/behaviors', behavior);
        commit('SET_BEHAVIOR', response.data); 
        Toastify({ text: "Comportamento criado com sucesso!"}).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar comportamento:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },
  
    async updateBehavior({ commit }, behavior) {
      try {
        const response = await axios.put(`/api/behaviors/${behavior.id}`, behavior);
        commit('SET_BEHAVIOR', response.data);  
        Toastify({ text: "Comportamento atualizado com sucesso!"}).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar comportamento:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deleteBehavior({ commit }, behaviorId) {
      try {
        const response = await axios.delete(`/api/behaviors/${behaviorId}`);
        commit('REMOVE_BEHAVIOR', behaviorId);
        Toastify({ text: "Comportamento excluído com sucesso!"}).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar comportamento:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message}).showToast();
      }
    }
    
  },
};
