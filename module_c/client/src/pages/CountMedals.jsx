import React, {useEffect} from 'react';
import Header from "../components/common/header/Header";
import {useParams, useSearchParams} from "react-router-dom";
import {useSelector} from "react-redux";
import Button from "../components/button/Button";

const CountMedals = () => {
    const [country, setCountry] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    const {id} = useParams();

    const [params] = useSearchParams();
    const medal_name = params.get('m');

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
            <div className={'countMedals'}>
                {loading ? <>
                    <div className="title"><h1>{country.name}</h1></div>
                    <div className="country__img">
                        <img src={'/' + country.flag} alt="flag"/>
                    </div>
                    <div className="medals">
                        <h2>{medal_name} medals</h2>
                        <h1>{country.medals[medal_name]}</h1>
                    </div>
                    <div className="table_wrap">
                        <table>
                            <thead>
                            <tr className={'center'}>
                                <td>DISCIPLINE</td>
                                <td>MEDALS</td>
                            </tr>
                            </thead>
                            <tbody>
                            {country.disciplines.map(discipline =>
                                <tr>
                                    <td className={'left'}>{discipline.name}</td>
                                    <td>{discipline.gold}</td>
                                </tr>
                            )}
                            </tbody>
                        </table>
                    </div>
                </> : "Loading"}
            </div>
        </>
    );
};

export default CountMedals;