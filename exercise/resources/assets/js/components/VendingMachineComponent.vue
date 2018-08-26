<template>
    <div class="vending-machine">
        <div class="row">
            <div class="col-sm-9">

                <div class="products-list">
                    <div>
                        <div class="row">

                            <div v-for="product in products.data"
                                 class="col-6 col-sm-4 col-md-3 text-center px-1 my-1">
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
            <div class="col-sm-3">
                Menu
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            products: {
                required: true,
                type: Object,
            },
        },

        data() {
            return {
                available_coin: [1, 2, 5, 10],
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
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
            height: 70vh;
            max-height: 70vh;

            @media (min-width: 576px) {
                height: calc(100vh - 80px);
                max-height: calc(100vh - 80px);
            }
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
</style>
