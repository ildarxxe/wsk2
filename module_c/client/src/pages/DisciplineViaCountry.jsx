import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Header from "../components/common/header/Header";
import Button from "../components/button/Button";
import {Link, useParams} from "react-router-dom";
import disciplines from "./Disciplines";

const DisciplineViaCountry = () => {
    const [discipline, setDiscipline] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    const {discipline_name} = useParams();

    const countriesData = useSelector((state) => state.country.countries);

    useEffect(() => {
        if (countriesData.length > 0) {
            const result = [];
            const disciplinesViaCountry = countriesData.filter((country) => {
                return country.disciplines.find((discipline) => discipline.name === discipline_name);
            })
            disciplinesViaCountry.forEach((discipline) => {
                const medals = discipline.disciplines.filter(d => {
                    return d.name === discipline_name;
                })
                let totalMedals = 0;
                medals.forEach(medal => {
                    totalMedals = medal.gold + medal.silver + medal.bronze
                })
                result.push({
                    name: discipline.name,
                    medals: totalMedals
                })
            })
            setDiscipline(result);
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
                {loading ? <>
                    <div className="table_wrap">
                        <table>
                            <thead>
                            <tr>
                                <td className={'center'}>COUNTRY</td>
                                <td>MEDALS</td>
                            </tr>
                            </thead>
                            <tbody>
                            {discipline.map((item) =>
                                <tr key={item.name}>
                                    <td className={'left'}>
                                        <Link to={'/' + item.name + '/' + discipline_name}>
                                            {item.name}
                                        </Link>
                                    </td>
                                    <td>{item.medals}</td>
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

export default DisciplineViaCountry;