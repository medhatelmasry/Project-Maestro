import React, { useState } from 'react';

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    
    const LoginEvent = async (e) => {
        e.preventDefault();
        // const result = await fetch(`https://maestroapp.azurewebsites.net/app/student_login_validation.php`, {
        const result = await fetch(`http://localhost:8888/app/student_login_validation.php`, {
                method: 'POST',
                body: JSON.stringify({
                    email,
                    password
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            const response = await result.json();
            if (response.id && response.jwt) {
                alert("Student login successful.");
                localStorage.setItem("userID", response.id);
                localStorage.setItem("authToken", response.jwt);
                localStorage.setItem("email", email);
                localStorage.setItem("password", password);
                localStorage.setItem("expireAt", response.expireAt);
                window.location.href = "/";
            } else {
                alert("Student login failed.");
            }
    }
    return (
        <>
            <div className="panel panel-default position-login">
                <form className='Login'>
                    <div className="form-group">
                        <label>Email:</label>
                        <input type="text" className="form-control" id="emailInput" value={email} 
                                onChange={(event) => setEmail(event.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>Password:</label>
                        <input type="password" className="form-control" id="passwordInput" value={password}
                                onChange={(event) => setPassword(event.target.value)} />
                        <a href="/register">Don't have an account? Register</a>
                    </div>
                    <div>
                        <button onClick={(e) => LoginEvent(e)} className="btn btn-success" id="login-btn">Login</button>
                    </div>
                    <div>
                    </div>
                </form>
            </div>
        </>
    )
}
export default Login; 