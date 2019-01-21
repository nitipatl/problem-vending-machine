<template>
  <div >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h3>
            Problem Vending Machine
          </h3>
          <h5>
            Money : {{ totalMoney }} 
            <button type="button" v-on:click="show = true" class="btn btn-primary">
                Select Coin
            </button>
          </h5>
        </div>
      </div>
      <div class="row text-center">
          <div class="col-6 mb-2" v-for="(item, index) in info" :key="index">
            <div class="card">
              <img :src="item.image" class="card-img-top">
              <div class="card-body">
                <p class="card-text">{{ item.name }} ราคา : {{ item.price }}</p>
              </div>
              <button type="button" v-on:click="SelectChoice(index)" v-bind:class="{ 'active' : selected == index }"  class="w-100 btn btn-primary">
                Select
              </button>
            </div>
          </div>
      </div>
    </div>

  <!-- Modal Component -->
    <b-modal v-model="show" @ok="PlusNumberInArray" no-close-on-esc no-close-on-backdrop hide-header-close ok-only id="modal-center" centered title="Select coins">
      <div class="text-center">
        <p class="text-danger"> {{ alertSelectCoin }} </p>
        <img src="../assets/money.png" style="width:100px" alt="">

      </div> 
      <div v-for="(item, index) in simpleCoins" :key="index" class="row mt-5 ">
        <div class="col-7 text-right">
          <button type="button" @click="PullCoins(item)"  class="w-10 btn btn-secondary">-</button>          
          <button type="button" class="w-25 btn btn-secondary">{{ item }}</button>
          <button type="button" @click="PushCoins(item)" class="w-10 btn btn-secondary">+</button>          

        </div>
        <div v-if="item == 10" class="col pt-2 text-left">
            x {{ numberTenCoins }} 
        </div>
        <div v-else-if="item == 5" class="col pt-2 text-left">
            x {{ numberFiveCoins }}
        </div>
        <div v-if="item == 2" class="col pt-2 text-left">
            x {{ numberTwoCoins }}
        </div>
        <div v-if="item == 1" class="col pt-2 text-left">
            x {{ numberOneCoins }}
        </div>
      </div>

    </b-modal>
    <b-modal v-model="showModelSuccess" @ok="SuccessFlow" no-close-on-esc no-close-on-backdrop hide-header-close ok-only id="modal-center" centered title="Change coins">
      <div class="text-center">
        <p class="text-success"> Thank you </p>
        <img src="../assets/money.png" style="width:100px" alt="">

         <div v-for="(item, index) in simpleCoins" :key="index" class="row mt-5 ">
            <div class="col-7 text-right">
              Coin : {{  item  }}   

            </div>
            <div v-if="item == 10" class="col text-left">
                x {{ numberTenCoins }} 
            </div>
            <div v-else-if="item == 5" class="col text-left">
                x {{ numberFiveCoins }}
            </div>
            <div v-if="item == 2" class="col text-left">
                x {{ numberTwoCoins }}
            </div>
            <div v-if="item == 1" class="col text-left">
                x {{ numberOneCoins }}
            </div>
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
      selected : null,
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
    PlusNumberInArray : function() {
      this.coins.forEach(element => {
        this.totalMoney += element
      });      
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
    PullCoins : function(bath) {
       let index = this.coins.indexOf(bath);
 
        if (index > -1) {
          this.coins.splice(index, 1);
        }
        this.SetNumber(this.coins)

    },
    PushCoins : function(bath) {
      this.coins.push(bath)
      this.SetNumber(this.coins)
    },
    SuccessFlow : function() {
       this.numberOneCoins = 0
          this.numberTwoCoins = 0
          this.numberFiveCoins = 0
          this.numberTenCoins = 0
          this.show = true
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
      this.selected = index
      const item = this.info[this.selected]
      this.alertSelectCoin = ""

      if (this.totalMoney > 0 && this.totalMoney >= item['price']  ) {
        if ( item['in_stock'] ) {
          const change = this.totalMoney - item['price']
          this.changeCoins = []
          this.CalculateCoin(change)
          this.SetNumber(this.changeCoins)
          this.coins = []
          this.totalMoney = 0
         
          this.showModelSuccess = true
        } else {
          alert('his product isn\'t available')
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
