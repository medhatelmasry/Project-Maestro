import React from 'react';
import TeamList from '../components/TeamList'

const ProjectPage = ({match}) => (
    <React.Fragment>
    <div className='JoinTeamPage'>
        <TeamList id={match.params.id}/>
    </div>
    </React.Fragment>
)

export default ProjectPage;