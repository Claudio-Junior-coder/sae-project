<template>
    <Head title="Alunos" />

    <AuthenticatedLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-lg rounded-lg">
                    <div class="p-8 text-gray-900">
                        <div class="flex justify-between items-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-800">Alunos</h1>
                            <a
                                href="/students/details"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-500 transition">
                                + Cadastrar Novo
                            </a>
                        </div>

                        <div class="flex justify-between items-center mb-6 gap-4">
                            <label class="min-w-[80px] font-medium text-gray-700">Nome:</label>
                            <input
                                v-model="filters.name"
                                type="text"
                                placeholder="Nome do aluno"
                                class="flex-1 p-2 border rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition"/>
                            
                            <button
                                @click="searchStudents"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                🔍 Pesquisar
                            </button>
                        </div>

                        <table class="w-full border-collapse mt-8 bg-white rounded-lg shadow">
                            <thead>
                                <tr class="text-left bg-blue-50 text-gray-700 uppercase text-sm tracking-wider">
                                    <th class="border p-4">Nome</th>
                                    <th class="border p-4">R.A</th>
                                    <th class="border p-4">Editar</th>
                                    <th class="border p-4">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="student in filteredStudents"
                                    :key="student.id"
                                    class="hover:bg-gray-100 transition">
                                    <td class="border p-4 text-gray-800">{{ student.name }}</td>
                                    <td class="border p-4 text-gray-800">{{ student.ra }}</td>
                                    <td class="border p-4 text-center">
                                        <a
                                            :href="`/students/details/${student.id}`"
                                            class="p-2 bg-yellow-400 text-white rounded-lg shadow hover:bg-yellow-300 transition">
                                            ✏️
                                        </a>
                                    </td>
                                    <td class="border p-4 text-center">
                                        <button
                                            @click="confirmDelete(student.id)"
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
            filteredStudents: [],
        };
    },
    computed: {
        ...mapState('students', ['students']),
    },
    created() {
        this.fetchStudents(); 
    },
    methods: {
        ...mapActions('students', ['fetchStudents', 'deleteStudent']),

        searchStudents() {
        this.filteredStudents = this.students.filter((student) => {
            const matchesName = this.filters.name
            ? student.name.toLowerCase().includes(this.filters.name.toLowerCase())
            : true;

            return matchesName;
        });
        },

        async fetchStudents() {
            await this.$store.dispatch('students/fetchStudents'); 
            this.filteredStudents = this.students; 
        },

        confirmDelete(studentId) {
            if (confirm('Realmente deseja remover este registro? (Sim/Não)')) {
                this.deleteStudent(studentId).then(() => {
                this.filteredStudents = this.filteredStudents.filter(student => student.id !== studentId);
                
                //mesagem de sucesso
                });
            }
        },
        
    }
  };
  </script>