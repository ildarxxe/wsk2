import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Button from "../components/button/Button";
import Header from "../components/common/Header";


const Disciplines = () => {
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
            <div className="title"><h1>Disciplines</h1></div>
            <div className="countries">
                {loading ? <>
                    {info.countries[5].disciplines.map(item =>
                        <Button text={item.name} src={'/media/' + item.image} alt={"Discipline"} href={"/disciplines/" + item.name} />
                    )}
                </> : "Loading"}
            </div>
        </>
    );
};

export default Disciplines;