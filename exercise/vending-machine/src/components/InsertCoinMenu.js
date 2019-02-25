import React,{ Component } from 'react'
import { connect } from 'react-redux'
import { increaseBalance } from '../actions'

class InsertCoinMenu extends Component {
  onCoinInsert(coin){
    this.props.increaseBalance(coin)
  }

  render(){
    return(
      <div>
        <div className="ui center aligned segment">Insert Coin</div>
        <div className="ui grid">
          <div className="ui four column row">
            <div className="center aligned column">
              <div className="ui yellow button" onClick={() => this.onCoinInsert(1)}>฿1</div>
            </div>
            <div className="center aligned column">
              <div className="ui yellow button" onClick={() => this.onCoinInsert(2)}>฿2</div>
            </div>
            <div className="center aligned column">
              <div className="ui yellow button" onClick={() => this.onCoinInsert(5)}>฿5</div>
            </div>
            <div className="center aligned column">
              <div className="ui yellow button" onClick={() => this.onCoinInsert(10)}>฿10</div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default connect(null,{ increaseBalance })(InsertCoinMenu)
