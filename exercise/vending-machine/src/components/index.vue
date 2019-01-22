<template>
  <div >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h3>
            Problem Vending Machine
          </h3>
          <h5>
            <div class="row">
              <div class="col">
                Total money : {{ totalMoney }} Baht
              </div>
              <div class="col text-right">
                <button type="button" @click="RefundFlow" v-if="totalMoney != 0" class="btn btn-primary" > Refund </button>
                <button type="button" @click="show = true" class="btn btn-primary" >
                    Select Coin
                </button>
              </div>
            </div>

            
          </h5>
        </div>
      </div>
      <div class="row text-center">
          <div class="col-6 mb-2" v-for="(item, index) in info" :key="index">
            <div class="card">
              <img :src="item.image" class="card-img-top">
              <div class="card-body">
                <p class="card-text">{{ item.name }} {{ item.price }} Baht</p>
              </div>
              <button type="button" v-on:click="SelectChoice(index)" v-bind:class="{ 'active' : selected == index }"  class="w-100 btn btn-primary">
                Select
              </button>
            </div>
          </div>
      </div>
    </div>

  <!-- Modal Component -->
    <b-modal v-model="show" hide-footer no-close-on-esc no-close-on-backdrop hide-header-close ok-only id="modal-center" centered title="Select coins">
      <div class="text-center">
        <p class="text-danger"> {{ alertSelectCoin }} </p>
        <img src="../assets/money.png" style="width:100px" alt="">

      </div> 
      <div  class="row mt-5">
        <div v-for="(item, index) in simpleCoins" :key="index" class="col-3 text-right">
          <button type="button" @click="PushCoins(item)" class="w-100 btn btn-warning">{{ item }}</button>

        </div>
        
      </div>
    <div class="row text-center">
      <div  class="col-3 pt-2 ">
         <div v-if="numberTenCoins != 0"> x {{ numberTenCoins }}  </div> 
      </div>
      <div class="col-3 pt-2">
        <div v-if="numberFiveCoins != 0"> x {{ numberFiveCoins }}  </div> 
      </div> 
      <div class="col-3 pt-2">
        <div v-if="numberTwoCoins != 0"> x {{ numberTwoCoins }}  </div> 
      </div>
      <div class="col-3 pt-2 ">
        <div v-if="numberOneCoins != 0"> x {{ numberOneCoins }}  </div> 
      </div> 
    </div>
    <div class="mt-2 row text-center">
      <div v-if="totalMoney != 0" class="col-12">
        Total money : {{ totalMoney }} baht        
      </div>
    </div>
    <div class="row mt-3">
      <div class="col text-right">
        <button type="button" class="btn btn-warning" @click="show = false"> Ok </button>
      </div>
        
    </div>
  </b-modal>
    <b-modal v-model="showModelSuccess" @ok="SuccessFlow" no-close-on-esc no-close-on-backdrop hide-header-close ok-only id="modal-center" centered title="Result">
      <div class="text-center">
        <p class="text-success"> {{ successSelectCoin }} </p>
        <img :src="selected.image" v-if="selected.length != 0" style="width:250px" alt="">
        <p class="text-secondary" v-if="selected.length != 0">You take {{ selected.name }} {{ selected.price }} Baht</p>
        <div v-if="totalMoney != selected.price">
          <span v-if="selected.length != 0">  Change Coin : </span>
          <span v-if="selected.length == 0">  Refund Coin : </span> 
            <span v-for="(item, index) in changeCoins" :key="index" >{{ item }} <span v-if="changeCoins.length-1 != index"> , </span></span>
          </br>
          <span v-if="selected.length != 0"> Change Money : {{ totalMoney - selected.price }} </span>
          <span v-if="selected.length == 0"> Refund Money : {{ totalMoney }} </span>
        </div>
      </div> 
    </b-modal>
  </div>

</template>

<script>
import axios from 'axios'
export default {
  name: 'index',
  data () {
    return {
      show : false,
      showModelSuccess : false,
      info : [],
      selected : [],
      coins : [],
      alertSelectCoin : "",
      successSelectCoin : "",
      numberOneCoins : 0,
      numberTwoCoins : 0,
      numberFiveCoins : 0,
      numberTenCoins : 0,
      totalMoney : 0,
      simpleCoins : [10, 5 , 2 ,1],
      changeCoins : []
    }
  },
  
  methods: {
    
    RefundFlow : function() {      
      this.showModelSuccess = true
      this.successSelectCoin = "Refund your coin"
      this.changeCoins = this.coins

    },
    SetNumber : function(result) {
      this.simpleCoins.forEach(element => {
        switch (element) {
          case 1:
            this.numberOneCoins = this.GetNumber(element , result)
            break;

          case 2:
            this.numberTwoCoins = this.GetNumber(element , result)
            break;

          case 5:
            this.numberFiveCoins = this.GetNumber(element , result)
            break;

          case 10:
            this.numberTenCoins = this.GetNumber(element , result)
            break;
          
          default:
            break;
        }
      });
    },
    GetNumber : function(bath , result) {
      let numberCoins = result.filter( (coins) => {
        return coins == bath

      })      
      return  numberCoins.length

    },
    PushCoins : function(bath) {
      this.coins.push(bath)
      this.SetNumber(this.coins)
      this.totalMoney += bath
    },
    SuccessFlow : function() {
      this.numberOneCoins = 0
      this.numberTwoCoins = 0
      this.numberFiveCoins = 0
      this.numberTenCoins = 0
      this.show = true
      this.totalMoney = 0
      this.coins = []
      this.selected = []
      this.alertSelectCoin = ""
      this.successSelectCoin = "Thank you. Come again soon!"

    },
    CalculateCoin : function(money) {
      
      if ( money % 10 == 0 && money != 0) {
        const change = money - 10    
        console.log(change);
        this.changeCoins.push(10)
        return this.CalculateCoin(change)   
      }
       if ( money % 5 == 0 && money != 0) {
        const change = money - 5    
        console.log(change);
        this.changeCoins.push(5)
        
        return this.CalculateCoin(change)   
      }
       if ( money % 2 == 0 && money != 0) {
        const change = money - 2    
        console.log(change);
        this.changeCoins.push(2)
        
        return this.CalculateCoin(change)   
      }
       if ( money % 1 == 0 && money != 0) {
        const change = money - 1    
        this.changeCoins.push(1)
                
        return this.CalculateCoin(change)   
      }
      
      
    },
    SelectChoice : function(index) {
      const item = this.info[index]
      this.alertSelectCoin = ""

      if (this.totalMoney > 0 && this.totalMoney >= item['price']  ) {
        if ( item['in_stock'] ) {
          const change = this.totalMoney - item['price']
          this.changeCoins = []
          this.CalculateCoin(change)
          this.SetNumber(this.changeCoins)
          this.coins = []
          this.selected = item          
          this.showModelSuccess = true

        } else {
          alert('This product isn\'t available')
        }
      } else {
        this.show = true
        this.alertSelectCoin = "no enough money please select coin more"

      }
      
    },
    GetAPI : function() {
      axios.get('http://www.mocky.io/v2/5af11f8c3100004d0096c7ed').then((result) => {
        this.info = result.data.data
          console.log(this.info)
      })
      this.show = true
    }
  },
  mounted() {
    this.GetAPI()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
