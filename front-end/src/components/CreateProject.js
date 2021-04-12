import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';
import "../pages/styles/BackButton.css";

const CreateProject = (param) => {
    const [projectName, setProjectName] = useState('');
    const [projectDesc, setProjectDesc] = useState('');
    const outline_id = param.id;
    var students = studentsData;
    function back() {
        window.history.back();
    }

    const CreateProjectEvent = async (e) => {
        e.preventDefault();
        console.log('this is before result');
        console.log(localStorage.getItem("authToken"));
        const result = await fetch(`http://localhost:8888/db/api.php/Project`, {
            method: 'POST',
            body: JSON.stringify({
                projectName,
                projectDesc,
                outline_id
            }),
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        }).then(data => {
            console.log(data);
        });
        console.log("this is before response");
        const response = await result.json();
        console.log("THIS IS THE RESPONSE");
        console.log(response);
        if (response) {
            back();
        }
    }

    return (
        <> 
            <h2>Create A Project</h2>
            <button className="back" onClick={back}>&lt; Projects</button>
            <form className='CreateProject'>
                <label>Outline: {outline_id}</label>
                <div className='form-group'>
                    <label>Project Name</label>
                    <input type='text' className='form-control' id='projectNameInput' value={projectName}
                            onChange={(event) => setProjectName(event.target.value)} />
                </div>
                <div className='form-group'>
                    <label>Description</label>
                    <input type='text' className='form-control' id='projectDescInput' value={projectDesc}
                            onChange={(event) => setProjectDesc(event.target.value)} />
                </div>
                <div>
                    <button onClick={(e) => CreateProjectEvent(e)} className="btn btn-success" id="login-btn">Create Project</button>
                </div>

            </form>
        </>
    )
}
export default CreateProject; 