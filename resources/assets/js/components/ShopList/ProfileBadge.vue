<template>
<div>
    <table class="badge-table">
        <tr>
            <td><span class="badge badge-outline" v-cloak># {{ userid }}</span></td>
            <td><span class="total-products" v-cloak>{{ this.totalProducts }} <strong>items</strong></span></td>
            <td><span class="total-products" v-cloak>{{ totalShoplists }} <strong>bags</strong></span></td>
        </tr>
    </table>
</div>
</template>
<script>

import axios from 'axios';

export default{

    props: ['userid'],
    data(){
        return {
            totalProducts: 0,
            totalShoplists: 0,
        }
    },
    mounted: function() {
        this.getTotalProducts();
        this.getTotalShoplists();
    },
    methods: {
        getTotalProducts: function(){
            axios.get('/api/v1/' + this.userid + '/products/count')
                .then(
                    (response) => {
                        this.totalProducts = response.data.totalProducts;
                    }
                )
                .catch(
                     (error) => {
                        //  console.log("Error fetching total products");
                }
            )
        },
        getTotalShoplists: function(){
            axios.get('/api/v1/'+ this.userid +'/shoplists')
                 .then(
                     (response) => {
                         this.totalShoplists = (response.data.shoplists).length;
                     }
                 ).catch(
                     (error) => {
                         console.log('error');
                     }
                 )
        }
    }
}

</script>
