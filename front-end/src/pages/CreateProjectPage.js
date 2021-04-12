import React from 'react';
import CreateProject from '../components/CreateProject'

const CreateProjectPage = ({match}) => (
    <React.Fragment>
    <div className='CreateProjectPage'>
        <CreateProject id={match.params.id}/>
    </div>
    </React.Fragment>
)

export default CreateProjectPage;