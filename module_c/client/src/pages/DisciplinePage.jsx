import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Header from "../components/common/header/Header";
import Button from "../components/button/Button";
import {Link, useParams} from "react-router-dom";
import disciplines from "./Disciplines";

const DisciplinePage = () => {
    const [discipline, setDiscipline] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    const {country_name, discipline_name} = useParams();

    const countriesData = useSelector((state) => state.country.countries);

    useEffect(() => {
        if (countriesData.length > 0) {
            const country = countriesData.find((country) => country.name === country_name);
            const discipline = country.disciplines.find((discipline) => discipline.name === discipline.name);
            setDiscipline(discipline);
            setLoading(true);
        }
    }, [countriesData])
    return (
        <>
            <Header />
            <div className={'discipline'}>
                <div className="title"><h1>{discipline_name}</h1></div>
                <div className="discipline__img">
                    <img src={'/images/disciplines/'+discipline_name+'.svg'} alt="discipline"/>
                </div>
                <div className="title"><h1>{country_name}</h1></div>
                {loading ? <>
                    <div className="table_wrap">
                        <table>
                            <thead>
                            <tr>
                                <td className={'center'}>GOLD</td>
                                <td>SILVER</td>
                                <td>BRONZE</td>
                                <td>TOTAL</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{discipline.gold}</td>
                                <td>{discipline.silver}</td>
                                <td>{discipline.bronze}</td>
                                <td>{discipline.gold + discipline.silver + discipline.bronze}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </> : "Loading"}
            </div>
        </>
    );
};

export default DisciplinePage;