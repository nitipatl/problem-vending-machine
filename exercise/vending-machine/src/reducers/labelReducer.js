import { SET_LABEL } from '../actions/types'

export default (state = 'Label',action) => {
  switch(action.type){
    case SET_LABEL:
      return action.payload
    default:
      return state
  }
}
