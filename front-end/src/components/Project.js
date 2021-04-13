import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import "../pages/styles/BackButton.css";

const Project = (param) => {
    const [user_project, setUserProject] = new useState('');
    const [user_list, setUserList] = new useState([]);
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
        
        
        const get_project = await fetch(`http://localhost:8888/db/api.php/Project/ProjectOutlineId/` + outline_id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        });
        const project_response = await get_project.json();
        
        if (project_member_response.length != undefined) {
        // Filter through all of the Projects, and check if it matches the ProjectId in the ProjectMembers
            for (let i = 0; i < project_member_response.length; i++) {
                // Project ID of the Project Member
                let proj_memb_pID = project_member_response[i].ProjectId;
                for (let j = 0; j < project_response.length; j++) {
                    // Project ID of the Project?
                    let proj_id = project_response[j].ProjectId;
                    if (proj_memb_pID == proj_id) {
                        setUserProject(project_response[j]);
                        return project_response[j];
                    } 
                }
            }

        } else {
            for (let j = 0; j < project_response.length; j++) {
                let proj_id = project_response[j].ProjectId;
                if (project_member_response.ProjectId == proj_id) {
                    setUserProject(project_response[j]);
                    return project_response[j];
                }
            } 
        }
    }

    const getUserIdOfMembers = async (projectId) => {
        const get_proj_members = await fetch(`http://localhost:8888/db/api.php/ProjectMember/ProjectId/` + projectId, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
        });
        const members_res = await get_proj_members.json();
        return members_res;
    }

    const showUsersInProject = async (userID) => {
        const get_users = await fetch(`http://localhost:8888/db/api.php/User/UserId/` + userID, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
        });
        const users_result = await get_users.json();
        setUserList(user_list => [...user_list, users_result]);
    }

    var user_temp = [];
    var member_result_length = 0;
    // Get the project associated with the current outline and User
    useEffect(() => {
        checkExistingProject().then(function(proj) {
            if (proj) {
                // Get all of the project members
                getUserIdOfMembers(proj.ProjectId).then(function(member_result) {
                    if (member_result != undefined) {
                        // For all of the Project Members, get the User and put them into a list
                        if (member_result.length == undefined) {
                            showUsersInProject(member_result.UserId);
                        } else {
                            for(let i = 0; i < member_result.length; i++) {
                                showUsersInProject(member_result[i].UserId);
                            }
                        }
                        setUserList(user_temp);
                    }
                });
            }
        });
    }, []);
 

    function back() {
        window.history.back();
    }
  
    if (user_list.length === 0) {
        return (
            <> 
                <h2>Your Project</h2>
                <button className="back" onClick={back}>&lt; Outline</button>
                <p>You don't have a project</p>
                <div>
                    <Link to={`/outlines/outline/${outline_id}/project/create`}>
                        <button class="btn btn-success">Create a Project</button>
                    </Link>
                    &nbsp; Or &nbsp;
                    <Link to={`/outlines/outline/${outline_id}/project/join`}>
                        <button class="btn btn-success">Join </button>
                    </Link>
                </div>
            </>
        )
    } else {
        return (
            <> 
                <h2>Your Project</h2>
                <button className="back" onClick={back}>&lt; Outline</button>
                <div>
                    <h4>Team ID: {user_project.ProjectId}</h4>
                    <h5>Name: {user_project.ProjectName}</h5>
                    <h5>Description: {user_project.ProjectDesc}</h5>
                    <h3>Members:</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Full Name</td>
                                <td>Email</td>
                                <td>ID</td>
                            </tr>
                            {
                                user_list.map((user) => (
                                    <tr>
                                        <td>{user.UserFName} {user.UserLName}</td>
                                        <td>{user.UserEmail}</td>
                                        <td>{user.UserId}</td>
                                    </tr>
                                ))
                            }
                        </tbody>
                    </table>
          
                    <Link to={`/outlines/outline/${outline_id}/project/${user_project.ProjectId}/goals`}>
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