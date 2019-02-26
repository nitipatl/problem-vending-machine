import React from 'react'
import BalanceBar from './BalanceBar'
import InsertCoinMenu from './InsertCoinMenu'
import ChangesMenu from './ChangesMenu'
import ItemList from './ItemList'

const App = () => {
  return (
    <div className="ui container">
      <BalanceBar/>
      <ItemList/>
      <InsertCoinMenu/>
      <ChangesMenu/>
    </div>
  )
}

export default App
