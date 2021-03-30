import React from 'react';
import OutlineList from './../components/OutlineList'

var name = "Project Outline #"

const OutlinesPage = (id) => (
    <React.Fragment>
    <div className='DashboardPage'>
        <h2>{name}</h2>
        <OutlineList/>
    </div>
    </React.Fragment>
)

export default OutlinesPage;