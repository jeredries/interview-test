import React from 'react';
import "./UserInfo.scss";

interface PropsUserInfo {
    idCompany: Number,
    company: string,
    address: string,
    cp: Number,
    city: string,
    country: string
}

const UserInfo: React.FC<PropsUserInfo> = (props) => (
    <>
       <div className="UserInfo">
           <div className="Company">
                <b><p>{props.company} ({props.idCompany})</p></b>
            </div>
            <div className="Address">
                <p>
                    <span>{props.address}</span>
                    <span>{props.cp} {props.city}, {props.country}</span>
                </p>
            </div>
       </div>
    </>
);

export default UserInfo;
