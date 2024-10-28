<template>
    <Head title="Notas" />

    <AuthenticatedLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-lg rounded-lg">
                    <div class="p-8 text-gray-900">
                        <div class="flex justify-between items-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-800">Notas</h1>
                            <a
                                href="/grades/details"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-500 transition">
                                + Cadastrar Novo
                            </a>
                        </div>

                        <div class="flex justify-between items-center mb-6 gap-4">
                            <label class="min-w-[80px] font-medium text-gray-700">Disciplina:</label>
                            <input
                                v-model="filters.subject"
                                type="text"
                                placeholder="nome da disciplina"
                                class="flex-1 p-2 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition"/>
                            
                            <button
                                @click="searchGrades"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                🔍 Pesquisar
                            </button>
                        </div>

                        <table class="w-full border-collapse mt-8 bg-white rounded-lg shadow">
                            <thead>
                                <tr class="text-left bg-blue-50 text-gray-700 uppercase text-sm tracking-wider">
                                    <th class="border p-4">Disciplina</th>
                                    <th class="border p-4">Nota</th>
                                    <th class="border p-4">Editar</th>
                                    <th class="border p-4">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="grade in filteredGrades"
                                    :key="grade.id"
                                    class="hover:bg-gray-100 transition">
                                    <td class="border p-4 text-gray-800">{{ grade.subject }}</td>
                                    <td class="border p-4 text-gray-800">{{ grade.grade }}</td>
                                    <td class="border p-4 text-center">
                                        <a
                                            :href="`/grades/details/${grade.id}`"
                                            class="p-2 bg-yellow-400 text-white rounded-lg shadow hover:bg-yellow-300 transition">
                                            ✏️
                                        </a>
                                    </td>
                                    <td class="border p-4 text-center">
                                        <button
                                            @click="confirmDelete(grade.id)"
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
                subject: '',  
            },
            filteredGrades: [],
        };
    },
    computed: {
        ...mapState('grades', ['grades']),
    },
    created() {
        this.fetchGrades(); 
    },
    methods: {
        ...mapActions('grades', ['fetchGrades', 'deleteGrade']),

        searchGrades() {
            this.filteredGrades = this.grades.filter((grade) => {
                const matchesName = this.filters.subject
                    ? grade.subject.toLowerCase().includes(this.filters.subject.toLowerCase())
                    : true;

                return matchesName;
            });
        },

        async fetchGrades() {
            await this.$store.dispatch('grades/fetchGrades'); 
            this.filteredGrades = this.grades; 
        },

        confirmDelete(gradeId) {
            if (confirm('Realmente deseja remover este registro? (Sim/Não)')) {
                this.deleteGrade(gradeId).then(() => {
                    this.filteredGrades = this.filteredGrades.filter(grade => grade.id !== gradeId);
                });
            }
        },
    }
};

</script>
