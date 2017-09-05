<template >
    <span class="badge badge-danger" v-if="this.totalRequests.length >= 1">{{ this.totalRequests.length }}</span>
</template>

<script>

import axios from 'axios';

export default {

    props: ['userid'],
    data() {
        return {
            totalRequests: []
        }
    },
    mounted: function(){
        this.getTotalPendingRequests();
    },
    methods:{
        getTotalPendingRequests: function(){
            axios.get('/api/v1/' + this.userid + '/pfreqs')
                 .then(
                     (response) => {
                         this.totalRequests = response.data.pendingReqs;
                     }
                 )
                 .catch(
                     (error) => {
                         console.log("error getting total pending requests");
                     }
                 )
        }
    }
}

</script>
