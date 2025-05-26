import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import {useParams} from "react-router-dom";
import Button from "../components/button/Button";
import Header from "../components/common/header/Header";

const CountryPage = () => {
    const [country, setCountry] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    const {id} = useParams();

    const countriesData = useSelector((state) => state.country.countries);

    useEffect(() => {
        if (countriesData.length > 0) {
            const country = countriesData.find((country) => country.id === id);
            setCountry(country);
            setLoading(true);
        }
    }, [countriesData])
    return (
        <>
            <Header />
            <div className={'country'}>
                {loading ? <>
                    <div className="title"><h1>{country.name}</h1></div>
                    <div className="country__img">
                        <img src={'/' + country.flag} alt="flag"/>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <td>GOLD</td>
                            <td>SILVER</td>
                            <td>BRONZE</td>
                            <td>TOTAL</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{country.medals.gold}</td>
                            <td>{country.medals.silver}</td>
                            <td>{country.medals.bronze}</td>
                            <td>{country.medals.bronze + country.medals.gold + country.medals.silver}</td>
                        </tr>
                        </tbody>
                    </table>
                </> : "Loading"}
                <div className="country__buttons">
                    <Button text={'Medals'} alt={'Medal'} href={'/medals/'+country.id+'/?m=gold'} src={'/images/medals/gold.png'} />
                    <Button text={'Medals'} alt={'Medal'} href={'/medals/'+country.id+'/?m=silver'} src={'/images/medals/silver.png'} />
                    <Button text={'Medals'} alt={'Medal'} href={'/medals/'+country.id+'/?m=bronze'} src={'/images/medals/bronze.png'} />
                </div>
            </div>
        </>
    );
};

export default CountryPage;