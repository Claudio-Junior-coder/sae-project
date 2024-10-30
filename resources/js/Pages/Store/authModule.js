
import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';
import axios from 'axios';

const token = localStorage.getItem('authTokenResponsible');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

const authModule = {
  namespaced: true,
  state: {
    authToken: localStorage.getItem('authTokenResponsible') || null,
  },
  mutations: {
    setAuthToken(state, token) {
      state.authToken = token;
      localStorage.setItem('authTokenResponsible', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },
    clearAuthToken(state) {
      state.authToken = null;
      localStorage.removeItem('authTokenResponsible');
      delete axios.defaults.headers.common['Authorization'];
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/api/responsibles/login', credentials);
        const token = response.data.token;
        commit('setAuthToken', token);
        window.location = '/responsibles/dashboard';
      } catch (error) {
        console.error('Login failed:', error);
        Toastify({ text: "" + error.response.data.message }).showToast();
      }
    },
    logout({ commit }) {
      commit('clearAuthToken');
      window.location = '/responsibles/login';
    },
  },
};

export default authModule;
