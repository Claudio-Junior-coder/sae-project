<template>
    <div class="min-h-screen bg-gray-100">
      <!-- Header com o botão de Logout -->
      <header class="flex items-center justify-between p-4 bg-blue-600 text-white shadow-md">
        <h1 class="text-xl font-semibold">Bem-vindo(a), Pai!</h1>
        <button 
          @click="logout" 
          class="px-4 py-2 bg-red-500 rounded-md hover:bg-red-600 transition duration-150"
        >
          Logout
        </button>
      </header>
      
      <!-- Conteúdo principal com a Tabela -->
      <main class="flex items-center justify-center py-12">
        <div class="w-3/4 max-w-4xl bg-white p-8 rounded-lg shadow-lg">
          <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Informações da Tabela</h2>
          
          <table class="w-full text-left border-collapse">
            <thead>
              <tr>
                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Nome</th>
                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Idade</th>
                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in tableData" :key="item.id" class="hover:bg-gray-50">
                <td class="px-4 py-3 border-b border-gray-200">{{ item.name }}</td>
                <td class="px-4 py-3 border-b border-gray-200">{{ item.age }}</td>
                <td class="px-4 py-3 border-b border-gray-200">{{ item.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex';
  
  export default {
    data() {
        return {
        tableData: [
            { id: 1, name: "João", age: 10, status: "Ativo" },
            { id: 2, name: "Maria", age: 12, status: "Inativo" },
            { id: 3, name: "Pedro", age: 8, status: "Ativo" }
        ]
        };
    },
    methods: {
      ...mapActions('auth', ['logout']),
    },
  };
  </script>
  