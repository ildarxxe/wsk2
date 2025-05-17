import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import {useParams, useSearchParams} from "react-router-dom";
import Header from "../components/common/Header";

const CountryPage = () => {
    const [loading, setLoading] = React.useState(false);
    const [country, setCountry] = React.useState([]);
    const info = useSelector(state => state.countryInfo);
    const {id} = useParams();
    const [params] = useSearchParams();
    const m = params.get('m');
    const medal = m == 1 ? "GOLD" : m == 2 ? "SILVER" : "BRONZE"
    useEffect(() => {
        if (info.countries.length > 0) {
            info.countries.forEach(country => {
                if (country.id === id) {
                    setCountry(country);
                    setLoading(true);
                }
            })
        }
    }, [info]);
    return (
        <>
            <Header />
            <div className={"country-page medals"}>
                {loading ? <>
                    <h1>{country.name}</h1>
                    <img src={"/media/" + country.flag} alt="Flag"/>
                    <h2>{medal} MEDALS</h2>
                    <h1 className={'count_medals'}>{m == 1 ? country.medals.gold : m == 2 ? country.medals.silver : country.medals.bronze}</h1>
                    <table>
                        <thead>
                        <tr>
                            <td>DISCIPLINE</td>
                            <td>MEDALS</td>
                        </tr>
                        </thead>
                        <tbody>
                        {country.disciplines.map(d =>
                        <>
                            <tr>
                                <td>{d.name}</td>
                                <td>{m == 1 ? d.gold : m == 2 ? d.silver : d.bronze}</td>
                            </tr>
                        </>
                        )}
                        </tbody>
                    </table>
                </> : 'Loading'}
            </div>
        </>
    );
};

export default CountryPage;