import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import outlinesData from '../data/outlines';
import coursesData from '../data/courses';
import "../pages/styles/BackButton.css";

const OutlineList = (param) => {

    const id = param.id;

    const [outlines, setOutlines] = useState([]);
    const [crsName, setCrsName] = useState();
    useEffect(() => {
        const fetchData = async () => {
            const crs_response = await fetch("http://localhost:8888/db/api.php/CourseList", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            });
            const crs_body = await crs_response.json();
            var courseListData = (crs_body.filter(c => c.CourseListId == id))[0];
            var crsId = courseListData.CourseId
            setCrsName(crsId);
            const response = await fetch("http://localhost:8888/db/api.php/ProjectOutline", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            });
            const body = await response.json();
            var outlineData = (body.filter(c => c.CourseId == crsId))
            setOutlines(outlineData);
        }
        fetchData();
    }, []);

    function back() {
        window.history.back();
    }
    
    return (
        <> 
            <h2>{crsName}</h2>
            <h3>Project Outlines</h3>
            <button className="back" onClick={back}>&lt; Outlines</button>
            <table class="table">
                <tbody>
                {outlines.map((outline, key) => (
                    <tr>
                        <td id="names">{outline.ProjectOutlineName}</td>
                        <td><Link key={key} to={`/outlines/outline/${outline.ProjectOutlineId}`}>View</Link></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
}
export default OutlineList; 