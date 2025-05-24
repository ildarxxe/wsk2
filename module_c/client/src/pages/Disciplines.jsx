import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Button from "../components/button/Button";
import Header from "../components/common/Header";


const Disciplines = () => {
    const [loading, setLoading] = React.useState(false);
    const info = useSelector(state => state.countryInfo);
    const [disciplines, setDisciplines] = React.useState([]);
    useEffect(() => {
        if (info.countries.length > 0) {
            const ds = info.countries.flatMap(country => country.disciplines);
            const newDs = new Map();
            ds.forEach(d => {
                newDs.set(d.name, {name: d.name, image: d.image});
            })
            const disciplines = Array.from(newDs.values());
            setDisciplines(disciplines);
            setLoading(true);
        }
    }, [info]);
    return (
        <>
            <Header />
            <div className="title"><h1>Disciplines</h1></div>
            <div className="countries">
                {loading ? <>
                    {disciplines.map(item =>
                        <Button text={item.name} src={'/media/' + item.image} alt={"Discipline"} href={"/disciplines/" + item.name} />
                    )}
                </> : "Loading"}
            </div>
        </>
    );
};

export default Disciplines;