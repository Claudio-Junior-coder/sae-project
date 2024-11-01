<template>
  <div class="min-h-screen bg-gray-100">
    <header class="flex items-center justify-between p-4 bg-blue-600 text-white shadow-md">
      <h1 class="text-xl font-semibold">Bem-vindo(a), Pai!</h1>
      <button 
        @click="logout" 
        class="px-4 py-2 bg-red-500 rounded-md hover:bg-red-600 transition duration-150"
      >
        Logout
      </button>
    </header>

    <main class="flex items-center justify-center py-12">
      <div class="w-3/4 max-w-4xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Informações do Aluno: <p v-if="studentData && studentData.grades && studentData.grades.length" class="font-semibold text-blue-700 mb-6 text-center">{{ studentData.student }}</p></h2>
        <p v-if="studentData && studentData.grades && studentData.grades.length" class="font-semibold text-gray-700 mb-6 text-center">
          Média Final: {{ studentData.final_grade }} | Status: {{ studentData.approval_status }}
        </p>
        <table v-if="studentData && studentData.grades && studentData.grades.length" class="w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Período</th>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Disciplina</th>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Nota</th>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Comportamento</th>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Atividades Pendentes</th>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Próximas Provas</th>
              <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-600">Último Aviso</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="grade in studentData.grades" :key="grade.id" class="hover:bg-gray-50">
              <td class="px-4 py-3 border-b border-gray-200">{{ grade.period.name }}</td>
              <td class="px-4 py-3 border-b border-gray-200">{{ grade.subject }}</td>
              <td class="px-4 py-3 border-b border-gray-200">{{ grade.grade }}</td>
              <td class="px-4 py-3 border-b border-gray-200">{{ getBehavior(grade.period_id) }}</td>
              <td class="px-4 py-3 border-b border-gray-200">{{ getPendingActivity(grade.period_id) }}</td>
              <td class="px-4 py-3 border-b border-gray-200">{{ getNextExam(grade.period_id) }}</td>
              <td class="px-4 py-3 border-b border-gray-200">{{ getLastNotice(grade.period_id) }}</td>
            </tr>
          </tbody>
        </table>      
        <p v-else class="text-center text-gray-600">Carregando dados...</p>
      </div>
    </main>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';

export default {
  computed: {
    ...mapState('dashboard', ['studentData']),
  },
  methods: {
    ...mapActions('auth', ['logout']),
    ...mapActions('dashboard', ['fetchStudentData']),
    getBehavior(periodId) {
      const behavior = this.studentData.behaviors.find(b => b.period_id === periodId);
      return behavior ? behavior.comments : 'Sem registro';
    },
    getPendingActivity(periodId) {
      const activity = this.studentData.activities.find(a => a.period_id === periodId && a.type === 0);
      return activity ? activity.description : 'Nenhuma';
    },
    getNextExam(periodId) {
      const exam = this.studentData.activities.find(a => a.period_id === periodId && a.type === 1);
      return exam ? exam.description : 'Nenhuma';
    },
    getLastNotice(periodId) {
      const notice = this.studentData.activities.find(a => a.period_id === periodId && a.type === 2);
      return notice ? notice.description : 'Nenhum';
    },
  },
  mounted() {
    const token = localStorage.getItem('authTokenResponsible');
    if (!token) {
       return window.location = '/responsibles/login';
    }
    this.fetchStudentData();
  },
};
</script>
