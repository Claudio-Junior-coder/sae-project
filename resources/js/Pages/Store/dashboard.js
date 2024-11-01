// store/modules/dashboard.js
import axios from 'axios';
import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';

const dashboard = {
  namespaced: true,
  state: {
    studentData: null,
  },
  mutations: {
    setStudentData(state, data) {
      state.studentData = data;
    },
  },
  actions: {
    async fetchStudentData({ commit }) {
      try {
        const response = await axios.get('/api/responsibles/dashboard');
        console.log(response.data)
        commit('setStudentData', response.data);
        return response.data;
      } catch (error) {
        console.error('Erro ao buscar dados do aluno:', error);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },
  },
};

export default dashboard;
