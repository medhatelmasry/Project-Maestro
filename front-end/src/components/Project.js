import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';
import "../pages/styles/BackButton.css";

const Project = (param) => {


    const outline_id = param.id;
    const user_id = localStorage.getItem("userID");

    const showProjects = async () => {
        const get_project_member = await fetch(`http://localhost:8888/db/api.php/ProjectMember`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        });
        let project_response = await get_project_member.json();
        console.log(project_response);
        for (let i = 0; i < project_response.length; i++) {
            console.log(i);
            console.log(project_response[i]);
        }
        console.log("iamge");
        let current_project_member = project_response.filter(project_member => {
            return project_member.UserId == user_id;
        });
        console.log(current_project_member);
        // Once the Project is made, add the current User as a ProjectMember to this Project
        // const member_result = await fetch(`http://localhost:8888/db/api.php/ProjectMember`, {
        // method: 'POST',
        // body: JSON.stringify({
        //     projectMemberID,
        //     userID
        // }),
        // headers: {
        //     'Content-Type': 'application/json',
        //     'Accept': 'application/json',
        //     'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
        // }
        // });
        // const member_response = await member_result.text();
        // if (member_response) {
        //     console.log(member_response);
        //     let back_url = '/outlines/outline/' + projectOutlineId;
        //     return (<Redirect to={back_url} />);
        // }
    }

    
    var students = studentsData;
    var projects = (projectsData.filter(c => c.outlineId == outline_id))
    showProjects();
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