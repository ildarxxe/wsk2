import './App.css';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import Countries from "./pages/Countries";
import {useEffect} from "react";
import {useDispatch} from "react-redux";
import {setCountries} from "./features/countrySlice";
import CountryPage from "./pages/CountryPage";
import CountMedals from "./pages/CountMedals";
import Disciplines from "./pages/Disciplines";
import DisciplineViaCountry from "./pages/DisciplineViaCountry";
import DisciplinePage from "./pages/DisciplinePage";

function App() {
    const dispatch = useDispatch();
    async function fetchData() {
        await fetch("http://localhost:3000/countries")
            .then(res => res.json())
            .then(data => {
                dispatch(setCountries(data));
            })
        .catch(err => console.log(err));
    }
    useEffect(() => {
        fetchData()
    }, [])
  return (
   <BrowserRouter>
     <div className="App">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/countries" element={<Countries />} />
          <Route path="/countries/:id" element={<CountryPage />} />
          <Route path="/medals/:id" element={<CountMedals />} />
          <Route path="/disciplines" element={<Disciplines />} />
          <Route path="/disciplines/:discipline_name" element={<DisciplineViaCountry />} />
          <Route path="/:country_name/:discipline_name" element={<DisciplinePage />} />
        </Routes>
     </div>
   </BrowserRouter>
  );
}

export default App;
