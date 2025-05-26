import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Button from "../components/button/Button";
import Header from "../components/common/header/Header";

const Countries = () => {
    const [countries, setCountries] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    const countriesData = useSelector((state) => state.country.countries);

    useEffect(() => {
        if (countriesData.length > 0) {
            setCountries(countriesData);
            setLoading(true);
        }
    }, [countriesData])
    return (
        <>
            <Header />
            <div className={'countries'}>
                <div className="title"><h1>Countries</h1></div>
                {loading ? <>
                    {countries.map((country) =>
                        <Button key={country.id} text={country.name} href={`/countries/${country.id}`} alt={country.name} src={country.flag} />
                    )}
                </> : "Loading"}
            </div>
        </>
    );
};

export default Countries;