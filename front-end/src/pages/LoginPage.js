import React, { useEffect, useState } from 'react';
import Login from '../components/Login';
import "./styles/BackButton.css";
import "./styles/LoginPage.css"

const LoginPage = () => (
    <React.Fragment>
    <div className='LoginPage'>
        <Login/>
    </div>
    </React.Fragment>
)

export default LoginPage;