import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';
import "../pages/styles/BackButton.css";

const Project = (param) => {


    const outline_id = param.id;
    const user_id = localStorage.getItem("userID");

    const checkExistingProject = async () => {
        const get_project_member = await fetch(`http://localhost:8888/db/api.php/ProjectMember/UserId/` + user_id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        });
        const project_member_response = await get_project_member.json();
        console.log(project_member_response);
        
        const get_project = await fetch(`http://localhost:8888/db/api.php/Project/ProjectOutlineId/` + outline_id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        });
        const project_response = await get_project.json();
        console.log(project_response);

        // Filter through all of the Projects, and check if it matches the ProjectId in the ProjectMembers
        for (let i = 0; i < project_member_response.length; i++) {
            let proj_memb_pID = project_member_response[i].ProjectId;
            for (let j = 0; j < project_response.length; j++) {
                let proj_id = project_response[j].ProjectId;
                if (proj_memb_pID == proj_id) {
                    console.log(project_member_response[i]);
                    console.log(project_response[j]);
                    console.log("THEY are equal");
                    return project_response[j];
                } 
            }
        }
    }

    
    var students = studentsData;
    var projects = (projectsData.filter(c => c.outlineId == outline_id))
    var user_project = checkExistingProject();
    if (user_project != undefined) {
        console.log(user_project);
    } else {
        console.log("its undefined");
    }

    function back() {
        window.history.back();
    }

    //Should also filter to check if user is a member of project team
    if (projects.length == 0) {
        return (
            <> 
                <h2>Your Project</h2>
                <button className="back" onClick={back}>&lt; Outline</button>
                <p>You don't have a project</p>
                <div>
                    <Link to={`/outlines/outline/${outline_id}/project/create`}>
                        <button class="btn btn-success">Create a Project</button>
                    </Link>
                     or 
                    <Link to={`/outlines/outline/${outline_id}/project/join`}>
                        <button class="btn btn-success">Join a Team</button>
                    </Link>
                </div>
            </>
        )
    } else {
        var project = projects[0]
        var team = (teamsData.filter(c => c.projectId == project.id))[0]
        var memberNames = [];
        for (var i = 0; i < students.length; i++) {
            for (var j = 0; j < team.members.length; j++) {
                if (students[i].id == team.members[j]) {
                    memberNames.push({"name": students[i].name, "id": students[i].id})
                }
            }
        }
        return (
            <> 
                <h2>Your Project</h2>
                <button className="back" onClick={back}>&lt; Outline</button>
                <div>
                    <h4>Team ID: {team.id}</h4>
                    <h3>Members:</h3>
                    <table class="table">
                        <tbody>
                            {
                                memberNames.map((member) => (
                                    <tr>
                                        <td>{member.name}</td>
                                        <td>{member.id}</td>
                                    </tr>
                                ))
                            }
                        </tbody>
                    </table>
                    <Link to={`/outlines/outline/${outline_id}/project/${project.id}/goals`}>
                    <button class="btn btn-success">
                        Project Goals
                    </button>
                </Link>
                </div>
            </>
        )
    }
}
export default Project; 