import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';
import "../pages/styles/BackButton.css";

const Project = (param) => {


    const id = param.id;

    const showProjects = async () => {
        const project_res = await fetch(`http://localhost:8888/db/api.php/Project`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        });
        let project_response = await project_res.text();
        console.log(project_response);
        console.log(JSON.parse(project_response));
    }
    var students = studentsData;
    var projects = (projectsData.filter(c => c.outlineId == id))
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
                    <Link to={`/outlines/outline/${id}/project/create`}>
                        <button class="btn btn-success">Create a Project</button>
                    </Link>
                     or 
                    <Link to={`/outlines/outline/${id}/project/join`}>
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
                    <Link to={`/outlines/outline/${id}/project/${project.id}/goals`}>
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