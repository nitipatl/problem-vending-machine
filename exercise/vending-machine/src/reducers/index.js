import { combineReducers } from 'redux'
import balanceReducer from './balanceReducer'
import changesReducer from './changesReducer'

export default combineReducers({
  balance:balanceReducer,
  changes:changesReducer
})
