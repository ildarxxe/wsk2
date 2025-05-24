import React, {useEffect, useState} from 'react';
import {useSelector} from "react-redux";
import {useParams} from "react-router-dom";
import Header from "../components/common/Header";

const DisciplineOfCountry = () => {
    const [loading, setLoading] = useState(false);
    const [dis, setDis] = useState({});
    const info = useSelector(state => state.countryInfo);
    const {discipline, country} = useParams();

    useEffect(() => {
        if (info.countries.length > 0) {
            const found_country = info.countries.find(c => c.name === country)
            const found_discipline = found_country.disciplines.find(d => d.name === discipline)
            const medals = found_discipline.gold + found_discipline.silver + found_discipline.bronze
            const disObj = {
                gold: found_discipline.gold,
                silver: found_discipline.silver,
                bronze: found_discipline.bronze,
                total: medals
            }
            setDis(disObj)
            setLoading(true);
        }
    }, [info]);

    return (
        <>
            <Header/>
            <div className={"country-page"}>
                {loading ? <>
                    <h1>{discipline}</h1>
                    <img src={"/media/images/" + discipline + ".svg"} alt="Discipline logo"/>
                    <h1>{country}</h1>
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
                            <td>{dis.gold}</td>
                            <td>{dis.silver}</td>
                            <td>{dis.bronze}</td>
                            <td>{dis.total}</td>
                        </tr>
                        </tbody>
                    </table>
                </> : 'Loading'}
            </div>
        </>
    );
};

export default DisciplineOfCountry;