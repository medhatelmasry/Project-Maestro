import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import goalsData from '../data/goals';
import "../pages/styles/BackButton.css";


const Goals = (param) => {

    const id = param.id;

    var goals = (goalsData.filter(g => g.projectId == id))

    function back() {
        window.history.back();
    }

    return (
        <> 
            <h3>Goals</h3>
            <button className="back" onClick={back}>&lt; Project</button>
            <table class="table">
                <tbody>
                {goals.map((goal, key) => (
                    <tr>
                        <td width="15%">{goal.name}: </td>
                        <td width="65%">{goal.description}</td>
                        <td width="10%"><button>Complete</button></td>
                        <td width="10%"><button>Edit</button></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
}
export default Goals; 