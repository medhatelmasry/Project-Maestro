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

    courseList() {
        return this.state.courses.map(function (object, i) {
            return <RecordsList obj={object} key={i} />;
        });
    }

    render() {
        return (
            <div>
                <h3>Courses</h3>
                <table className="table">
                    <thead>
                    </thead>
                    <tbody>
                        { this.courseList() }
                    </tbody>
                </table>
            </div>
        );
    }
}
export default CourseList;