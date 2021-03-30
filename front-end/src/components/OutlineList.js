import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import outlinesData from '../data/outlines';
import coursesData from '../data/courses';

const OutlineList = (param) => {

    const id = param.id;

    var course = coursesData.filter(c => c.id == id);

    var outlines = outlinesData.filter(c => c.course == id)

    return (
        <> 
            <h2>{course[0].name}</h2>
            <h3>Project Outlines</h3>
            <table>
                <tbody>
                {outlines.map((outline, key) => (
                <React.Fragment key={key}>
                    <tr>
                        <td id="names">{outline.name}</td>
                        <td><Link to={`/outlines/${outline.id}`}>View</Link></td>
                    </tr>
                </React.Fragment>
                ))}
                </tbody>
            </table>
        </>
    )
}
export default OutlineList; 