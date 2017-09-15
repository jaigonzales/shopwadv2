<template>
    <div class="opt">
        <div v-if="isBlocked">
            Blocked
        </div>
        <div v-else>
        <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
        <ul class="dropdown-menu pull-right">
            <li v-if="this.friendshipStatus === 3"><a href="#" @click.prevent="unfriend" id="unfriend">Unfriend</a></li>
            <li v-if="this.friendshipStatus != 4"><a href="#" @click.prevent="block" id="block">Block</a></li>
        </ul>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        props: ['recipientid'],
        data() {
            return {
                init: null,
                isLoading: false,
                isUnfriended: false,
                isBlocked: false,
                isUnblocked: false,
                friendshipStatus: false
            }
        },
        mounted: function(){
           this.checkFriendStatus();
        },
        methods: {

            checkFriendStatus: function() {
                axios.get('/api/v1/friendship/check/' + this.recipientid)
                    .then(
                        (response) => {
                            this.friendshipStatus = response.data.status;
                        }
                    )
                    .catch(
                        (error) => {}
                    )
            },

            unfriend: function(event){
                axios.get('/api/v1/friendship/unfriend/' + this.recipientid)
                    .then(
                        (response) => {
                            swal(
                                'Success',
                                'User unfriended successfully',
                                'success'
                            ).then(function(){
                                location.reload();
                            })
                        }
                    )
                    .catch(
                        (error) => { }
                    )
            },

            block: function(){
                axios.get('/api/v1/friendship/block/' + this.recipientid)
                    .then(
                        (response) => {
                            swal(
                                'Success',
                                'User blocked successfully',
                                'success'
                            ).then(function(){
                                location.reload();
                            })
                        }
                    )
                    .catch(
                        (error) => { }
                    )
            },
        }
    }
</script>