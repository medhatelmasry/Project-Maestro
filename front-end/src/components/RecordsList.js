import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class RecordsList extends Component {
    render() {
        return (
            <tr>
                <td>
                    {this.props.obj.CourseId}
                </td>
                <td>
                    <Link to={"/outlines/" + this.props.obj.CourseListId} className="btn btn-primary">View</Link>
                </td>
            </tr>
        )
    }
}

export default RecordsList;