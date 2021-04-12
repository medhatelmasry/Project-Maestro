import React, { Component } from 'react';
import RecordsList from './RecordsList';

class CourseList extends Component {
    constructor(props) {
        super(props);
        this.state = { courses: [] };
    }
    componentDidMount() {
        fetch("http://localhost:8888/db/api.php/CourseList", {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '.concat(localStorage.getItem("authToken"))
            }
        }).then(response => response.json())
        .then(data => {
            this.setState({ courses: data })
        }).catch(err => console.log(err));
    }

<<<<<<< HEAD
    var courses = coursesData;
    return (
        <>  
            <h3>Courses</h3>
            <table class="table">
                <tbody>
                {courses.map((course, key) => (
                    <tr>
                        <td id="names">{course.name}</td>
                        <td><Link key={key} to={`/outlines/${course.id}`}>View</Link></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
=======
    courseList() {
        return this.state.courses.map(function (object, i) {
            return <RecordsList obj={object} key={i} />;
        });
    }

    render() {
        return (
            <div>
                <h3>Courses</h3>
                <table class="table">
                    <thead>
                    </thead>
                    <tbody>
                        { this.courseList() }
                    </tbody>
                </table>
            </div>
        );
    }
>>>>>>> 1e09d92ec7b83a98002e56de955621965afebe7b
}
export default CourseList;