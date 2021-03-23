import React from 'react';

const RegisterPage = () => (
    <React.Fragment>
    <form className='RegisterPage'>
        <label>
            <p>Username</p>
            <input type="text" id="usernameInput"/>
        </label>
        <label>
            <p>Password</p>
            <input type="text" id="passwordInput"/>
        </label>
        <label>
            <p>First Name</p>
            <input type="text" id="firstNameInput"/>
        </label>
        <label>
            <p>Last Name</p>
            <input type="text" id="lastNameInput"/>
        </label>
        <div>
            <p>User Type</p>
        
            <p>
                <input type="radio" name="usertype" id="userTypeInput" value="student"/> Student
            </p>
            <p>
                <input type="radio" name="usertype" id="userTypeInput" value="instructor"/> Instructor
            </p>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
    </React.Fragment>
)

export default RegisterPage;