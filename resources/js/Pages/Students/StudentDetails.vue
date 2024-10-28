<template>
    <Head title="Cadastrar/Editar Aluno" />
    <AuthenticatedLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-8 text-gray-900">
                        <h1 class="text-2xl font-bold text-gray-800 mb-6">
                            {{ this.studentId ? "Editar Aluno" : "Cadastrar Novo Aluno" }}
                        </h1>

                        <form class="space-y-6" @submit.prevent="saveStudent">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome do Aluno
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    placeholder="Digite o nome completo"
                                    v-model="student.name"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>
                            <div>
                                <label for="ra" class="block text-sm font-medium text-gray-700 mb-2">
                                    R.A do Aluno
                                </label>
                                <input
                                    type="text"
                                    id="ra"
                                    placeholder="Digite o R.A"
                                    v-model="student.ra"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>
                            <div>
                                <label for="responsible" class="block text-sm font-medium text-gray-700 mb-2">
                                    Responsável
                                </label>
                                <select
                                    id="responsible"
                                    v-model.number="student.responsible_id"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                    <option value="">Selecione um responsável</option>
                                    <option value="1">Fábio da Silva</option>
                                </select>
                            </div>
                            <div>
                                <label for="classroom" class="block text-sm font-medium text-gray-700 mb-2">
                                    Turma
                                </label>
                                <select
                                    id="classroom"
                                    v-model.number="student.class_id"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                    <option value="">Selecione uma turma</option>
                                    <option value="1">A</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <a href="/students" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition">
                                    Cancelar
                                </a>
                                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                    {{ this.studentId ? "Salvar Alterações" : "Cadastrar" }}
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
    studentId: {
      type: String,
      default: null,
    },
  },
  computed: {
    ...mapState('students', ['student']), // Mapeia student da store
  },
  created() {
    if (this.studentId) {
      this.fetchStudent(this.studentId);
    } else {
      this.$store.commit('students/SET_STUDENT', { name: '', ra: '', responsible_id: null, class_id: null });
    }
  },
  methods: {
    ...mapActions('students', ['fetchStudent', 'updateStudent', 'createStudent']),
    async saveStudent() {
      if (this.studentId) {
        await this.updateStudent(this.student);
      } else {
        await this.createStudent(this.student);
      }
    },
  }
};
</script>
