import React,{ Component } from 'react'
import { connect } from 'react-redux'
import { resetBalance,refundChanges } from '../actions'
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

  render(){
    // console.log(this.props.changes);
    return (
      <div className="ui grid">
        <div className="two column row">
          <div className="column">
            <div className="ui center aligned segment"> Item </div>
            <ChangesBar/>
          </div>
          <div className="column">
          <div className="ui teal button" onClick={this.onRefundClick}>refund</div>
          </div>
        </div>

      </div>
    )
  }
}

const mapStateToProps = ({ balance,changes }) => {
  return { balance,changes }
}

export default connect(mapStateToProps, { resetBalance,refundChanges })(ChangesMenu)
