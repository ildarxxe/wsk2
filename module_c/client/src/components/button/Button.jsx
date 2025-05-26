import React from 'react';
import {Link} from "react-router-dom";
import './Button.css';

const Button = ({src, href, alt, text}) => {
    return (
        <Link to={href} className="button">
            <img src={src} alt={alt}/>
            <span>{text}</span>
        </Link>
    );
};

export default Button;