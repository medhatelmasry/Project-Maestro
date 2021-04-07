import React from 'react';
import Outline from './../components/Outline'

const OutlinePage = ({match}) => (
    <React.Fragment>
    <div className='OutlinePage'>
        <Outline id={match.params.id}/>
    </div>
    </React.Fragment>
)

export default OutlinePage;