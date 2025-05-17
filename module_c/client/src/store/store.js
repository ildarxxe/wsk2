import {configureStore} from '@reduxjs/toolkit';
import countryInfoReducer from '../features/countryInfoSlice.js';

export const store = configureStore({
    reducer: {
        countryInfo: countryInfoReducer,
    }
})