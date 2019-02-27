import React,{ Component } from 'react'
import { connect } from 'react-redux'
import { fetchItems,resetBalance,refundChanges,setLabel } from '../actions'

export const OUT_OF_STOCK = 'Out of stock'
export const NOT_ENOUGH_MONEY = 'Not enough money'

class ItemList extends Component {

  componentDidMount(){
    this.props.fetchItems()
  }

  onItemClick(item){
    const coins = [10,5,2,1]
    let balance = this.props.balance
    let label = ''

    if(balance >= item.price && item.in_stock){
      balance -= item.price
      label = `You purchased ${item.name} price:${item.price} changes:${balance}`

      const refundCoins = coins.map(coin => {
                            const x = Math.floor(balance/coin)
                            balance -= x * coin
                            return x
                          })
      this.props.resetBalance()
      this.props.refundChanges(refundCoins)
    }else{
      if(item.in_stock === false) label = OUT_OF_STOCK
      else if(balance < item.price )label = NOT_ENOUGH_MONEY
    }

    //Label will show on changes menu
    this.props.setLabel(label)
    // console.log(label);
  }

  renderItems(){
    return this.props.items.map(item => (
      <div key={item.id} className={`${item.in_stock?'green':'red'} card`} onClick={() => this.onItemClick(item)}>
        <div className="image">
          <img src={item.image} alt="img not found"/>
        </div>
        <div className="content">
          <div className="center aligned header">
            {item.name}
          </div>
        </div>
        <div className="extra content">
          <div className="center aligned header">
            price: {item.price}
          </div>
        </div>
      </div>
    ))
  }

  render(){
    // console.log(this.props.items);
    return (
      <div className="ui basic segment">
        <div className="ui centered cards">
          {this.renderItems()}
        </div>
      </div>
    )
  }
}

const mapStateToProps = ({ items,balance }) => {
  return { items,balance }
}

export default connect(mapStateToProps, { fetchItems,resetBalance,refundChanges,setLabel })(ItemList)