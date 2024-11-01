<template>
    <Head title="Cadastrar/Editar Período" />
    <AuthenticatedLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-8 text-gray-900">
                        <h1 class="text-2xl font-bold text-gray-800 mb-6">
                            {{ this.periodId ? "Editar Período" : "Cadastrar Novo Período" }}
                        </h1>

                        <form class="space-y-6" @submit.prevent="savePeriod">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome do Período
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    placeholder="Ex: 1 Semestre/Trimestre etc.."
                                    v-model="period.name"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>
<!--                             <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Data Inicial:
                                </label>
                                <input
                                    type="date"
                                    id="start_date"
                                    v-model="period.start_date"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Data Final:
                                </label>
                                <input
                                    type="date"
                                    id="end_date"
                                    v-model="period.end_date"
                                    required
                                    class="block w-full p-3 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div> -->
                            <div class="flex justify-end space-x-3">
                                <a href="/periods" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition">
                                    Cancelar
                                </a>
                                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                    {{ this.periodId ? "Salvar Alterações" : "Cadastrar" }}
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
    periodId: {
      type: String,
      default: null,
    },
  },
  computed: {
    ...mapState('periods', ['period']), 
  },
  created() {
    if (this.periodId) {
      this.fetchPeriod(this.periodId);
    } else {
      this.$store.commit('periods/SET_PERIOD', { name: '', start_date: '', end_date: ''});
    }
  },
  methods: {
    ...mapActions('periods', ['fetchPeriod', 'updatePeriod', 'createPeriod']),
    async savePeriod() {
      if (this.periodId) {
        await this.updatePeriod(this.period);
      } else {
        await this.createPeriod(this.period);
      }
    },
  }
};
</script>
