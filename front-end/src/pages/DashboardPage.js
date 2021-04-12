import React from 'react';
import CourseList from './../components/CourseList'
import Logout from './../components/Logout'

const DashboardPage = () => (
    <React.Fragment>
    <div className='DashboardPage'>
        <h2>Welcome Student</h2>
        <h3>User ID: {localStorage.getItem("userID")}</h3>
        <CourseList/>
    </div>
    <Logout/>
    </React.Fragment>
)

export default DashboardPage;