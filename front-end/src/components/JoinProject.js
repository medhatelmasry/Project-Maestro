import React, { useEffect, useState } from 'react';
import { Redirect } from 'react-router';
import studentsData from '../data/students';
import "../pages/styles/BackButton.css";

const JoinProject = (param) => {
    const [projectList, setProjectList] = useState([]);
    const outline_id = param.id;
    function back() {
        window.history.back();
    }

    const ShowAllProjects = async () => {
        // Make the Project
        const get_project = await fetch(`http://localhost:8888/db/api.php/Project/ProjectOutlineId/` + outline_id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            });
            const project_response = await get_project.json();
            setProjectList(project_response);
    }

    const JoinTeam = async (ProjectId) => {
        let UserId = localStorage.getItem("userID");
        const response = await fetch(`http://localhost:8888/db/api.php/ProjectMember`, {
            method: 'POST',
            body: JSON.stringify({
                ProjectId,
                UserId
            }),
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        })
        back();
    }
    
    useEffect(() => {
        ShowAllProjects();
    }, []);

    console.log(projectList);
    console.log(projectList.length);



    // if (projectList.length != 0) {
    //     return (
    //         <> 
    //             <h2>Join A Team</h2>
    //             <button className="back" onClick={back}>&lt; Projects</button>
    //             <table class="table">
    //                         <tbody>
    //                             <tr>
    //                                 <td>Project</td>
    //                             </tr>
    //                             {
    //                                 projectList.map((project) => (
    //                                     <tr>
    //                                         <td>{project.ProjectName}</td>
    //                                         <td>{project.ProjectDesc}</td>
    //                                         <td><button onClick={(e) => JoinTeam(project.ProjectId)}  className="btn btn-primary">Join</button></td>
    
    //                                     </tr>
    //                                 ))
    //                             }
    //                         </tbody>
    //                     </table>
    //         </>
    //     )
    // } else {
    //     return (
    //         <> 
    //             <h2>Join A Team</h2>
    //             <button className="back" onClick={back}>&lt; Projects</button>
    //             <table class="table">
    //                         <tbody>
    //                             <tr>
    //                                 <td>There are no Projects</td>
    //                             </tr>
    //                         </tbody>
    //                     </table>
    //         </>
    //     )
    // }

    if (Array.isArray(projectList)) {
        if (projectList.length != 0) {
        return (
            <> 
                <h2>Join A Team</h2>
                <button className="back" onClick={back}>&lt; Projects</button>
                <table class="table">
                            <tbody>
                                <tr>
                                    <td>Project</td>
                                </tr>
                                {
                                    projectList.map((project) => (
                                        <tr>
                                            <td>{project.ProjectName}</td>
                                            <td>{project.ProjectDesc}</td>
                                            <td><button onClick={(e) => JoinTeam(project.ProjectId)}  className="btn btn-primary">Join</button></td>
    
                                        </tr>
                                    ))
                                }
                            </tbody>
                        </table>
            </>
            )} else {
                return (
                    <> 
                        <h2>Join A Team</h2>
                        <button className="back" onClick={back}>&lt; Projects</button>
                        <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Project</td>
                                        </tr>
                                        <tr>
                                            <td>No teams available</td>
                                        </tr>
                                    </tbody>
                                </table>
                    </>
                )}
        } else {
            return(
            <> 
                <h2>Join A Team</h2>
                <button className="back" onClick={back}>&lt; Projects</button>
                <table class="table">
                            <tbody>
                                <tr>
                                    <td>Project</td>
                                </tr>
                                {
                                        <tr>
                                            <td>{projectList.ProjectName}</td>
                                            <td>{projectList.ProjectDesc}</td>
                                            <td><button onClick={(e) => JoinTeam(projectList.ProjectId)}  className="btn btn-primary">Join</button></td>
                                        </tr>
                                }
                            </tbody>
                        </table>
            </>
            )
        }
}

export default JoinProject; 