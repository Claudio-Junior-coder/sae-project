import { createStore } from 'vuex';
import students from './students';
import periods from './periods';
import activities from './activities';

export default createStore({
  modules: {
    activities,
    students,
    periods  
  }
});
