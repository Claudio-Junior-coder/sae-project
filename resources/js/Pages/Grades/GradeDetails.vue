<template>
  <Head title="Cadastrar/Editar Nota" />
  <AuthenticatedLayout>
      <div class="py-12 bg-gray-50 min-h-screen">
          <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
              <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                  <div class="p-8 text-gray-900">
                      <h1 class="text-2xl font-bold text-gray-800 mb-6">
                          {{ this.gradeId ? "Editar Nota" : "Cadastrar Nova Nota" }}
                      </h1>

                      <form class="space-y-6" @submit.prevent="saveGrade">
                        <div>
                              <label for="studentId" class="block text-sm font-medium text-gray-700 mb-2">
                                  Aluno
                              </label>
                              <select
                                  id="studentId"
                                  v-model.number="grade.student_id"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                  <option value="">Selecione um aluno</option>
                                  <option value="1">Fábio da Silva</option>
                              </select>
                          </div>
                          <div>
                              <label for="periodId" class="block text-sm font-medium text-gray-700 mb-2">
                                  Período
                              </label>
                              <select
                                  id="periodId"
                                  v-model.number="grade.period_id"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                  <option value="">Selecione um periodo</option>
                                  <option value="1">1 semestre</option>
                              </select>
                          </div>
                          <div>
                              <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                  Disciplina
                              </label>
                              <input
                                  type="text"
                                  id="subject"
                                  v-model="grade.subject"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                          </div>
                          <div>
                              <label for="grade" class="block text-sm font-medium text-gray-700 mb-2">
                                  Nota
                              </label>
                              <input
                                  type="text"
                                  id="grade"
                                  v-model.number="grade.grade"
                                  required
                                  class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                          </div>
                          <div class="flex justify-end space-x-3">
                              <a href="/grades" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition">
                                  Cancelar
                              </a>
                              <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                  {{ this.gradeId ? "Salvar Alterações" : "Cadastrar" }}
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
    gradeId: {
      type: String,
      default: null,
    },
  },
  computed: {
    ...mapState('grades', ['grade']), 
  },
  created() {
    if (this.gradeId) {
      this.fetchGrade(this.gradeId);
    } else {
      this.$store.commit('grades/SET_GRADE', { student_id: '', period_id: '', subject: '', grade: '' });
    }
  },
  methods: {
    ...mapActions('grades', ['fetchGrade', 'updateGrade', 'createGrade']),
    async saveGrade() {
      if (this.gradeId) {
        await this.updateGrade(this.grade);
      } else {
        await this.createGrade(this.grade);
      }
    },
  }
};
</script>
