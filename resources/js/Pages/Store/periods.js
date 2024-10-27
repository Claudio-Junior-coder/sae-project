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
    periods: [],
    period: {},
  },
  
  mutations: {
    SET_PERIODS(state, periods) {
      state.periods = periods;
    },
    SET_PERIOD(state, period) {
      state.period = period;
    },
    REMOVE_PERIOD(state, periodId) {
      state.periods = state.periods.filter(period => period.id !== periodId);
    },
  },

  actions: {
    async fetchPeriods({ commit }) {
      try {
        const { data } = await axios.get('/api/periods');
        commit('SET_PERIODS', data);          
      } catch (error) {
        console.error('Erro ao buscar periodos:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },

    async fetchPeriod({ commit }, periodId) {
      try {
        const response = await axios.get(`/api/periods/${periodId}`);
        commit('SET_PERIOD', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar o período com ID ${periodId}:`, error.response ? error.response.data : error.message);
       Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },

    async createPeriod({ commit }, period) {
      try {
        const response = await axios.post('/api/periods', period);
        commit('SET_PERIOD', response.data); 
        Toastify({ text: "Periodo criado com sucesso!"}).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar periodo:', error.response ? error.response.data : error.message);
       Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },
  
    async updatePeriod({ commit }, period) {
      try {
        const response = await axios.put(`/api/periods/${period.id}`, period);
        commit('SET_PERIOD', response.data);  
        Toastify({ text: "Periodo atualizado com sucesso!"}).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar periodo:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deletePeriod({ commit }, periodId) {
      try {
        const response = await axios.delete(`/api/periods/${periodId}`);
        commit('REMOVE_PERIOD', periodId);
        Toastify({ text: "Período excluído com sucesso!"}).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar periodo:', error.response ? error.response.data : error.message);
       Toastify({ text: "" + error.response.data.message}).showToast();
      }
    }
    
  },
};