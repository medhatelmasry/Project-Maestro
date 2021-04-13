import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';
import "../pages/styles/BackButton.css";


const TeamList = (param) => {

    const id = param.id;

    var teams = teamsData.filter(c => c.outlineId == id);

    var i = 1;

    function back() {
        window.history.back();
    }

    return (
        <> 
            <h3>Teams</h3>
            <button className="back" onClick={back}>&lt; Back</button>
            <table>
                <tbody>
                {teams.map((team, key) => (
                    <tr>
                        Team
                        {team.members.map((member) => (
                            <td>
                                {member.name + " / "}
                            </td>
                        ))}
                        <button>Join Team</button>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
}
export default TeamList; 