import React, { useState } from 'react';
import { Redirect } from 'react-router-dom';
import userValidate from '../js/UserValidate';
import jQuery from 'jquery'

const Register = () => {
    let errors = {};

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [firstName, setFirstName] = useState('');
    const [lastName, setLastName] = useState('');
    const [redirect, setRedirect] = useState(false);
    const [errorMessages, setErrorMessages] = useState({});

    const registerUser = async (e) => {
        e.preventDefault();

        errors = userValidate({
            email: email,
            password: password,
            firstName: firstName,
            lastName: lastName
        });

        setErrorMessages({
            email: errors.email,
            password: errors.password,
            firstName: errors.firstName,
            lastName: errors.lastName
        });
        
        if (jQuery.isEmptyObject(errors)) {
            const result = await fetch(`https://maestroapp.azurewebsites.net/app/registration.php`, {
                method: 'POST',
                body: JSON.stringify({
                email,
                password,
                firstName,
                lastName    
                }),
                headers: {
                  'Content-Type': 'application/json'
                }
              }
              )
              await result.json();
              setRedirect(true);
        }
    }
    if (redirect) {
        return <Redirect to='/login'/>
    }
    return (
        <>
            <div className="panel panel-default position-register">
                <form className='RegisterPage'>
                    <div className="form-group">
                        <label>Email Address:</label>
                        <input type="text" className="form-control"
                            placeholder="Email Address" value={email}
                            onChange={(event) => setEmail(event.target.value)} />
                        <h6 style={{ color: "red", marginTop: 10 }}>{errorMessages.email}</h6>
                    </div>
                    <div className="form-group">
                        <label>Password:</label>
                        <input type="password" className="form-control"
                            placeholder="Password" value={password}
                            onChange={(event) => setPassword(event.target.value)} />
                        <h6 style={{ color: "red", marginTop: 10 }}>{errorMessages.password}</h6>
                    </div>
                    <div className="form-group">
                        <label>First Name: </label>
                        <input type="text" className="form-control"
                            placeholder="First Name" value={firstName}
                            onChange={(event) => setFirstName(event.target.value)} />
                        <h6 style={{ color: "red", marginTop: 10 }}>{errorMessages.firstName}</h6>
                    </div>
                    <div className="form-group">
                        <label>Last Name: </label>
                        <input type="text" className="form-control"
                            placeholder="Last Name" value={lastName}
                            onChange={(event) => setLastName(event.target.value)} />
                        <h6 style={{ color: "red", marginTop: 10 }}>{errorMessages.lastName}</h6>
                        <a href="/login">Already have an account? Login</a>
                    </div>
                    <div>
                        <button onClick={(e) => registerUser(e)} className="btn btn-success" id="register-btn">Register</button>
                    </div>
                    <div>
                    </div>
                </form>
            </div>
        </>
    )
}
export default Register; 