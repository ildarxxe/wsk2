import {createSlice} from '@reduxjs/toolkit'

const initialState = {
    countries: [],
}

const countryInfoSlice = createSlice({
    name: 'countryInfo',
    initialState,
    reducers: {
        setCountry: (state, action) => {
            state.countries = action.payload;
        }
    }
})

export const {setCountry} = countryInfoSlice.actions;
export default countryInfoSlice.reducer;