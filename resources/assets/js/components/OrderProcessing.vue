<script>


    export default {

        data : function(){

            return {

                loading : false,
                shop : '',
                orderIds : [],
                result : null,

            }

        }
        ,

        mounted() {
            
            this.loading = true;

            let orderIdsElements = document.querySelectorAll(".orderIds");


            orderIdsElements.forEach(function(item , index){

                this.orderIds.push(item.value);

            },this);

            this.shop = document.getElementById("shopName").value;

            axios.post('/shopify/order/processing' , {

                ids : this.orderIds,
                shop : this.shop

            }).then((response) =>{

                this.loading = false;
                this.result = response.data;

                console.log(this.result);


            });

        }
    }
</script>
