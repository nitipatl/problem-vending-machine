import { INCREASE_BALANCE, RESET_BALANCE, REFUND_CHANGES } from './types'

export const increaseBalance = (coin) => {
  return {
    type: INCREASE_BALANCE,
    payload: coin
  }
}

export const resetBalance = () => {
  return {
    type: RESET_BALANCE,
  }
}

export const refundChanges = (refundCoins) => {
  return {
    type: REFUND_CHANGES,
    payload:refundCoins
  }
}
