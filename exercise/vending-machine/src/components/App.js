import React from 'react'
import BalanceBar from './BalanceBar'
import InsertCoin from './InsertCoin'
import ChangesMenu from './ChangesMenu'
import ItemList from './ItemList'

const App = () => {
  return (
    <div className="ui container">
      <BalanceBar/>
      <ItemList/>
      <div className="ui basic horizontal segments">
        <InsertCoin/>
        <ChangesMenu/>
      </div>
    </div>
  )
}

export default App
