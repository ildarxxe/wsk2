import {configureStore} from '@reduxjs/toolkit'
import countryReducer from '../features/countrySlice.js';

export const store = configureStore({
    reducer: {
        country: countryReducer
    }
})