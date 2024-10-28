import { createStore } from 'vuex';
import students from './students';
import periods from './periods';
import activities from './activities';
import behaviors from './behaviors';
import classroom from './classroom';

export default createStore({
  modules: {
    classroom,
    behaviors,
    activities,
    students,
    periods  
  }
});
