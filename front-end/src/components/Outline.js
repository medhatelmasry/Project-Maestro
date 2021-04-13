import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import outlinesData from '../data/outlines';
import coursesData from '../data/courses';
import "../pages/styles/BackButton.css";

const Outline = (param) => {

    const id = param.id;

    const [outline, setOutline] = useState([]);
    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch("http://localhost:8888/db/api.php/ProjectOutline", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            });
            const body = await response.json();
            var outlineData = (body.filter(c => c.ProjectOutlineId == id))[0]
            setOutline(outlineData);
        }
        fetchData();
    }, []);

    function back() {
        window.history.back();
    }

    return (
        <> 
            <h2>{outline.ProjectOutlineName}</h2>
            <button className="back" onClick={back}>&lt; All Outlines</button>
            <p>Due Date: {outline.ProjectOutlineEnd}</p>
            <div>
                <label>
                    Description: 
                </label>
                <p>{outline.ProjectOutlineReq}</p>
            </div>
            <p><Link to={`/outlines/outline/${outline.ProjectOutlineId}/project/`}>View Your Project</Link></p>
        </>
    )
}
export default Outline; 