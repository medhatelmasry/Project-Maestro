import React, { useState } from 'react';

const Logout = () => {

    const LogoutEvent = (e) => {
        e.preventDefault();
        localStorage.removeItem("userID");
        localStorage.removeItem("authToken");
        localStorage.removeItem("email");
        localStorage.removeItem("password");
        localStorage.removeItem("expireAt");

        window.location.href = "/";
    }

    return (
        <>
            <div>
                <button onClick={(e) => LogoutEvent(e)} className="btn btn-success" id="login-btn">Logout</button>
            </div>
        </>
    )
}
export default Logout; 