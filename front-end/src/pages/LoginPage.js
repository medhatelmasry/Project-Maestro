import React, { useEffect, useState } from 'react';

import "./styles/LoginPage.css"

const LoginPage = () => {
    const [Username, setUsername] = useState('');
    const [Password, setPassword] = useState('');   
    
    const LoginEvent = async () => {
        const result = await fetch("http://localhost:8080", {
            method: 'GET',
            body: JSON.stringify({
                Username,
                Password
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        });
        console.log("User attempted sign in:\n" + result);
    }

    return (
        <React.Fragment>
            <div className="panel panel-default position-login">
                <form className='LoginPage'>
                    <div className="form-group">
                        <label>Username:</label>
                        <input type="text" className="form-control" id="usernameInput" value={Username} 
                                onChange={(event) => setUsername(event.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>Password:</label>
                        <input type="password" className="form-control" id="passwordInput" value={Password}
                                onChange={(event) => setPassword(event.target.value)} />
                        <a href="/register">Don't have an account? Register</a>
                    </div>
                    <div>
                        <button onClick={() => LoginEvent()} className="btn btn-success" id="login-btn">Login</button>
                    </div>
                    <div>
                    </div>
                </form>
            </div>
        </React.Fragment>
    )
}

export default LoginPage;