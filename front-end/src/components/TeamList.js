import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import teamsData from '../data/teams';
import studentsData from '../data/students';
import projectsData from '../data/projects';

const TeamList = (param) => {

    const id = param.id;

    var teams = teamsData.filter(c => c.outlineId == id);

    var i = 1;

    return (
        <> 
            <React.Fragment>
            <h3>Teams</h3>
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
            </React.Fragment>
        </>
    )
}
export default TeamList; 