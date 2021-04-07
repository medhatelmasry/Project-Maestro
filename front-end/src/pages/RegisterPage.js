import React from 'react';

import "./styles/RegisterPage.css"

const RegisterPage = () => (
    <React.Fragment>
    <div className="panel panel-default position-register">
        <form className='RegisterPage'>
            <div className="form-group">
                <label>Username:</label>
                <input type="text" className="form-control" id="usernameInput"/>
            </div>
            <div className="form-group">
                <label>Password:</label>
                <input type="password" className="form-control" id="passwordInput"/>
            </div>
            <div className="form-group">
                <label>First Name:</label>
                <input type="text" className="form-control" id="firstNameInput"/>
            </div>
            <div className="form-group">
                <label>Last Name:</label>
                <input type="text" className="form-control" id="lastNameInput"/>
                <a href="/login">Already have an account? Login</a>
            </div>
            <div>
                <button onClick={() => ""} className="btn btn-success" id="register-btn">Register</button>
            </div>
            <div>
            </div>
        </form>
    </div>
    </React.Fragment>
)

export default RegisterPage;