import React from 'react';

//Creates the landing page with Login and Register button
const LandingPage = () => (
    <React.Fragment>
    <div className='LandingPage'>
        <div className='login'>
            <a href='/login'>
                <button>LOGIN</button>
            </a>
        </div>
        <div className='register'>
            <a href='/register'>
                <button>REGISTER</button>
            </a>
        </div>
    </div>
    </React.Fragment>
)

export default LandingPage;