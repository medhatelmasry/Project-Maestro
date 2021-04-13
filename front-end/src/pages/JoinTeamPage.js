import React from 'react';
import JoinProject from '../components/JoinProject'

const ProjectPage = ({match}) => (
    <React.Fragment>
    <div className='JoinTeamPage'>
        <JoinProject id={match.params.id}/>
    </div>
    </React.Fragment>
)
export default ProjectPage;