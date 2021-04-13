import React, { useState } from 'react';
import { Redirect } from 'react-router';
import studentsData from '../data/students';
import "../pages/styles/BackButton.css";

const CreateProject = (param) => {
    const [projectName, setProjectName] = useState('');
    const [projectDesc, setProjectDesc] = useState('');
    const projectOutlineId = param.id;
    var students = studentsData;
    function back() {
        window.history.back();
    }

    const CreateProjectEvent = async (e) => {
        e.preventDefault();
        // Make the Project
        const result = await fetch(`http://localhost:8888/db/api.php/Project`, {
            method: 'POST',
            body: JSON.stringify({
                projectName,
                projectDesc,
                projectOutlineId
            }),
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        })

        const response = await result.json();
        if (response) {
            console.log(response);
            let projectId = response;
            let userID = localStorage.getItem("userID");
            console.log(userID);
            // Once the Project is made, add the current User as a ProjectMember to this Project
            const member_result = await fetch(`http://localhost:8888/db/api.php/ProjectMember`, {
                method: 'POST',
                body: JSON.stringify({
                    projectId,
                    userID
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            })
            const member_response = await member_result.text();
            if (member_response) {
                console.log(member_response);
                let back_url = '/outlines/outline/' + projectOutlineId + "/project";
                setTimeout(() => {
                    window.location.href = back_url;
                }, 1000)
                
                // return (<Redirect to={back_url} />);
            }
        }
       
    }

    return (
        <> 
            <h2>Create A Project</h2>
            <button className="back" onClick={back}>&lt; Projects</button>
            <form className='CreateProject'>
                <label>Outline: {projectOutlineId}</label>
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