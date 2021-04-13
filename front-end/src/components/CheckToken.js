import React, { useState } from 'react';

const CheckToken = async () => {
    if (localStorage.getItem("email") != undefined && localStorage.getItem("password") != undefined) {
        //const result = await fetch(`https://maestroapp.azurewebsites.net/db/api.php/user`, {
        const email = localStorage.getItem("email");
        const password = localStorage.getItem("password");
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
        if (response.jwt) {
            localStorage.setItem("authToken", response.jwt);
        }
    }
}
export default CheckToken; 