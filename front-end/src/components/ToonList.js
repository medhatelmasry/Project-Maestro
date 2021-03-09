import React from 'react';
import toons from '../data/toons';
import { Link } from 'react-router-dom';

const ToonList = (param) => {
    var others = toons;
    if (param != undefined) {
      others = toons.filter(p => p.id != param.exceptId);
    } 
    
    return (
        <>
            {others.map((item, key) => (
                <Link key={key} to={`/detail/${item.id}`}>
                    <h6>{item.id}. {item.firstName} {item.lastName}</h6>
                </Link>
            ))}
        </>
    )
}
export default ToonList; 
