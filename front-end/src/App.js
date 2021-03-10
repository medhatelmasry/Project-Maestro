import HomePage from './pages/HomePage';
import AboutPage from './pages/AboutPage';
import ToonListPage from './pages/ToonListPage';
import ToonDetailPage from './pages/ToonDetailPage';
import NotFoundPage from './pages/NotFoundPage';
import NavBar from './NavBar';

import 'bootstrap/dist/css/bootstrap.css';
import 'jquery/dist/jquery.min.js';
import 'popper.js/dist/umd/popper.min.js';
import 'bootstrap/dist/js/bootstrap.min.js';

import {
  BrowserRouter as Router,
  Route,
  Switch
} from 'react-router-dom';

function App() {
  return (
    <Router>
      <NavBar />
      <div className="container">
        <Switch>
          <Route path="/" component={HomePage} exact />
          <Route path="/about" component={AboutPage} exact />
          <Route path="/list" component={ToonListPage} exact />
          <Route path="/detail/:id" component={ToonDetailPage} exact />
          <Route component={NotFoundPage} />
        </Switch>
      </div>
    </Router>
  );
}

export default App;
