import React,{ Component } from 'react'
import { connect } from 'react-redux'
import { fetchItems,resetBalance,refundChanges,setLabel } from '../actions'

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
      label+= balance < item.price? 'Not enough money ':''
      label+= item.in_stock === false ? 'out of stock':''
    }

    //Label will show on changes menu
    this.props.setLabel(label)
    // console.log(label);
  }

  renderItems(){
    return this.props.items.map(item => (
      <div key={item.id} className="card" onClick={() => this.onItemClick(item)}>
        <div className="image">
          <img src={item.image} alt="img not found"/>
        </div>
        <div className="header">
          {item.name}
        </div>
        <div className="header">
          {item.price}
        </div>
        <div className="header">
          {item.in_stock?null:'out of stock'}
        </div>
      </div>
    ))
  }

  render(){
    // console.log(this.props.items);
    return (
      <div className="ui centered cards">
        {this.renderItems()}
      </div>
    )
  }
}

const mapStateToProps = ({ items,balance }) => {
  return { items,balance }
}

export default connect(mapStateToProps, { fetchItems,resetBalance,refundChanges,setLabel })(ItemList)
