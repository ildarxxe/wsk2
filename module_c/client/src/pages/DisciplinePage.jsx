import React, {useEffect, useState} from 'react';
import {useSelector} from "react-redux";
import {useParams} from "react-router-dom";
import {Link} from 'react-router-dom';
import Header from "../components/common/Header";

const DisciplinePage = () => {
    const [loading, setLoading] = useState(false);
    const info = useSelector(state => state.countryInfo);
    const {name} = useParams();
    const [countries, setCountries] = useState([]);

    useEffect(() => {
        if (info.countries.length > 0) {
            const result = [];
            info.countries.filter(country => {
                return country.disciplines.find(d => {
                    if (d.name === name) {
                        result.push({
                            country: country.name,
                            medals: d.gold + d.silver + d.bronze
                        })
                    }
                })
            })
            setCountries(result);
            setLoading(true);
        } else {
            setLoading(false);
        }
    }, [info, name]);

    return (
        <>
            <Header/>
            <div className={"country-page"}>
                {loading ? <>
                    <h1>{name}</h1>
                    <img src={"/media/images/" + name + ".svg"} alt="Discipline logo"/>
                    <table>
                        <thead>
                        <tr>
                            <td>COUNTRY</td>
                            <td>MEDALS</td>
                        </tr>
                        </thead>
                        <tbody>
                        {countries.map(c => (
                            <tr key={c.name}>
                                <td><Link to={"/disciplines/" + name + "/" + c.country}>{c.country}</Link></td>
                                <td>{c.medals}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </> : 'Loading'}
            </div>
        </>
    );
};

export default DisciplinePage;