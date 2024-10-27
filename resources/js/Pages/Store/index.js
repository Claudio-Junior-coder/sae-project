import { createStore } from 'vuex';
import students from './students';
import periods from './periods';

export default createStore({
  modules: {
    students,
    periods  
  }
});
