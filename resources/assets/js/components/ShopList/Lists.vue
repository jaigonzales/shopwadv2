<template>
<div>
    <div>
        <div class="create-btn" v-if="lists.length >= 1">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#create-list">Create a Shoplist</button>
        </div>
        <div v-else>
            <table class="empty-list-container">
                <tr>
                    <td class="align-middle">
                        <h3>Your dashboard is empty.</h3>
                        <p>Start creating your first shoplist</p>
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#create-list">Create a Shoplist</button>
                    </td>
                </tr>
            </table>
        </div>
        <ul class="shoplists-list list-group">
            <user-list v-for="list in lists"
                       v-bind:key="list.id"
                       :userid="userid"
                       :li="list"
                       @listDeleted="onListDeleted($event)">
            </user-list>
        </ul>
        <v-paginator :resource_url="resource_url" ref="vpaginator" @update="updateResource"></v-paginator>
</div>
    <!-- Create form -->
    <div id="create-list" class="modal fade" role="dialog">
        <form method="POST" enctype="multipart/form-data" @submit.prevent="onSubmitted" class="form-horizontal" role="form">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Shoplist</h4>
                </div>

                <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <div>
                                <input id="title" type="text" v-model="shoplistTitle" class="form-control" placeholder="What will be the list's title?" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="control-label">Description</label>
                            <div>
                                <textarea id="desc" v-model="shoplistDesc" class="form-control" maxlength="99" value="" placeholder="Write a short description of the list (optional)"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="privacy" class="control-label">Privacy</label>
                            <div>
                                <select id="privacy" v-model="shoplistPrivacy" class="form-control">
                                    <option v-bind:value="0">Public</option>
                                    <option v-bind:value="1">Fellows</option>
                                    <option v-bind:value="2">Only Me</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Shoplist</button>
                </div>

            </div>

        </div>
        </form>
    </div>
</div>
</template>

<script>

import VueResource from 'vue-resource';
import VuePaginator from 'vuejs-paginator';
import List from './List.vue';
import axios from 'axios';

export default {
    props: ['userid'],
    components: {
        'user-list': List,
        VPaginator: VuePaginator,
    },
    data() {
        return {
            lists: [],
            resource_url: '/api/v1/' + this.userid + '/shoplists',
            shoplistId: '',
            shoplistTitle: '',
            shoplistDesc: '',
            shoplistPrivacy: '0',
            count: 0
        }
    },
    mounted: function() {
//        this.getUserLists();
    },
    methods: {

        onSubmitted: function() {
            let vm = this;
            axios.post( 'api/v1/shoplist', {
                    userid: this.userid,
                    title: this.shoplistTitle,
                    desc: this.shoplistDesc,
                    privacy: this.shoplistPrivacy
                })
                .then(
                    (response) => {

                        $('#create-list').modal('hide');
//                        this.getUserLists();
                        this.shoplistTitle = null;
                        this.shoplistDesc = null;
                        this.shoplistPrivacy = 0;
                        toastr.success('Shoplist Created Successfully.', 'Success Alert', {
                            timeOut: 1000
                        });
                        vm.$refs.vpaginator.fetchData(vm.resource_url);

                    },
                    // on success

                )
                .catch(
                    (error) => {
                        $('#create-list').modal('hide');
                        toastr.error('Failed to create list.', 'Error 500', {
                            timeOut: 1000
                        });
                    }
                )
        },
        onListDeleted: function(id) {
            this.$nextTick(function(){
                this.$refs.vpaginator.fetchData(this.resource_url);
            });

            this.$forceUpdate();

//            const position = this.lists.findIndex((element) => {
//                return element.id == id;
//            });
//            this.lists.splice(position, 1);

        },
        updateResource: function(data) {
            this.lists = data;
        },
    }
}
</script>
