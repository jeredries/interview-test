import React from 'react';
import "./Activity.scss";

interface PropsActivity {
    id: string;
    time: Date;
    title: string;
    description: string
}

const Activity: React.FC<PropsActivity> = (props) => (
    <>
        <table id={`activity-${props.id}`}>
            <thead></thead>
            <tbody>
                <tr>
                    <td className="TdDate">{props.time.getDate()}</td>
                    <td>{props.title}</td>
                </tr>
                <tr>
                    <td className="TdMonth">{props.time.toLocaleString('fr', { month: 'long' }).substring(0,3).toUpperCase()}</td>
                    <td><b>{props.description}</b></td>
                </tr>
            </tbody>
        </table>
    </>
);

export default Activity;
