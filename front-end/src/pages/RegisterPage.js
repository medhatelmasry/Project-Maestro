import React, { useState } from 'react';
import axios from 'axios';
import jQuery from 'jquery';
import { Redirect } from 'react-router-dom';
import userValidate from '../js/UserValidate';
import "./styles/RegisterPage.css"

<<<<<<< HEAD

const RegisterPage = () => {
    let errors = {};

    const [userName, setUserName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [firstName, setFirstName] = useState('');
    const [lastName, setLastName] = useState('');
    const [redirect, setRedirect] = useState(false);
    const [errorMessages, setErrorMessages] = useState({});

    const registerUser = (e) => {
        e.preventDefault();

        let formData = new FormData();

        formData.append("userName", userName);
        formData.append("email", email);
        formData.append("password", password);
        formData.append("firstName", firstName);
        formData.append("lastName", lastName);

        errors = userValidate({
            userName: userName,
            email: email,
            password: password,
            firstName: firstName,
            lastName: lastName
        });

        setErrorMessages({
            userName: errors.userName,
            email: errors.email,
            password: errors.password,
            firstName: errors.firstName,
            lastName: errors.lastName
        });

        if (jQuery.isEmptyObject(errors)) {
            axios.post("http://localhost:8080/db/api/", formData)
                .then(() => {
                    setRedirect(true);
                }
                )
                .catch(err => console.log(err));
        }
    }

    if (redirect) {
        return <Redirect to='/' />
    }

    return (
        <React.Fragment>
            <div className="panel panel-default position-register">
                <form className='RegisterPage'>
                    <div className="form-group">
                        <label>Username:</label>
                        <input type="text" className="form-control"
                            placeholder="Username" value={userName}
                            onChange={(event) => setUserName(event.target.value)} />
                        <h6 style={{ color: "red", marginTop: 10 }}>{errorMessages.userName}</h6>
                    </div>
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
=======
const RegisterPage = () => (
    <React.Fragment>
    <div className="panel panel-default position-register">
        <form className='RegisterPage'>
            <div className="form-group">
                <label>Email:</label>
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
>>>>>>> aa9021ebb5ac7befda8e64fdbdf1507cb3e7c90c
            </div>
        </React.Fragment>
    )
}

export default RegisterPage;