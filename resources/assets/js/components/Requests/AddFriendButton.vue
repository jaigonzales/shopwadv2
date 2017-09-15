<template>
<div>
    <div v-if="this.friendshipStatus === 0">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="sendFriendRequest" class="form-horizontal" role="form">
            <input type="hidden" name="receiverid" v-model="receiverid" />
            <button type="submit" class="btn btn-primary btn-xs" id="addUser" >Add Fellow</button>
        </form>
    </div>
    <div v-else-if="this.friendshipStatus === 1">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="cancelFriendRequest" class="form-horizontal" role="form">
            <input type="hidden" name="receiverid" v-model="receiverid" />
            <button type="submit" class="btn btn-default btn-xs" id="cancelRequest" >Cancel Friend Request</button>
        </form>
    </div>
    <div v-else-if="this.friendshipStatus === 2">
        <approval-buttons :senderid="receiverid"></approval-buttons>
    </div>
    <div v-else-if="this.friendshipStatus === 3">
        <i class="fa fa-check-circle" aria-hidden="true" style="color: #6eb34c"></i> Fellows
    </div>
</div>
</template>

<script>

import VueResource from 'vue-resource';
import ApproveDeny from './ApproveDenyFriendRequest.vue';
import axios from 'axios';

export default {
    props: ['senderid', 'receiverid'],
    data() {
        return {
            friendshipStatus: 0, //default false
            sender: null,
            receiver: null,
        }
    },
    mounted: function(){
        this.checkFriendStatus();
    },
    methods: {
        checkFriendStatus: function() {
            axios.get('/api/v1/friendship/check/' + this.receiverid)
                .then(
                    (response) => {
                      this.friendshipStatus = response.data.status;
                    }
                )
                .catch(
                    (error) => {}
                )
        },
        sendFriendRequest: function(){
            axios.get('/api/v1/friendship/add/' + this.receiverid)
                .then(
                (response) => {
                    this.checkFriendStatus();
                }
            ).catch(
                (error) => { }
            );
        },
        acceptFriendRequest: function(){

        },
        cancelFriendRequest: function(){
            axios.get('/api/v1/friendship/cancel-friend-request/' + this.receiverid)
                 .then(
                     (response) => {
                         this.checkFriendStatus();
                     }
                 ).catch(
                    (error) => { }
                 )
        },

    }
}

</script>
