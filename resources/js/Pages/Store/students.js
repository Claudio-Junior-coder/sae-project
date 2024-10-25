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
    students: [],
    student: {},
  },
  
  mutations: {
    SET_STUDENTS(state, students) {
      state.students = students;
    },
    SET_STUDENT(state, student) {
      state.student = student;
    },
    REMOVE_STUDENT(state, studentId) {
      state.students = state.students.filter(student => student.id !== studentId);
    },
  },

  actions: {
    async fetchStudents({ commit }) {
      try {
        const { data } = await axios.get('/api/students');
        commit('SET_STUDENTS', data);          
      } catch (error) {
        console.error('Erro ao buscar alunos:', error.response ? error.response.data : error.message);
        Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },

    async fetchStudent({ commit }, studentId) {
      try {
        const response = await axios.get(`/api/students/${studentId}`);
        commit('SET_STUDENT', response.data);  
        return response.data;
      } catch (error) {
        console.error(`Erro ao buscar o aluno com ID ${studentId}:`, error.response ? error.response.data : error.message);
       Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },

    async createStudent({ commit }, student) {
      try {
        const response = await axios.post('/api/students', student);
        commit('SET_STUDENT', response.data); 
        Toastify({ text: "Aluno criado com sucesso!"}).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao criar aluno:', error.response ? error.response.data : error.message);
       Toastify({ text: "" + error.response.data.message}).showToast();
      }
    },
  
    async updateStudent({ commit }, student) {
      try {
        const response = await axios.put(`/api/students/${student.id}`, student);
        commit('SET_STUDENT', response.data);  
        Toastify({ text: "Aluno atualizado com sucesso!"}).showToast();
        return response.data; 
      } catch (error) {
        console.error('Erro ao atualizar aluno:', error.response ? error.response.data : error.message);
        Toastify({ text: error.response.data.message, background: "linear-gradient(to right, #5e2129, #ff0000)" }).showToast();
      }
    },

    async deleteStudent({ commit }, studentId) {
      try {
        const response = await axios.delete(`/api/students/${studentId}`);
        commit('REMOVE_STUDENT', studentId);
        Toastify({ text: "Aluno excluído com sucesso!"}).showToast();
        return response.data;
      } catch (error) {
        console.error('Erro ao deletar aluno:', error.response ? error.response.data : error.message);
       Toastify({ text: "" + error.response.data.message}).showToast();
      }
    }
    
  },
};