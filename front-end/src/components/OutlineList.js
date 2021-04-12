import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import outlinesData from '../data/outlines';
import coursesData from '../data/courses';
import "../pages/styles/BackButton.css";

const OutlineList = (param) => {

    const id = param.id;

    var course = coursesData.filter(c => c.id == id);

    var outlines = outlinesData.filter(c => c.course == id)

    function back() {
        window.history.back();
    }

    return (
        <> 
            <h2>{course[0].name}</h2>
            <h3>Project Outlines</h3>
            <button className="back" onClick={back}>&lt; Courses</button>
            <table class="table">
                <tbody>
                {outlines.map((outline, key) => (
                    <tr>
                        <td id="names">{outline.name}</td>
                        <td><Link key={key} to={`/outlines/outline/${outline.id}`}>View</Link></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
}
export default OutlineList; 