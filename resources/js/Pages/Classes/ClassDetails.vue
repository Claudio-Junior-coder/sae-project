<template>
  <Head title="Cadastrar/Editar Classe" />
  <AuthenticatedLayout>
      <div class="py-12 bg-gray-50 min-h-screen">
          <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
              <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                  <div class="p-8 text-gray-900">
                      <h1 class="text-2xl font-bold text-gray-800 mb-6">
                          {{ this.classId ? "Editar Classe" : "Cadastrar Nova Classe" }}
                      </h1>

                      <form class="space-y-6" @submit.prevent="saveClass">
                          <div>
                              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                  Nome da Classe
                              </label>
                              <input
                                  type="text"
                                  id="name"
                                  v-model="classData.name"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                          </div>

                          <div class="flex justify-end space-x-3">
                              <a href="/classes" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition">
                                  Cancelar
                              </a>
                              <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                  {{ this.classId ? "Salvar Alterações" : "Cadastrar" }}
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </AuthenticatedLayout>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
components: {
  AuthenticatedLayout,
  Head,
},
props: {
  classId: {
    type: String,
    default: null,
  },
},
computed: {
  ...mapState('classroom', ['classData']), 
},
created() {
  if (this.classId) {
    this.fetchClass(this.classId);
  } else {
    this.$store.commit('classroom/SET_CLASS', { name: '' });
  }
},
methods: {
  ...mapActions('classroom', ['fetchClass', 'updateClass', 'createClass']),
  async saveClass() {
    if (this.classId) {
      await this.updateClass(this.classData);
    } else {
      await this.createClass(this.classData);
    }
  },
}
};
</script>
