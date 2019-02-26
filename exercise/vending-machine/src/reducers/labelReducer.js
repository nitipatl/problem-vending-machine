import { SET_LABEL } from '../actions/types'

export default (state = null,action) => {
  switch(action.type){
    case SET_LABEL:
      return action.payload
    default:
      return state
  }
}
