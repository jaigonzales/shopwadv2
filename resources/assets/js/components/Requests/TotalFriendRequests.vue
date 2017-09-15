<template >
    <span class="notification notif-red notif-small" v-if="this.totalRequests >= 1">{{ totalRequests }}</span>
</template>

<script>

import axios from 'axios';

export default {
    data() {
        return {
            totalRequests: 0
        }
    },
    mounted: function(){
        this.getTotalFriendRequests();
    },
    methods: {
        getTotalFriendRequests: function(){
            axios.get('/api/v1/friendship/friend-requests')
                 .then(
                     (response) => {
                         this.totalRequests = response.data.total;
                     }
                 )
                 .catch(
                     (error) => { }
                 );
        }
    }
}

</script>
