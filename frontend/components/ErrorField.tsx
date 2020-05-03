import React from 'react';
import "./ErrorField.scss";

interface PropsErrorField {
    message: string;
}

const ErrorField: React.FC<PropsErrorField> = (props) => (
    <>
        <div className="c-lipstick">
            {props.message}
        </div>
    </>
);

export default ErrorField;