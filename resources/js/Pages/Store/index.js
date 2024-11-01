import { createStore } from 'vuex';
import students from './students';
import periods from './periods';
import activities from './activities';
import behaviors from './behaviors';
import classroom from './classroom';
import grades from './grades';
import responsibles from './responsibles';
import authModule from './authModule';
import dashboard from './dashboard';

export default createStore({
  modules: {
    dashboard,
    auth: authModule,
    responsibles,
    grades,
    classroom,
    behaviors,
    activities,
    students,
    periods  
  }
});
