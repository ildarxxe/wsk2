import React from 'react';
import './Header.css';
import {useNavigate} from "react-router-dom";

const Header = () => {
    const navigate = useNavigate();
    function prevClick() {
        navigate(-1)
    }
    return (
        <header>
            <nav>
                <img src="/images/ico-prev.svg" alt="prev" onClick={prevClick} />
            </nav>
            <div className="header__logo">
                <img src="/images/logo-sm-white.png" alt="logo"/>
            </div>
        </header>
    );
};

export default Header;