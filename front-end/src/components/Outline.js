import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import outlinesData from '../data/outlines';
import coursesData from '../data/courses';

const Outline = (param) => {

    const id = param.id;

    var outline = (outlinesData.filter(c => c.id == id))[0]

    function back() {
        window.history.back();
    }

    return (
        <> 
            <h2>{outline.name}</h2>
            <button onClick={back}>&lt; All Outlines</button>
            <p>Due Date: {outline.dueDate}</p>
            <div>
                <label>
                    Description: 
                </label>
                <p>{outline.description}</p>
            </div>
            <p><Link to={`/outlines/outline/${outline.id}/project/`}>View Your Project</Link></p>
        </>
    )
}
export default Outline; 