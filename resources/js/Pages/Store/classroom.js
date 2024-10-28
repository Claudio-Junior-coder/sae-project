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
    classes: [],
    classData: {},
  },
  
  mutations: {
    SET_CLASSES(state, classes) {
      state.classes = classes;
    },
    SET_CLASS(state, classItem) {
      state.classData = classItem;
    },
    REMOVE_CLASS(state, classId) {
      state.classes = state.classes.filter(classItem => classItem.id !== classId);
    },
  },

  actions: {
    async fetchClasses({ commit }) {
      try {
        const { data } = await axios.get('/api/classes');
        commit('SET_CLASSES', data);          
      } catch (error) {
        console.error('Erro ao buscar classes:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async fetchClass({ commit }, classId) {
      try {
        const response = await axios.get(`/api/classes/${classId}`);
        commit('SET_CLASS', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar a classe com ID ${classId}:`, error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },

    async createClass({ commit }, classItem) {
      try {
        const response = await axios.post('/api/classes', classItem);
        commit('SET_CLASS', response.data); 
        Toastify({ text: "Classe criada com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar classe:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },
  
    async updateClass({ commit }, classItem) {
      try {
        const response = await axios.put(`/api/classes/${classItem.id}`, classItem);
        commit('SET_CLASS', response.data);  
        Toastify({ text: "Classe atualizada com sucesso!" }).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar classe:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deleteClass({ commit }, classId) {
      try {
        const response = await axios.delete(`/api/classes/${classId}`);
        commit('REMOVE_CLASS', classId);
        Toastify({ text: "Classe excluída com sucesso!" }).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar classe:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    }
  },
};
