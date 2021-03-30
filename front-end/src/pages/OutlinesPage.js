import React from 'react';
import OutlineList from './../components/OutlineList'

const OutlinesPage = ({match}) => (
    <React.Fragment>
    <div className='DashboardPage'>
        <OutlineList id={match.params.id}/>
    </div>
    </React.Fragment>
)

export default OutlinesPage;