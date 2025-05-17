import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import {useParams} from "react-router-dom";
import Button from "../components/button/Button";
import Header from "../components/common/Header";

const CountryPage = () => {
    const [loading, setLoading] = React.useState(false);
    const [country, setCountry] = React.useState([]);
    const info = useSelector(state => state.countryInfo);
    const {id} = useParams();
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
            <div className={"country-page"}>
                {loading ? <>
                    <h1>{country.name}</h1>
                    <img src={"/media/" + country.flag} alt="Flag"/>
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
                            <td>{country.medals.gold + country.medals.silver + country.medals.bronze}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div className="medals">
                        <Button src={'/media/images/medals/gold.png'} alt={'gold medal'} href={"/medals/" + country.id + '/?m=1'} text={"Medals"} />
                        <Button src={'/media/images/medals/silver.png'} alt={'silver medal'} href={"/medals/" + country.id + '/?m=2'} text={"Medals"} />
                        <Button src={'/media/images/medals/bronze.png'} alt={'bronze medal'} href={"/medals/" + country.id + '/?m=3'} text={"Medals"} />
                    </div>
                </> : 'Loading'}
            </div>
        </>
    );
};

export default CountryPage;