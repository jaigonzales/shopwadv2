<template>
<li class="list-group-item shoplist-item">
    <div class="list">
        <div class="list-content">
            <div class="user-list-title">
                <a :href="shoplistUrl(li.id)">{{ li.title }}</a></div>
            <div class="publish-details">
                {{ this.formatDate(li.created_at) }}{{this._shDateCreated}}
                <span> &#8901; </span>
                <i v-if="li.privacy === 0" class="fa fa-globe" aria-hidden="true"></i>
                <i v-else-if="li.privacy === 1" class="fa fa-users" aria-hidden="true"></i>
                <i v-else class="fa fa-lock" aria-hidden="true"></i>
                <span> &#8901; </span>
                <span>{{ this.count }} items</span>
            </div>
            <div class="user-list-desc" v-if="li.desc">{{ li.desc }}</div>
            <div class="user-list-desc" style="color: #d8d8d8" v-else><em>No description</em></div>
            <div class="btn-group pull-right tiny-opt-link">
                <button type="button" class="btn-no-border btn-norm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="vdots"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Actions</li>
                    <li>
                        <a href="#" @click.prevent="onEdit()" data-toggle="modal" data-target="#edit-list-form">
                            Edit
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="onDelete(li.id)">
                            Delete
                        </a>
                    </li>
                    <li class="dropdown-header">Share it</li>
                    <li>
                        <a href="#" @click.prevent="fbShareFunc"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a>
                    </li>
                    <li>
                        <a :href="shareLink"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="edit-list-form" v-if="this.editing" class="modal fade" role="dialog">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="onUpdate()" class="form-horizontal" role="form">
             <input type="hidden" name="_method" value="PUT">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" @click="onClose()">&times;</button>
                    <h4 class="modal-title">Edit Shoplist</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <div>
                            <input id="title" type="text" v-model="editTitle" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc" class="control-label">Description <em>(optional)</em></label>
                        <div>
                            <textarea id="desc" v-model="editDesc" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="privacy" class="control-label">Privacy</label>
                        <div>
                            <select id="privacy" v-model="editPrivacy" class="form-control">
                                <option v-bind:value="0">Public</option>
                                <option v-bind:value="1">Fellows</option>
                                <option v-bind:value="2">Only Me</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="onClose()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</li>
</template>

<script>
import axios from 'axios';

var protocol = location.protocol;
var slashes = protocol.concat("//");
var host = slashes.concat(window.location.hostname);

export default {


    // Properties
    props: ['li', 'userid'],
    data() {
        return {
            count: 0,
            editing: false,
            editTitle: this.li.title,
            editDesc: this.li.desc,
            editPrivacy: this.li.privacy,
            _shDateCreated: '',
            shareLink: host + '/p_shoplist?pid=' + this.userid + '&swid=' + this.li.id
        }
    },
    mounted: function(){
        this.countProducts();
    },
    methods: {

        onEdit: function() {
            this.editing = true;
        },
        countProducts: function() {
            axios.get('/api/v1/' + this.userid  + '/' + this.li.id + '/products/count' )
                .then(
                    (response) => {
                        this.count = response.data.count;
                    }
                ).catch(
                    (error) => { }
                )
        },
        onUpdate: function() {
            let vm = this;
            axios.put('/api/v1/shoplist/' + this.li.id, {
                    title: this.editTitle,
                    desc: this.editDesc,
                    privacy: this.editPrivacy
                })
                .then(
                    (response) => {
                        this.li.title = this.editTitle;
                        this.li.desc = this.editDesc;
                        this.li.privacy = this.editPrivacy;
                        $('#edit-list-form').modal('toggle');
                        $('#edit-list-form').on('hidden.bs.modal', function (e) {
                            this.editing = false;
                            toastr.success('Shoplist successfully updated!', 'Shoplist Update', {
                                timeOut: 5000
                            });
                        });
                    }

                )
                .catch(
                    (error) => {
                        toastr.error('Unable to update the list', 'Update error', {
                            timeOut: 5000
                        });
                    }
                );
        },

        onClose: function() {
            let root = this;
            $('#edit-list-form').on('hidden.bs.modal', function (e) {
                this.editing = false;
            });
        },

        onDelete: function(id) {

            let vm = this;

            swal({
                title: 'Are you sure?',
                text: "The shoplist will be deleted permanently!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {

                axios.delete('/api/v1/shoplist/' + id)
                    .then(
                        swal(
                            'Deleted!',
                            'Your shoplist has been deleted.',
                            'success'
                        ),
                        vm.$emit('listDeleted', id)
                    )
                    .catch(
                        (error) => {
                            toastr.error('Unable to delete the list', 'Error Deletion', {
                                timeOut: 5000
                            });
                        }
                    );
            }, function(dismiss) {
                if (dismiss === 'cancel') {
                    return null;
                }
            })

        },

        shoplistUrl: function(id) {
            return 'u_shoplist?swid=' + id;
        },

        formatDate: function(_thedate){
            var dateCreated = Date.parse(_thedate);
            var shDateCreated = dateCreated.getMonthName('short') + ' ' + dateCreated.getDate() + ', ' + dateCreated.getFullYear();
            this._shDateCreated = shDateCreated;
        },
        fbShareFunc: function(){
            let url = this.shareLink;
            console.log(url);
            FB.ui({
                method: 'share',
                display: 'popup',
                href: this.shareLink,
            }, function(response){});
        }
    }
}




</script>
