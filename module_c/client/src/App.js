import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import './App.css'
import {useEffect} from "react";
import {useDispatch, useSelector} from "react-redux";
import {setCountry} from "./features/countryInfoSlice.js";
import Countries from "./pages/Countries";
import CountryPage from "./pages/CountryPage";
import Medals from "./pages/Medals";
import Disciplines from "./pages/Disciplines";
import DisciplinePage from "./pages/DisciplinePage";
import DisciplineOfCountry from "./pages/DisciplineOfCountry";

function App() {
    const dispatch = useDispatch();

    async function fetchData() {
        const res = await fetch("http://localhost:3000/countries");
        const data = await res.json();
        if (!res.ok) {
            return res.status;
        }
        dispatch(setCountry(data))
    }

    useEffect(() => {
        fetchData();
    }, [])
    return (
        <BrowserRouter>
            <div className="App" style={{
                backgroundImage: "url(/media/images/bg.png)",
            }}>
                <Routes>
                    <Route path="/" element={<Home/>}/>
                    <Route path="/countries" element={<Countries />}/>
                    <Route path="/countries/:id" element={<CountryPage />}/>
                    <Route path="/medals/:id" element={<Medals />}/>
                    <Route path="/disciplines" element={<Disciplines />} />
                    <Route path="/disciplines/:name" element={<DisciplinePage />} />
                    <Route path="/disciplines/:discipline/:country" element={<DisciplineOfCountry />} />
                </Routes>
            </div>
        </BrowserRouter>
    );
}

export default App;
