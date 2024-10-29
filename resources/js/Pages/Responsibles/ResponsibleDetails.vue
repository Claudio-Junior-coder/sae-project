<template>
  <Head title="Cadastrar/Editar Responsável" />
  <AuthenticatedLayout>
      <div class="py-12 bg-gray-50 min-h-screen">
          <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
              <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                  <div class="p-8 text-gray-900">
                      <h1 class="text-2xl font-bold text-gray-800 mb-6">
                          {{ this.responsibleId ? "Editar Responsável" : "Cadastrar Nova Responsável" }}
                      </h1>

                      <form class="space-y-6" @submit.prevent="saveResponsible">
                          <div>
                              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                  Nome
                              </label>
                              <input
                                  type="text"
                                  id="name"
                                  v-model="responsible.name"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                          </div>
                          <div>
                              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                  E-mail
                              </label>
                              <input
                                  type="email"
                                  id="email"
                                  v-model="responsible.email"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                          </div>
                          <div>
                              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                  Senha
                              </label>
                              <input
                                  type="password"
                                  id="password"
                                  v-model="responsible.password"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                          </div>
                          <div class="flex justify-end space-x-3">
                              <a href="/responsibles" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition">
                                  Cancelar
                              </a>
                              <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                  {{ this.responsibleId ? "Salvar Alterações" : "Cadastrar" }}
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
    responsibleId: {
      type: String,
      default: null,
    },
  },
  computed: {
    ...mapState('responsibles', ['responsible']), 
  },
  created() {
    if (this.responsibleId) {
      this.fetchResponsible(this.responsibleId);
    } else {
      this.$store.commit('responsibles/SET_RESPONSIBLE', { name: '', email: '', password: '' });
    }
  },
  methods: {
    ...mapActions('responsibles', ['fetchResponsible', 'updateResponsible', 'createResponsible']),
    async saveResponsible() {
      if (this.responsibleId) {
        await this.updateResponsible(this.responsible);
      } else {
        await this.createResponsible(this.responsible);
      }
    },
  }
};
</script>
