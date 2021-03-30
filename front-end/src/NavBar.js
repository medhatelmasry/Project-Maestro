import React from 'react';
import { Link } from 'react-router-dom';

const NavBar = () => (
  <>
    <nav className="navbar navbar-expand-sm bg-dark navbar-dark">
    <div className="navbar-brand">Placeholder Links to Wireframes:</div>
      {/*<a className="navbar-brand" href="/">Project Maestro</a>*/}
      <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav mr-auto">
          <li className="nav-item active">
                <Link className="nav-link" to="/dashboard">Dashboard</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/outlines">Project Outlines</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/outline">Project Outline</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/project">Project</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/jointeam">Join Team</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/projectgoals">Project Goals</Link>
            </li>
          </ul>
        </div>
    </nav>
  </>
);
export default NavBar;
