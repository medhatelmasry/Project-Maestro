import React, { useEffect } from 'react';

import "./styles/LoginPage.css"

const LoginPage = () => (
    <React.Fragment>
    <div className="panel panel-default position-login">
        <form className='LoginPage'>
            <div className="form-group">
                <label>Username:</label>
                <input type="text" className="form-control" id="usernameInput"/>
            </div>
            <div className="form-group">
                <label>Password:</label>
                <input type="password" className="form-control" id="passwordInput"/>
                <a href="/register">Don't have an account? Register</a>
            </div>
            <div>
                <button onClick={() => ""} className="btn btn-success" id="login-btn">Login</button>
            </div>
            <div>
            </div>
        </form>
    </div>
    </React.Fragment>
)

export default LoginPage;