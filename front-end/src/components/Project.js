import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';

const Project = (param) => {

    const id = param.id;
    
    var students = studentsData;
    var projects = (projectsData.filter(c => c.outlineId == id))
    //Should also filter to check if user is a member of project team
    if (projects.length == 0) {
        return (
            <> 
                <h2>Your Project</h2>
                <p>You don't have a project</p>
                <div>
                    <button>Create a Project</button> Or <Link to={`/outlines/outline/${id}/project/join`}>
                        <button>Join a Team</button></Link>
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
                    memberNames.push(students[i].name)
                }
            }
        }
        return (
            <> 
                <h2>Your Project</h2>
                <div>
                <Link to={`/outlines/outline/${id}/project/${project.id}/goals`}>
                    <button>
                        Project Goals
                    </button>
                </Link>
                    <h4>Team ID: {team.id}</h4>
                    <h3>Members:</h3>
                    <table>
                        <tbody>
                            {
                                memberNames.map((member) => (
                                    <tr>
                                        {member}
                                    </tr>
                                ))
                            }
                        </tbody>
                    </table>
                </div>
            </>
        )
    }
}
export default Project; 