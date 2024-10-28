import { createStore } from 'vuex';
import students from './students';
import periods from './periods';
import activities from './activities';
import behaviors from './behaviors';

export default createStore({
  modules: {
    behaviors,
    activities,
    students,
    periods  
  }
});
