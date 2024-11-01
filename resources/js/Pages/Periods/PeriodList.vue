<template>
    <Head title="Períodos" />

    <AuthenticatedLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-lg rounded-lg">
                    <div class="p-8 text-gray-900">
                        <div class="flex justify-between items-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-800">Períodos</h1>
                            <a
                                href="/periods/details"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-500 transition">
                                + Cadastrar Novo
                            </a>
                        </div>

                        <div class="flex justify-between items-center mb-6 gap-4">
                            <label class="min-w-[80px] font-medium text-gray-700">Nome:</label>
                            <input
                                v-model="filters.name"
                                type="text"
                                placeholder="Nome do período"
                                class="flex-1 p-2 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition"/>
                            
                            <button
                                @click="searchPeriods"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                🔍 Pesquisar
                            </button>
                        </div>

                        <table class="w-full border-collapse mt-8 bg-white rounded-lg shadow">
                            <thead>
                                <tr class="text-left bg-blue-50 text-gray-700 uppercase text-sm tracking-wider">
                                    <th class="border p-4">Nome</th>
                                   <!--  <th class="border p-4">Data Inicial</th>
                                    <th class="border p-4">Data Final</th> -->
                                    <th class="border p-4">Editar</th>
                                    <th class="border p-4">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="period in filteredPeriods"
                                    :key="period.id"
                                    class="hover:bg-gray-100 transition">
                                    <td class="border p-4 text-gray-800">{{ period.name }}</td>
                                  <!--   <td class="border p-4 text-gray-800">{{ formatDate(period.start_date) }}</td>
                                    <td class="border p-4 text-gray-800">{{ formatDate(period.end_date) }}</td> -->
                                    <td class="border p-4 text-center">
                                        <a
                                            :href="`/periods/details/${period.id}`"
                                            class="p-2 bg-yellow-400 text-white rounded-lg shadow hover:bg-yellow-300 transition">
                                            ✏️
                                        </a>
                                    </td>
                                    <td class="border p-4 text-center">
                                        <button
                                            @click="confirmDelete(period.id)"
                                            class="p-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-400 transition">
                                            🗑️
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
    data() {
        return {
            filters: {
                name: '',  
            },
            filteredPeriods: [],
        };
    },
    computed: {
        ...mapState('periods', ['periods']),
    },
    created() {
        this.fetchPeriods(); 
    },
    methods: {
        ...mapActions('periods', ['fetchPeriods', 'deletePeriod']),

        searchPeriods() {
        this.filteredPeriods = this.periods.filter((period) => {
            const matchesName = this.filters.name
            ? period.name.toLowerCase().includes(this.filters.name.toLowerCase())
            : true;

            return matchesName;
        });
        },

        async fetchPeriods() {
            await this.$store.dispatch('periods/fetchPeriods'); 
            this.filteredPeriods = this.periods; 
        },

        confirmDelete(periodId) {
            if (confirm('Realmente deseja remover este registro? (Sim/Não)')) {
                this.deletePeriod(periodId).then(() => {
                    this.filteredPeriods = this.filteredPeriods.filter(period => period.id !== periodId);
                });
            }
        },
        
        /* formatDate(date) {
            const parsedDate = new Date(date + 'T00:00:00'); // Adiciona hora para evitar ajuste de fuso horário
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return parsedDate.toLocaleDateString('pt-BR', options);
        }, */
    }
  };
  </script>