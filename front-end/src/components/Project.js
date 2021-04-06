import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';

const Project = (param) => {

    const id = param.id;
    
    var students = studentsData;
    var projects = (projectsData.filter(c => c.outlineId == id))

    function back() {
        window.history.back();
    }

    //Should also filter to check if user is a member of project team
    if (projects.length == 0) {
        return (
            <> 
                <h2>Your Project</h2>
                <button onClick={back}>&lt; Outline</button>
                <p>You don't have a project</p>
                <div>
                    <button class="btn btn-success">Create a Project</button> or <Link to={`/outlines/outline/${id}/project/join`}>
                        <button class="btn btn-success">Join a Team</button></Link>
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
                <button onClick={back}>&lt; Outline</button>
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