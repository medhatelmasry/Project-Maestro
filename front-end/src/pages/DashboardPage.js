import React from 'react';
import CourseList from './../components/CourseList'

const DashboardPage = () => (
    <React.Fragment>
    <div className='DashboardPage'>
        <h2>Welcome Student</h2>
        <CourseList/>
    </div>
    </React.Fragment>
)

export default DashboardPage;