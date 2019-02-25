import React from 'react'
import BalanceBar from './BalanceBar'
import InsertCoinMenu from './InsertCoinMenu'
import ChangesMenu from './ChangesMenu'

const App = () => {
  return (
    <div className="ui container">
      <BalanceBar/>
      <InsertCoinMenu/>
      <ChangesMenu/>
    </div>
  )
}

export default App
