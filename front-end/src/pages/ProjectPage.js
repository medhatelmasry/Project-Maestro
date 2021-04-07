import React from 'react';
import Project from '../components/Project'

const ProjectPage = ({match}) => (
    <React.Fragment>
    <div className='ProjectPage'>
        <Project id={match.params.id}/>
    </div>
    </React.Fragment>
)

export default ProjectPage;