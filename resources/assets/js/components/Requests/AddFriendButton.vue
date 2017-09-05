<template>
<div>
    <div v-if="this.friendshipStatus[0] === 0">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="sendFriendRequest" class="form-horizontal" role="form">
            <input type="hidden" name="receiverid" v-model="receiverid" />
            <button type="submit" class="btn btn-primary btn-xs" id="addUser" >Connect</button>
        </form>
    </div>
    <div v-else-if="this.friendshipStatus[0] === 1">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="cancelFriendRequest" class="form-horizontal" role="form">
            <input type="hidden" name="receiverid" v-model="receiverid" />
            <button type="submit" class="btn btn-default btn-xs" id="cancelRequest" >Cancel Friend Request</button>
        </form>
    </div>
    <div v-else-if="this.friendshipStatus[0] === 2">
        <span class="label label-info"><i class="fa fa-check-circle" aria-hidden="true"></i> Already your fellow</span>
    </div>
</div>
</template>

<script>

import VueResource from 'vue-resource';
import axios from 'axios';

export default {
    props: ['senderid', 'receiverid'],
    data() {
        return {
            friendshipStatus: [], //default false
            sender: null,
            receiver: null
        }
    },
    mounted: function(){
        this.checkFriendStatus();

    },
    methods: {
        checkFriendStatus: function() {

            axios.get('/api/v1/' + this.senderid + '/user/' + this.receiverid)
                 .then(
                     (response) => {
                         this.friendshipStatus = response.data.fsStatus;
                         if ( this.friendshipStatus.length <= 0) {
                             this.friendshipStatus[0] = 0
                         }
                     }
                 ).catch(
                     (error) => {
                         console.log('error checking friend status');
                     }
                 )
        },
        sendFriendRequest: function(){

            axios.post( '/api/v1/' + this.senderid + '/sfreq', {
                    sender_id: this.senderid,
                    receiver_id: this.receiverid,
                }).then(
                    (response) => {
                        this.friendshipStatus = 1;
                        this.checkFriendStatus();
                    }
                ).catch(
                    (error) => {
                        console.log('error sending friend request');
                    }
                )
        },
        cancelFriendRequest: function(){
            axios.delete('/api/v1/' + this.senderid + '/cancel/' + this.receiverid +'/sfreq')
                 .then(
                     (response) => {
                         this.checkFriendStatus();
                     }
                 ).catch(
                    (error) => {

                    }
                 )
        },
        animation: function(){
            if ( !($('#addUser').hasClass('active')) && ($('#addUser').find('.fa').length <= 0) ){
                $('#addUser').text("Connecting...");
                $('#addUser').addClass('disabled').prepend('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> ');
            }
        }
    }
}

</script>
