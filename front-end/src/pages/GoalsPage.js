import React from 'react';
import Goals from '../components/Goals'

const GoalsPage = ({match}) => (
    <React.Fragment>
    <div className='GoalsPage'>
        <Goals id={match.params.projectId}/>
    </div>
    </React.Fragment>
)

export default GoalsPage;