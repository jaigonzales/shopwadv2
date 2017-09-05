<template>
<div class="accept-btn-group">
    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="acceptRequest" class="form-horizontal" role="form">
        <input type="hidden" name="friendid" v-model="friendid" />
        <input type="hidden" name="userid" v-model="userid" />
        <button type="submit" class="btn btn-primary btn-xs" id="accept-btn"><i class="fa fa-check" aria-hidden="true"></i> Accept</button>
    </form>
    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="declineRequest" class="form-horizontal" role="form">
        <input type="hidden" name="friendid" v-model="friendid" />
        <button type="submit" class="btn btn-default btn-xs" id="decline-btn"><i class="fa fa-times" aria-hidden="true"></i> Decline</button>
    </form>
</div>
</template>
<style scoped>
.accept-btn-group{
    display: inline-block;
}
form{
    display: inline-block;
}

</style>

<script>

import axios from 'axios';

export default {
    props: ['userid', 'friendid'],
    data() {
        return {
            accepted: false
        }
    },
    mounted: function(){

    },
    methods: {
        acceptRequest: function() {
            axios.post('/api/v1/approvefreq', {
                    friendid: this.friendid,
                    userid: this.userid
                }).then(
                     (response) => {
                         console.log('update successfully');
                     }
                 )
                 .catch(
                    (error) => {
                        console.log("An error has occured.");
                    }
                 );
        },
        declineRequest: function() {

        }
    }
}

</script>
