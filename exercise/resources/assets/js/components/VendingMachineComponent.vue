<template>
    <div class="vending-machine">
        <div class="row">
            <div class="col-sm-8 col-md-9">
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

            <div class="col-sm-4 col-md-3 pl-sm-0">
                <div class="row">
                    <div class="col-12 mt-sm-3 text-right px-4">
                        <div class="inserted-coin">
                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZDODUwOyIgY3g9IjI1NiIgY3k9IjI1NiIgcj0iMTY4LjA4NiIvPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGRkRDNjQ7IiBjeD0iMjU2IiBjeT0iMjU2IiByPSIxNDEuNTQ2Ii8+CjxjaXJjbGUgc3R5bGU9ImZpbGw6I0ZGRjA4MjsiIGN4PSIzMjYuNzczIiBjeT0iMTk0LjA3MyIgcj0iMjYuNTQiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGQzg1MDsiIGQ9Ik0yOTcuMzgxLDMyNS4wNTFjLTUzLjM2My04Ljk0NS05NS42MTgtNTIuNzU3LTEwMi4zMjYtMTA2LjQ0NyAgYy0yLjQwNC0xOS4yNDMtMC4zMDMtMzcuNjg2LDUuMzE0LTU0LjUzMmMyLjc3MS04LjMxMy02Ljc2My0xNS4zMS0xNC4wMDYtMTAuMzc5Yy0zNy4xMjQsMjUuMjctNTkuODEyLDcwLjEzLTUzLjAxOCwxMTkuNzc4ICBjNy41MjMsNTQuOTc4LDUyLjQ4Myw5OC45NzUsMTA3LjU5LDEwNS40OWM0MS42MzcsNC45MjIsNzkuNjkzLTEwLjg3NSwxMDUuNDAyLTM4LjM4OGM2LjAxMS02LjQzMywwLjcwMS0xNi45OTktNy45OC0xNS41MjQgIEMzMjUuMzA1LDMyNy4yNjYsMzExLjU1NSwzMjcuNDI3LDI5Ny4zODEsMzI1LjA1MXoiLz4KPHBhdGggZD0iTTI1Niw0MzIuMzhjOTcuMjU3LDAsMTc2LjM4LTc5LjEyMywxNzYuMzgtMTc2LjM4UzM1My4yNTcsNzkuNjIsMjU2LDc5LjYyUzc5LjYyLDE1OC43NDMsNzkuNjIsMjU2ICBTMTU4Ljc0Myw0MzIuMzgsMjU2LDQzMi4zOHogTTI1Niw5Ni4yMDdjODguMTEsMCwxNTkuNzkzLDcxLjY4MiwxNTkuNzkzLDE1OS43OTNTMzQ0LjExLDQxNS43OTMsMjU2LDQxNS43OTMgIFM5Ni4yMDcsMzQ0LjExLDk2LjIwNywyNTZTMTY3Ljg5LDk2LjIwNywyNTYsOTYuMjA3eiIvPgo8cGF0aCBkPSJNMjAyLjM2NywzMDAuNzg2YzAtNC41OC0zLjcxMy04LjI5NC04LjI5NC04LjI5NHMtOC4yOTQsMy43MTMtOC4yOTQsOC4yOTRjMCwyMi40NTYsMjYuNjAxLDQwLjM4NCw2MS45MjcsNDIuODMydjkuNjk1ICBjMCw0LjU4LDMuNzEzLDguMjk0LDguMjk0LDguMjk0czguMjk0LTMuNzEzLDguMjk0LTguMjk0di05LjY5NWMzNS4zMjYtMi40NDgsNjEuOTI3LTIwLjM3Niw2MS45MjctNDIuODMyICBjMC0zMC4wODQtMjguNjA1LTQxLjgyMy02MS45MjctNTEuMTE4di02NC42NjFjMjcuMDk4LDIuMTc4LDQ1LjMzOSwxNC43ODUsNDUuMzM5LDI2LjIwN2MwLDQuNTgsMy43MTMsOC4yOTQsOC4yOTQsOC4yOTQgIHM4LjI5NC0zLjcxMyw4LjI5NC04LjI5NGMwLTIyLjQ1Ni0yNi42MDEtNDAuMzg0LTYxLjkyNy00Mi44MzJ2LTkuNjk1YzAtNC41OC0zLjcxMy04LjI5NC04LjI5NC04LjI5NHMtOC4yOTQsMy43MTMtOC4yOTQsOC4yOTQgIHY5LjY5NWMtMzUuMzI2LDIuNDQ4LTYxLjkyNywyMC4zNzYtNjEuOTI3LDQyLjgzMmMwLDMwLjA4NCwyOC42MDUsNDEuODIzLDYxLjkyNyw1MS4xMTh2NjQuNjYxICBDMjIwLjYwOCwzMjQuODE1LDIwMi4zNjcsMzEyLjIwOCwyMDIuMzY3LDMwMC43ODZ6IE0zMDkuNjMzLDMwMC43ODZjMCwxMS40MjItMTguMjQxLDI0LjAyOS00NS4zMzksMjYuMjA3di02MC4wNSAgQzI5Ny45MzIsMjc2Ljg4MywzMDkuNjMzLDI4NS45MDksMzA5LjYzMywzMDAuNzg2eiBNMjAyLjM2NywyMTEuMjE0YzAtMTEuNDIyLDE4LjI0MS0yNC4wMjksNDUuMzM5LTI2LjIwN3Y2MC4wNSAgQzIxNC4wNjgsMjM1LjExNywyMDIuMzY3LDIyNi4wOTEsMjAyLjM2NywyMTEuMjE0eiIvPgo8cGF0aCBkPSJNNDM3LjAxOSw3NC45ODFDMzg4LjY2OCwyNi42MjgsMzI0LjM4LDAsMjU2LDBDMTgyLjM4NSwwLDExMy42NSwzMC45NzUsNjUuMDQxLDg1LjVsNC41NDMtMzEuOCAgYzAuNjQ3LTQuNTM1LTIuNTA0LTguNzM1LTcuMDM4LTkuMzgzYy00LjUzNi0wLjY0Mi04LjczNSwyLjUwNC05LjM4Myw3LjAzOGwtOC44NDcsNjEuOTI3Yy0wLjQwNiwyLjg0NSwwLjY5LDUuNjk4LDIuODk2LDcuNTQxICBjMS41MTQsMS4yNjMsMy40LDEuOTI2LDUuMzE2LDEuOTI2YzAuODc4LDAsMS43NjQtMC4xMzksMi42MjItMC40MjZsNTMuMDgtMTcuNjkzYzQuMzQ2LTEuNDQ5LDYuNjk0LTYuMTQ1LDUuMjQ2LTEwLjQ5MSAgYy0xLjQ1LTQuMzQ2LTYuMTQ1LTYuNjk2LTEwLjQ5MS01LjI0NmwtMjYuNjY4LDguODlDMTIxLjgzNyw0Ni4wMjEsMTg2LjYwMiwxNi41ODcsMjU2LDE2LjU4NyAgYzYzLjk0OSwwLDEyNC4wNzEsMjQuOTAzLDE2OS4yOTEsNzAuMTIyYzQ1LjIxOSw0NS4yMiw3MC4xMjIsMTA1LjM0Miw3MC4xMjIsMTY5LjI5MXMtMjQuOTAzLDEyNC4wNzEtNzAuMTIyLDE2OS4yOTEgIGMtNDUuMjIsNDUuMjE5LTEwNS4zNDEsNzAuMTIyLTE2OS4yOTEsNzAuMTIyYy00LjU4LDAtOC4yOTQsMy43MTMtOC4yOTQsOC4yOTRTMjUxLjQyLDUxMiwyNTYsNTEyICBjNjguMzgsMCwxMzIuNjY4LTI2LjYyOCwxODEuMDE5LTc0Ljk4MVM1MTIsMzI0LjM4LDUxMiwyNTZTNDg1LjM3MiwxMjMuMzMyLDQzNy4wMTksNzQuOTgxeiIvPgo8cGF0aCBkPSJNMjIxLjc4OSw0OTIuOTg3Yy0yLjgyLTAuNDA0LTUuNjYtMC44NjEtOC40NDEtMS4zNjFjLTQuNTEtMC44MTMtOC44MiwyLjE4Ni05LjYzMSw2LjY5NSAgYy0wLjgxMSw0LjUwOCwyLjE4Niw4LjgyLDYuNjk1LDkuNjMxYzIuOTc2LDAuNTM1LDYuMDE0LDEuMDI1LDkuMDI4LDEuNDU2YzAuMzk4LDAuMDU3LDAuNzk0LDAuMDg1LDEuMTg1LDAuMDg1ICBjNC4wNiwwLDcuNjA4LTIuOTg1LDguMi03LjExOUMyMjkuNDcyLDQ5Ny44MzgsMjI2LjMyMyw0OTMuNjM3LDIyMS43ODksNDkyLjk4N3oiLz4KPHBhdGggZD0iTTE4MS4yNTQsNDgzLjUxNmMtNS4yMjEtMS43MTQtMTAuNDUxLTMuNjM2LTE1LjU0Ni01LjcxMmMtNC4yNC0xLjcyNi05LjA4MSwwLjMwOS0xMC44MTEsNC41NTIgIGMtMS43MjgsNC4yNDIsMC4zMSw5LjA4Miw0LjU1MiwxMC44MTFjNS40NTEsMi4yMiwxMS4wNDYsNC4yNzYsMTYuNjMyLDYuMTFjMC44NTksMC4yODIsMS43MzEsMC40MTYsMi41ODksMC40MTYgIGMzLjQ4NiwwLDYuNzMxLTIuMjE2LDcuODc5LTUuNzA5QzE4Ny45NzYsNDg5LjYzLDE4NS42MDYsNDg0Ljk0NSwxODEuMjU0LDQ4My41MTZ6Ii8+CjxwYXRoIGQ9Ik0yMi4wOTIsMzA3LjI5Yy0xLjE3MS01LjM2OC0yLjE2OS0xMC44NDgtMi45NjYtMTYuMjg4Yy0wLjY2NS00LjUzMy00Ljg3My03LjY2NS05LjQwNy03LjAwNCAgYy00LjUzMywwLjY2My03LjY2OSw0Ljg3Ni03LjAwNCw5LjQwN2MwLjg1Myw1LjgxOCwxLjkxOSwxMS42NzksMy4xNzIsMTcuNDJjMC44NDcsMy44OCw0LjI4MSw2LjUyOCw4LjA5NSw2LjUyOCAgYzAuNTg2LDAsMS4xODEtMC4wNjIsMS43NzYtMC4xOTJDMjAuMjMyLDMxNi4xODQsMjMuMDY5LDMxMS43NjUsMjIuMDkyLDMwNy4yOXoiLz4KPHBhdGggZD0iTTExLjUxNCwyMTUuMDkxYzAuNTUyLDAuMTExLDEuMSwwLjE2NCwxLjY0MiwwLjE2NGMzLjg2OSwwLDcuMzMyLTIuNzIzLDguMTIyLTYuNjYyYzEuMDgzLTUuMzkyLDIuMzctMTAuODE0LDMuODI0LTE2LjExMyAgYzEuMjEyLTQuNDE3LTEuMzg2LTguOTgtNS44MDMtMTAuMTkyYy00LjQxMy0xLjIxMi04Ljk4LDEuMzg3LTEwLjE5Miw1LjgwNWMtMS41NTYsNS42NjctMi45MzIsMTEuNDY2LTQuMDksMTcuMjM0ICBDNC4xMTQsMjA5LjgxNyw3LjAyMywyMTQuMTksMTEuNTE0LDIxNS4wOTF6Ii8+CjxwYXRoIGQ9Ik0zNy42NTgsMzU0LjM1OGMtMi4yNi01LjAwOC00LjM3Mi0xMC4xNi02LjI3OC0xNS4zMTJjLTEuNTg5LTQuMjk2LTYuMzYxLTYuNDkxLTEwLjY1Ni00LjkwMSAgYy00LjI5NiwxLjU4OS02LjQ5LDYuMzYtNC45MDEsMTAuNjU2YzIuMDM4LDUuNTEsNC4yOTcsMTEuMDIxLDYuNzE1LDE2LjM4YzEuMzg1LDMuMDY5LDQuNDAzLDQuODg0LDcuNTY1LDQuODg0ICBjMS4xNCwwLDIuMjk5LTAuMjM3LDMuNDA2LTAuNzM2QzM3LjY4NSwzNjMuNDQ1LDM5LjU0MSwzNTguNTMzLDM3LjY1OCwzNTQuMzU4eiIvPgo8cGF0aCBkPSJNOC4zNjgsMjY2LjM1NGM0LjU4LTAuMDM2LDguMjY0LTMuNzc5LDguMjI4LTguMzU5Yy0wLjAwNi0wLjY2Ny0wLjAwOS0xLjMzNC0wLjAwOS0xLjk5NWMwLTQuODUsMC4xNDctOS43NTMsMC40MzYtMTQuNTc1ICBjMC4yNzUtNC41NzMtMy4yMDktOC41MDItNy43ODItOC43NzZjLTQuNTc4LTAuMjc4LTguNTAyLDMuMjA5LTguNzc2LDcuNzgyQzAuMTU3LDI0NS41ODIsMCwyNTAuODIsMCwyNTYuMDA3ICBjMCwwLjcwNywwLjAwMywxLjQxMywwLjAwOSwyLjExOWMwLjAzNiw0LjU1OCwzLjc0Miw4LjIyOCw4LjI5Myw4LjIyOEM4LjMyMiwyNjYuMzU0LDguMzQ2LDI2Ni4zNTQsOC4zNjgsMjY2LjM1NHoiLz4KPHBhdGggZD0iTTEzNS45OTUsNDYzLjIxMmMtNC43NS0yLjc1Ny05LjQ3LTUuNzE5LTE0LjAzLTguODA1Yy0zLjc5NC0yLjU2Ny04Ljk1LTEuNTc0LTExLjUxNywyLjIxOSAgYy0yLjU2OCwzLjc5NC0xLjU3NCw4Ljk0OSwyLjIxOSwxMS41MTdjNC44NzUsMy4zLDkuOTIyLDYuNDY3LDE1LjAwMSw5LjQxNWMxLjMxLDAuNzYxLDIuNzQxLDEuMTIyLDQuMTU2LDEuMTIyICBjMi44NiwwLDUuNjQyLTEuNDgxLDcuMTgxLTQuMTMyQzE0MS4zMDUsNDcwLjU4OCwxMzkuOTU3LDQ2NS41MTIsMTM1Ljk5NSw0NjMuMjEyeiIvPgo8cGF0aCBkPSJNNTMuMzI0LDM4My41MDJjLTIuNDQyLTMuODc0LTcuNTYzLTUuMDM3LTExLjQzOS0yLjU5MmMtMy44NzUsMi40NDMtNS4wMzUsNy41NjQtMi41OTIsMTEuNDM5ICBjMy4xMzUsNC45NzMsNi40ODMsOS44OTgsOS45NTIsMTQuNjQxYzEuNjI0LDIuMjIsNC4xNDYsMy4zOTcsNi43LDMuMzk3YzEuNywwLDMuNDE0LTAuNTIxLDQuODktMS42ICBjMy42OTctMi43MDUsNC41MDItNy44OTMsMS43OTctMTEuNTlDNTkuMzg5LDM5Mi43Niw1Ni4yNTcsMzg4LjE1NCw1My4zMjQsMzgzLjUwMnoiLz4KPHBhdGggZD0iTTk1Ljg5NCw0MzQuMDA1Yy00LjA4Ny0zLjY3OC04LjA5OS03LjU0Ny0xMS45MjQtMTEuNDk3Yy0zLjE4Ni0zLjI5MS04LjQzNS0zLjM3Ni0xMS43MjctMC4xODkgIGMtMy4yOTEsMy4xODYtMy4zNzYsOC40MzYtMC4xODksMTEuNzI3YzQuMDg4LDQuMjIzLDguMzc2LDguMzU4LDEyLjc0NCwxMi4yODljMS41ODYsMS40MjcsMy41NywyLjEyOSw1LjU0NiwyLjEyOSAgYzIuMjY5LDAsNC41MjktMC45MjYsNi4xNjctMi43NDVDOTkuNTc1LDQ0Mi4zMTMsOTkuMjk4LDQzNy4wNjksOTUuODk0LDQzNC4wMDV6Ii8+CjxwYXRoIGQ9Ik0yNS4xOTQsMTY1LjUwNGMxLjA3MiwwLjQ2MiwyLjE4NywwLjY4MiwzLjI4NCwwLjY4MmMzLjIwOSwwLDYuMjY2LTEuODc0LDcuNjE4LTUuMDA3YzEuMTI0LTIuNjAyLDIuMzEtNS4yMjEsMy41MjgtNy43ODMgIGMxLjk2NS00LjEzOCwwLjIwNS05LjA4NC0zLjkzMi0xMS4wNTFjLTQuMTM5LTEuOTY1LTkuMDg2LTAuMjAzLTExLjA1MSwzLjkzMmMtMS4zMDIsMi43NC0yLjU3MSw1LjU0LTMuNzczLDguMzI0ICBDMTkuMDUyLDE1OC44MDYsMjAuOTg5LDE2My42ODcsMjUuMTk0LDE2NS41MDR6Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo="
                                 class="refund-icon"
                                 @click="refund()"/>
                            {{ inserted_coin }}
                        </div>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="row justify-content-center">
                            <div v-for="coin in available_coins"
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
            available_coins: {
                required: true,
                type: Array,
            },
            get_products_route: {
                required: true,
                type: String,
            },
            money_log_route: {
                required: true,
                type: String,
            },
            money_statuses: {
                required: true,
                type: Object,
            },
            un_refund: {
                required: true,
                type: Number,
            },
        },

        data() {
            return {
                products: [],
                inserted_coin: this.un_refund,
                refund_timer: null,
            }
        },

        mounted() {
            this.getProducts();

            this.refund();
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

                this.saveMoneyLog(coin, this.money_statuses.insert);
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
                            this.saveMoneyLog(product.price, this.money_statuses.sell);

                            let html = 'You got: ' + product.name + '.';

                            if (change.length > 0) {
                                this.saveMoneyLog(change, this.money_statuses.change);

                                html += ' and ' + change + ' change.';
                            }

                            swal({
                                type: 'success',
                                title: 'Thank you',
                                html: html,
                            });

                            this.getProducts();
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
                this.clearRefundTimer();

                let change = coin - price;

                let change_coins = [];

                while (change !== 0) {
                    let change_coin = findLast(this.available_coins, (coin) => {
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

                            this.saveMoneyLog(change, this.money_statuses.refund);

                            swal({
                                type: 'warning',
                                title: 'Refund',
                                html: html,
                            })
                        });
                }
            },

            /**
             * Save money log after insert, change and refund.
             *
             * @param value
             * @param status
             */
            saveMoneyLog(value, status) {
                let data = {
                    values: typeof value === 'number' ? [value] : value,
                    status: status,
                };

                axios.post(this.money_log_route, data)
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

        img.refund-icon {
            max-width: 60px;
            max-height: 60px;
            float: left;
            margin-top: 10px;

            &:hover {
                cursor: pointer;
            }
        }
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
