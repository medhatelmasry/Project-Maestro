import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import goalsData from '../data/goals';
import "../pages/styles/BackButton.css";


const Goals = (param) => {
    const [goals, setGoals] = useState([]);
    const [goalInput, setGoalInput] = useState('');

    const projectId = param.id;
    console.log(projectId);

    useEffect(() => {
        const fetchData = async () => {
            const goal_response = await fetch("http://localhost:8888/db/api.php/Goal", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            });
            const goal_result = await goal_response.json();
            var goalListData = (goal_result.filter(c => c.ProjectId == projectId));
            setGoals(goalListData);
            console.log(goalListData);
            // var crsId = courseListData.CourseId
            // setCrsName(crsId);
            // console.log(crsId)
        }
        fetchData();
    }, []);

    const createGoal = async (e) => {
        console.log(goalInput);
        const response = await fetch(`http://localhost:8888/db/api.php/Goal`, {
            method: 'POST',
            body: JSON.stringify({
                "ProjectId": projectId,
                "GoalDesc": goalInput

            }),
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        })
        window.location.reload();
    }

    const deleteGoal = async (GoalId) => {
        console.log(goalInput);
        console.log(GoalId);
        const response = await fetch(`http://localhost:8888/db/api.php/Goal`, {
            method: 'DELETE',
            body: JSON.stringify({
                GoalId
            }),
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        })
        window.location.reload();
    }



    // var goals = (goalsData.filter(g => g.projectId == id))

    function back() {
        window.history.back();
    }

    return (
        <> 
            <h3>Goals</h3>
            <button className="back" onClick={back}>&lt; Project</button>
            <table class="table">
       
                <tbody>
                    <tr>
                        <th>Description</th>
                    </tr>
                {goals.map((goal) => (
                    <tr>
                        <td>{goal.GoalDesc} </td>
                        <td><button onClick={(e) => deleteGoal(goal.GoalId)}  className="btn btn-primary">Complete</button></td>
                    </tr>
                ))}
                </tbody>
            <br /><br />
            <input type='text' className='form-control' id='goalInput' value={goalInput}
                            onChange={(event) => setGoalInput(event.target.value)} />
                            <br />
                <button className="btn btn-primary" onClick={(e) => createGoal(e)}>Add Goal</button>
            </table>
        </>
    )
}
export default Goals; 