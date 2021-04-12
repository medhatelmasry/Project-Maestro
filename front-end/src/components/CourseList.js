import React, { useState } from 'react';
import coursesData from '../data/courses';
import { Link } from 'react-router-dom';

const CourseList = (param) => {

    var courses = coursesData;
    return (
        <>  
            <h3>Courses</h3>
            <table class="table">
                <tbody>
                {courses.map((course, key) => (
                    <tr>
                        <td id="names">{course.name}</td>
                        <td><Link key={key} to={`/outlines/${course.id}`}>View</Link></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
}
export default CourseList; 