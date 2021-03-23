import React, { useEffect } from 'react';

const LoginPage = () => (
    <React.Fragment>
    <form className='LoginPage'>
        <label>
            <p>Username</p>
            <input type="text" id="usernameInput"/>
        </label>
        <label>
            <p>Password</p>
            <input type="password" id="passwordInput"/>
        </label>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    </React.Fragment>
)

export default LoginPage;