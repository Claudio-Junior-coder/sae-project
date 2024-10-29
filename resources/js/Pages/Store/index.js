import { createStore } from 'vuex';
import students from './students';
import periods from './periods';
import activities from './activities';
import behaviors from './behaviors';
import classroom from './classroom';
import grades from './grades';
import responsibles from './responsibles';

export default createStore({
  modules: {
    responsibles,
    grades,
    classroom,
    behaviors,
    activities,
    students,
    periods  
  }
});
