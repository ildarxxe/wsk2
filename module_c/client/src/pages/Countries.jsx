import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Button from "../components/button/Button";
import Header from "../components/common/Header";


const Countries = () => {
    const [loading, setLoading] = React.useState(false);
    const info = useSelector(state => state.countryInfo);
    useEffect(() => {
        if (info.countries.length > 0) {
            setLoading(true);
        }
    }, [info]);
    return (
        <>
            <Header />
            <div className="title"><h1>Countries</h1></div>
            <div className="countries">
                {loading ? <>
                    {info.countries.map(item =>
                        <Button text={item.name} src={'/media/' + item.flag} alt={"Flag"} href={"/countries/" + item.id} />
                    )}
                </> : "Loading"}
            </div>
        </>
    );
};

export default Countries;