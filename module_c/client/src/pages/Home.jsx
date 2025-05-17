import React from 'react';
import Button from '../components/button/Button';

const Home = () => {
    return (
        <div className={'home'}>
            <div className="home__logo">
                <img src="/media/images/logo-white.png" alt="logo"/>
            </div>
            <div className="home__info">
                <div className="home__info--inner">
                    <img src="/media/images/frame.png" alt="medals"/>
                </div>
            </div>
            <div className="home__links">
                <Button text={"Countries"} src={"/media/images/ico-countries.svg"} alt={"icon"} href={"/countries"} />
                <Button text={"Disciplines"} src={"/media/images/ico-disciplines.svg"} alt={"icon"} href={"/disciplines"} />
            </div>
        </div>
    );
};

export default Home;