import React from 'react';
import './Button.css'
import {Link} from "react-router-dom";

const Button = ({text, src, alt, href}) => {
    return (
        <Link to={href} className="button">
            <img src={src} alt={alt}/>
            <span>{text}</span>
        </Link>
    );
};

export default Button;