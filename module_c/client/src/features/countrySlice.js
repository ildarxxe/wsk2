import {createSlice} from "@reduxjs/toolkit";

const initialState = {
    countries: [],
}

const countrySlice = createSlice({
    name: "countries",
    initialState,
    reducers: {
        setCountries: (state, action) => {
            state.countries = action.payload
        }
    }
})

export const { setCountries } = countrySlice.actions;
export default countrySlice.reducer;