import { createStore } from 'vuex';
import students from './students';
import periods from './periods';
import activities from './activities';
import behaviors from './behaviors';
import classroom from './classroom';
import grades from './grades';

export default createStore({
  modules: {
    grades,
    classroom,
    behaviors,
    activities,
    students,
    periods  
  }
});
