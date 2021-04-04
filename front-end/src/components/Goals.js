import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import goalsData from '../data/goals';


const Goals = (param) => {

    const id = param.id;

    var goals = (goalsData.filter(g => g.projectId == id))

    return (
        <> 
            <React.Fragment>
            <h3>Goals</h3>
            <table>
                <tbody>
                {goals.map((goal, key) => (
                    <tr>
                        <td>{goal.name}: </td>
                        <td>{goal.description}</td>
                        <td><button>Complete</button></td>
                        <td><button>Edit</button></td>
                    </tr>
                ))}
                </tbody>
            </table>
            </React.Fragment>
        </>
    )
}
export default Goals; 