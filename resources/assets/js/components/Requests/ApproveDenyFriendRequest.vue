<template>
    <div>
        <div v-if="accepted"><i class="fa fa-check" aria-hidden="true"></i> Request accepted</div>
        <div v-else-if="denied">Declined</div>
        <div v-else class="accept-btn-group">
            <button class="btn btn-default btn-sm" @click.prevent="denyFriendRequest" id="decline" >
                {{ isLoading ? "Loading..." : "Decline" }}
            </button>
            <button class="btn btn-primary btn-sm" @click.prevent="approveFriendRequest" id="accept">
                {{ isLoading ? "Loading..." : "Accept" }}
            </button>
        </div>
    </div>
</template>
<style scoped>
.accept-btn-group{
    display: inline-block;
}

</style>

<script>

import axios from 'axios';

export default {
    props: ['senderid'],
    data() {
        return {
            accepted: false,
            denied: false,
            isLoading: false,
        }
    },
    methods: {
        approveFriendRequest: function() {
            this.isLoading = true;
            axios.get('/api/v1/friendship/approve/' + this.senderid )
                .then(
                     (response) => {
                         this.isLoading = false;
                         this.accepted = true;
                     }
                 )
                 .catch(
                    (error) => { }
                 );
        },
        denyFriendRequest: function() {
            this.isLoading = true;
            axios.get('/api/v1/friendship/deny/' + this.senderid)
                .then(
                    (response) => {
                        this.isLoading = false;
                        this.denied = true;
                    }
                )
                .catch(
                    (error) => { }
                );
        },
    }
}

</script>
