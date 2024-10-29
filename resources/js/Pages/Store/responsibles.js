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
    responsibles: [],
    responsible: {},
  },
  
  mutations: {
    SET_RESPONSIBLES(state, responsibles) {
      state.responsibles = responsibles;
    },
    SET_RESPONSIBLE(state, responsible) {
      state.responsible = responsible;
    },
    REMOVE_RESPONSIBLE(state, responsibleId) {
      state.responsibles = state.responsibles.filter(responsible => responsible.id !== responsibleId);
    },
  },

  actions: {
    async fetchResponsibles({ commit }) {
      try {
        const { data } = await axios.get('/api/responsibles');
        commit('SET_RESPONSIBLES', data);          
      } catch (error) {
        console.error('Erro ao buscar responsáveis:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async fetchResponsible({ commit }, responsibleId) {
      try {
        const response = await axios.get(`/api/responsibles/${responsibleId}`);
        commit('SET_RESPONSIBLE', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar o responsável com ID ${responsibleId}:`, error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async createResponsible({ commit }, responsible) {
      try {
        const response = await axios.post('/api/responsibles', responsible);
        commit('SET_RESPONSIBLE', response.data); 
        Toastify({ text: "Responsável criado com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar responsável:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },
  
    async updateResponsible({ commit }, responsible) {
      try {
        const response = await axios.put(`/api/responsibles/${responsible.id}`, responsible);
        commit('SET_RESPONSIBLE', response.data);  
        Toastify({ text: "Responsável atualizado com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar responsável:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deleteResponsible({ commit }, responsibleId) {
      try {
        const response = await axios.delete(`/api/responsibles/${responsibleId}`);
        commit('REMOVE_RESPONSIBLE', responsibleId);
        Toastify({ text: "Responsável excluído com sucesso!" }).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar responsável:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    }
  },
};
