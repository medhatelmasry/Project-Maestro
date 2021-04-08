import React, { useState } from 'react';
import Register from '../components/Register';
import "./styles/RegisterPage.css";
import "./styles/BackButton.css";

const RegisterPage = () => (
    <React.Fragment>
    <div className='RegisterPage'>
        <Register/>
    </div>
    </React.Fragment>
)

export default RegisterPage;