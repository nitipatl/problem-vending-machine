<template>
    <div class="vending-machine">
        <div class="row">
            <div class="col-sm-9">
                <div class="products-list">
                    <div>
                        <div class="row">

                            <div v-for="product in products.data"
                                 class="col-6 col-md-3 text-center px-1 my-1"
                                 @click="selectProduct(product)">
                                <div class="product">
                                    <img :src="product.image"
                                         :alt="product.name"
                                         class="product-image">
                                    <div class="font-weight-bold">
                                        {{ product.name }}
                                        <small>[{{ product.price }}฿]</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3 pl-sm-0">
                <div class="row">
                    <div class="col-12 mt-sm-3 text-right px-4">
                        <div class="inserted-coin">
                            {{ inserted_coin }}
                        </div>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="row justify-content-center">
                            <div v-for="coin in available_coin"
                                 class="col-auto p-2"
                                 @click="insertCoin(coin)">
                                <div class="coin">
                                    <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTEuOTk3IDUxMS45OTciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMS45OTcgNTExLjk5NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxjaXJjbGUgc3R5bGU9ImZpbGw6I0ZGQzg0MzsiIGN4PSIyNTUuOTk4IiBjeT0iMjU1Ljk5OCIgcj0iMjU1Ljk5OCIvPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNENDkwMDA7IiBjeD0iMjU1Ljk5OCIgY3k9IjI1NS45OTgiIHI9IjIwNy43NDUiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGQzg0MzsiIGQ9Ik0yNTkuMjAzLDEwMi4zNjFjMTAuMjY2LDAsMTguNDA4LDguMTQyLDE4LjQwOCwxOC40MDh2NC45NTZjMTkuMTE3LDIuODMyLDM2LjEwOCw4LjQ5Niw1MS4zMywxNi45OTMgIGM2LjcyNiwzLjg5MywxMi43NDUsMTAuNjIsMTIuNzQ1LDIxLjI0MWMwLDEzLjQ1Mi0xMC42MjEsMjMuNzE4LTI0LjA3MywyMy43MThjLTQuMjQ3LDAtOC40OTYtMS4wNjItMTIuMzktMy4xODYgIGMtOS45MTItNS4zMS0xOS44MjUtOS41NTgtMjkuMzgzLTEyLjAzNnY1My44MWM1My44MDksMTQuNTEzLDc2LjgyLDM2LjQ2Miw3Ni44Miw3Ni4xMTFzLTMwLjQ0NCw2NS4xMzctNzUuMDUsNzAuMDkydjE4Ljc2MiAgYzAsMTAuMjY2LTguMTQyLDE4LjQwOS0xOC40MDgsMTguNDA5Yy0xMC4yNjYsMC0xOC40MDgtOC4xNDMtMTguNDA4LTE4LjQwOXYtMTkuMTE2Yy0yNS4xMzQtMy4xODYtNDguODU0LTEyLjAzNi02OS43NC0yNC43ODEgIGMtNy40MzQtNC42MDEtMTIuMDM2LTExLjY4MS0xMi4wMzYtMjEuMjRjMC0xMy44MDYsMTAuNjIxLTI0LjA3MywyNC40MjctMjQuMDczYzQuNjAyLDAsOS41NTgsMS43NywxMy44MDcsNC42MDIgIGMxNC44NjgsOS41NTgsMjkuMDI5LDE2LjI4NSw0NS4zMTMsMTkuODI1di01Ni4yODhjLTUwLjk3OC0xMy44MDYtNzYuMTEyLTMzLjI3Ni03Ni4xMTItNzUuNDAzICBjMC0zOC45NDEsMjkuNzM3LTY1LjEzNyw3NC4zNDItNjkuNzR2LTQuMjQ4QzI0MC43OTUsMTEwLjUwMywyNDguOTM3LDEwMi4zNjEsMjU5LjIwMywxMDIuMzYxeiBNMjQyLjU2NiwyMTcuMDU5di00Ny43OTEgIGMtMTYuOTkzLDIuNDc5LTI0LjQyNywxMC45NzUtMjQuNDI3LDIyLjMwM0MyMTguMTM5LDIwMi41NDUsMjIzLjA5NSwyMDkuOTc5LDI0Mi41NjYsMjE3LjA1OXogTTI3NS44NDIsMjc5LjAxMXY0OS4yMDcgIGMxNi42MzktMi40NzgsMjUuMTM0LTEwLjI2NiwyNS4xMzQtMjMuMDExQzMwMC45NzcsMjkzLjUyNSwyOTQuOTU5LDI4NS43MzYsMjc1Ljg0MiwyNzkuMDExeiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K"
                                         :alt="coin">
                                    <div>{{ coin }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import findLast from 'lodash/findLast';

    export default {
        props: {
            get_products_route: {
                required: true,
                type: String,
            },
        },

        data() {
            return {
                products: [],
                available_coin: [1, 2, 5, 10],
                inserted_coin: 0,
                refund_timer: null,
            }
        },

        mounted() {
            this.getProducts();
        },

        methods: {
            /**
             * Get products from API.
             */
            getProducts() {
                axios.get(this.get_products_route)
                    .then(response => {
                        this.products = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },

            /**
             * When user click on coin.
             *
             * @param coin
             */
            insertCoin(coin) {
                this.setRefundTimer();

                this.inserted_coin += coin;
            },

            /**
             * When user click on product.
             *
             * @param product
             */
            selectProduct(product) {
                this.setRefundTimer();

                if (! product.in_stock) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'This product not available!',
                    })
                } else if (this.inserted_coin < product.price) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You don\'t have enough money!',
                    })
                } else {
                    this.calculateChange(this.inserted_coin, product.price)
                        .then(change => {
                            let html = 'You got: ' + product.name + '.';

                            if (change.length > 0) {
                                html += ' and ' + change + ' change.';
                            }

                            swal({
                                type: 'success',
                                title: 'Thank you',
                                html: html,
                            });

                            this.getProducts();
                            this.clearRefundTimer();
                        });
                }
            },

            /**
             * Calculate change and return coins to user.
             *
             * @param coin
             * @param price
             * @returns {Promise<Array>}
             */
            async calculateChange(coin, price) {
                let change = coin - price;

                let change_coins = [];

                while (change !== 0) {
                    let change_coin = findLast(this.available_coin, (coin) => {
                        return coin === change || coin <= change;
                    });

                    change -= change_coin;
                    change_coins.push(change_coin);
                }

                this.inserted_coin = 0;

                return change_coins;
            },

            /**
             * Set refund timer when user insert coin and no action in 10 seconds.
             */
            setRefundTimer() {
                this.clearRefundTimer();

                this.refund_timer = setTimeout(() => {
                    this.refund();
                }, 10000);
            },

            /**
             * Clear refund timer when user got product. Or before re set refund timer.
             */
            clearRefundTimer() {
                clearTimeout(this.refund_timer);
            },

            /**
             * Refund after user have no action.
             */
            refund() {
                if (this.inserted_coin > 0) {
                    this.calculateChange(this.inserted_coin, 0)
                        .then(change => {
                            let html = 'You got refund ' + change;

                            swal({
                                type: 'warning',
                                title: 'Refund',
                                html: html,
                            })
                        });
                }
            },
        },
    }
</script>

<style lang="scss">
    .vending-machine {
        border-radius: 20px;
        margin: 10px;
        padding: 10px;
        background: orange;
        height: calc(100vh - 20px);

        & > div {
            height: 100%;
        }
    }

    .products-list {
        border-radius: 20px;
        margin: 10px;
        padding: 10px 20px;
        background: white;
        height: auto;
        overflow: auto;

        & > div {
            height: 65vh;
            max-height: 65vh;

            @media (min-width: 576px) {
                height: calc(100vh - 80px);
                max-height: calc(100vh - 80px);
            }
        }

        @media (min-width: 576px) {
            margin: 10px 0 10px 10px;
        }
    }

    .product {
        border-radius: 5px;
        padding: 5px;
        background: rgba(0, 0, 0, 0.1);
        height: 100%;

        .product-image {
            max-width: 100%;
        }

        &:hover {
            background: rgba(0, 153, 51, 0.1);
            cursor: pointer;
        }
    }

    .inserted-coin {
        font-size: 80px;
        line-height: 80px;
        padding: 5px 20px 5px 5px;
        border-radius: 20px;
        background: rgba(0, 102, 0, 0.3);
    }

    div.coin {
        position: relative;
        text-align: center;

        &:hover {
            cursor: pointer;
        }

        &, img {
            max-width: 60px;
            max-height: 60px;
        }

        div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            font-weight: bold;
            text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;;
        }
    }
</style>
