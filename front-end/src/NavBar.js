import React from 'react';
import { Link } from 'react-router-dom';

const NavBar = () => (
  <>
    <nav className="navbar navbar-expand-sm bg-dark navbar-dark">
      <a className="navbar-brand" href="/">Project Maestro</a>
      <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav mr-auto">
          <li className="nav-item active">
                <Link className="nav-link" to="/dashboard">Dashboard</Link>
            </li>
          </ul>
        </div>
    </nav>
  </>
);
export default NavBar;
