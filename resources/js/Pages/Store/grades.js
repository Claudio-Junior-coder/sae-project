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
    grades: [],
    grade: {},
  },
  
  mutations: {
    SET_GRADES(state, grades) {
      state.grades = grades;
    },
    SET_GRADE(state, grade) {
      state.grade = grade;
    },
    REMOVE_GRADE(state, gradeId) {
      state.grades = state.grades.filter(grade => grade.id !== gradeId);
    },
  },

  actions: {
    async fetchGrades({ commit }) {
      try {
        const { data } = await axios.get('/api/grades');
        commit('SET_GRADES', data);          
      } catch (error) {
        console.error('Erro ao buscar notas:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async fetchGrade({ commit }, gradeId) {
      try {
        const response = await axios.get(`/api/grades/${gradeId}`);
        commit('SET_GRADE', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar a nota com ID ${gradeId}:`, error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async createGrade({ commit }, grade) {
      try {
        const response = await axios.post('/api/grades', grade);
        commit('SET_GRADE', response.data); 
        Toastify({ text: "Nota criada com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar nota:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },
  
    async updateGrade({ commit }, grade) {
      try {
        const response = await axios.put(`/api/grades/${grade.id}`, grade);
        commit('SET_GRADE', response.data);  
        Toastify({ text: "Nota atualizada com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar nota:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deleteGrade({ commit }, gradeId) {
      try {
        const response = await axios.delete(`/api/grades/${gradeId}`);
        commit('REMOVE_GRADE', gradeId);
        Toastify({ text: "Nota excluída com sucesso!" }).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar grade:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    }
    
  },
};
