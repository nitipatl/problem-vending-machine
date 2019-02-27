import React,{ Component } from 'react'
import { connect } from 'react-redux'
import { resetBalance,refundChanges } from '../actions'
import { OUT_OF_STOCK,NOT_ENOUGH_MONEY } from './ItemList'
import ChangesBar from './ChangesBar'

class ChangesMenu extends Component {
  onRefundClick = () => {
    const coins = [10,5,2,1]
    let balance = this.props.balance

    const refundCoins = coins.map(coin => {
                          const x = Math.floor(balance/coin)
                          balance -= x * coin
                          return x
                        })
    this.props.resetBalance()
    this.props.refundChanges(refundCoins)
    // console.log(refundCoins,balance);
  }

  checkLabel(label){
    switch(label){
      case 'Label': return ''
      case NOT_ENOUGH_MONEY: return 'negative'
      case OUT_OF_STOCK: return 'negative'
      default: return 'positive'
    }
  }

  render(){
    // console.log(this.props.changes);
    return (
      <div className="ui basic compact segment">
          <div className={`ui ${this.checkLabel(this.props.label)} message`}>{ this.props.label }</div>
          <ChangesBar/>
          <div className="ui teal right floated button" onClick={this.onRefundClick}>refund</div>
      </div>
    )
  }
}

const mapStateToProps = ({ balance,changes,label }) => {
  return { balance,changes,label }
}

export default connect(mapStateToProps, { resetBalance,refundChanges })(ChangesMenu)
