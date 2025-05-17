import React from 'react';
import './Header.css'
import {useNavigate} from "react-router-dom";

const Header = () => {
    const navigate = useNavigate();
    function navigateBtnClick() {
        navigate(-1);
    }
    return (
        <header className={'header'}>
            <img onClick={navigateBtnClick} src="/media/images/ico-prev.svg" alt="prev" className="prev"/>
            <nav className="header__nav">
                <img src="/media/images/logo-sm-white.png" alt="logo"/>
            </nav>
        </header>
    );
};

export default Header;