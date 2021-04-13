import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

const CourseList = () => {
    const [courses, setCourses] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch("http://localhost:8888/db/api.php/CourseList", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
                }
            });
            const body = await response.json();
            setCourses(body);
        }
        fetchData();
    }, []);

    return (
        <>
            <div>
                <h3>Courses</h3>
                <table className="table">
                    <thead>
                    </thead>
                    <tbody>
                        {courses.map((item) => (
                            <tr>
                                <td>
                                    {item.CourseId}
                                </td>
                                <td>
                                    <Link to={"/outlines/" + item.CourseListId} className="btn btn-primary">View</Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default CourseList;