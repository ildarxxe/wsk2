import React, {useEffect} from 'react';
import {useSelector} from "react-redux";
import Header from "../components/common/header/Header";
import Button from "../components/button/Button";

const Disciplines = () => {
    const [disciplines, setDisciplines] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    const countriesData = useSelector((state) => state.country.countries);

    useEffect(() => {
        if (countriesData.length > 0) {
            const ds = countriesData.flatMap((country) => country.disciplines)
            const newDs = new Map();
            ds.forEach(discipline => {
                newDs.set(discipline.name, {name: discipline.name, image: discipline.image});
            })
            const disciplines = Array.from(newDs.values());
            setDisciplines(disciplines);
            setLoading(true);
        }
    }, [countriesData])
    return (
        <>
            <Header />
            <div className={'disciplines'}>
                <div className="title"><h1>Disciplines</h1></div>
                {loading ? <>
                    {disciplines.map((discipline) =>
                        <Button
                            key={discipline.name}
                            text={discipline.name}
                            href={`/disciplines/${discipline.name}`}
                            alt={discipline.name}
                            src={discipline.image} />
                    )}
                </> : "Loading"}
            </div>
        </>
    );
};

export default Disciplines;