import React from 'react'
import { connect } from 'react-redux'

const BalanceBar = (props) => {
  return (
    <div className="ui right aligned compact segment">
    {`Balance: ฿ ${props.balance}`}
    </div>
  )
}

const mapStateToProps = ({balance}) => {
  return {balance}
}

export default connect(mapStateToProps)(BalanceBar)
