import React from 'react';
import Button from "../components/button/Button";

const Home = () => {
    return (
        <div className={'home'}>
            <div className="home__header">
                <img src="/images/logo-white.png" alt="logo"/>
            </div>
            <div className="home__frame">
                <img src="/images/frame.png" alt="frame"/>
            </div>
            <div className="home__buttons">
                <Button src={'/images/ico-countries.svg'} alt={'icon country'} href={'/countries'} text={'Countries'} />
                <Button src={'/images/ico-disciplines.svg'} alt={'icon discipline'} href={'/disciplines'} text={'Disciplines'} />
            </div>
        </div>
    );
};

export default Home;