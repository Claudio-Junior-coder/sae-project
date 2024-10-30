<template>
    <Head title="Cadastrar/Editar Comportamento" />
    <AuthenticatedLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-8 text-gray-900">
                        <h1 class="text-2xl font-bold text-gray-800 mb-6">
                            {{ this.behaviorId ? "Editar Comportamento" : "Cadastrar Novo Comportamento" }}
                        </h1>

                        <form class="space-y-6" @submit.prevent="saveBehavior">
                          <div>
                                <label for="student" class="block text-sm font-medium text-gray-700 mb-2">
                                    Aluno
                                </label>
                                <select
                                    id="student"
                                    v-model.number="behavior.student_id"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                    <option value="">Selecione um aluno</option>
                                    <option v-for="student in students" :key="student.id" :value="student.id">
                                        {{ student.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="period" class="block text-sm font-medium text-gray-700 mb-2">
                                    Período
                                </label>
                                <select
                                    id="period"
                                    v-model.number="behavior.period_id"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                    <option value="">Selecione um período</option>
                                    <option v-for="period in periods" :key="period.id" :value="period.id">
                                        {{ period.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="comments" class="block text-sm font-medium text-gray-700 mb-2">
                                    Comentário
                                </label>
                                <input
                                    type="text"
                                    id="comments"
                                    v-model="behavior.comments"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>

                            <div class="flex justify-end space-x-3">
                                <a href="/behaviors" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition">
                                    Cancelar
                                </a>
                                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                    {{ this.behaviorId ? "Salvar Alterações" : "Cadastrar" }}
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
    behaviorId: {
      type: String,
      default: null,
    },
  },
  computed: {
    ...mapState('behaviors', ['behavior']), 
    ...mapState('periods', { periods: state => state.periods }),
    ...mapState('students', { students: state => state.students }),
  },
  created() {
    this.fetchPeriods();
    this.fetchStudents();
    if (this.behaviorId) {
      this.fetchBehavior(this.behaviorId);
    } else {
      this.$store.commit('behaviors/SET_BEHAVIOR', { student_id: '', period_id: '', comments: ''});
    }
  },
  methods: {
    ...mapActions('behaviors', ['fetchBehavior', 'updateBehavior', 'createBehavior']),
    ...mapActions('periods', ['fetchPeriods']),
    ...mapActions('students', ['fetchStudents']),
    async saveBehavior() {
      if (this.behaviorId) {
        await this.updateBehavior(this.behavior);
      } else {
        await this.createBehavior(this.behavior);
      }
    },
  }
};

</script>
