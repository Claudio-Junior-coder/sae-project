<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-1/2 max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-8">Login para Pais</h2>
        <form @submit.prevent="handleLogin">
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-600 mb-2">Email:</label>
            <input 
              type="email" 
              v-model="email" 
              required 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
            />
          </div>
          <div class="mb-8">
            <label class="block text-sm font-medium text-gray-600 mb-2">Senha:</label>
            <input 
              type="password" 
              v-model="password" 
              required 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
            />
          </div>
          <button 
            type="submit" 
            class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-150"
          >
            Login
          </button>
        </form>
        <p v-if="error" class="mt-6 text-sm text-center text-red-500">{{ error }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex';
  
  export default {
    data() {
      return {
        email: '',
        password: '',
        error: null,
      };
    },
    methods: {
      ...mapActions('auth', ['login']),
      async handleLogin() {
        try {
          await this.login({ email: this.email, password: this.password });
        } catch (error) {
          this.error = 'Credenciais inválidas';
        }
      },
    },
  };
  </script>
  