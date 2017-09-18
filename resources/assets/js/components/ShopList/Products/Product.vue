<template>
<li class="product-item list-group-item">
    <div class="row">
        <div class="product-contents col-sm-10">
            <span class="widget-title">Product Name</span>
            <h4 class="product-title"><a v-if="(li.product_url)" :href="li.product_url" target="_blank" rel="nofollow" class="product-title">{{ li.product_name }}</a></h4>
            <ul class="product-details">
                <li class="product-detail prod-size"><div class="cust-label" style="background-color: #fb5a8e">Size</div><div class="detail" style="background-color: #ffc3d6">{{ li.size }}</div></li>
                <li class="product-detail prod-color"><div class="cust-label" style="background-color: #2f96d2">Color</div><div class="detail" style="background-color: #c2e8ff">{{ li.color }}</div></li>
                <li class="product-detail prod-quantity"><div class="cust-label" style="background-color: #00b58b">Quantity</div><div class="detail" style="background-color: #b8fbeb">{{ li.quantity }}</div></li>
            </ul>
        </div>
        <div class="product-opts col-sm-2">
            <!-- Single button -->
            <div class="btn-group pull-right">
                <button type="button" class="btn-no-border btn-norm btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" @click.prevent="onEditProduct()" data-toggle="modal" data-target="#edit-product-form"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></li>
                    <!-- <li><a href="#" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li> -->
                    <li><a href="#" @click.prevent="onDeleteProduct(li.id)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- // edit product form -->
    <div id="edit-product-form" v-if="this.editing" class="modal fade" role="dialog">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="onUpdateProduct()" class="form-horizontal" role="form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" @click.prevent="onCancel()">&times;</button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productTitle" class="form-label">Product Name</label>
                        <input id="productTitle" type="text" class="form-control" v-model="editProdTitle"
                            name="prodName"
                            data-vv-as="product name"
                            v-validate="'required'"
                            :class="{'input': true, 'has-error': errors.has('prodName') }"
                        />
                        <div v-show="errors.has('prodName')" style="color: #f46948">{{ errors.first('prodName') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="productUrl" class="form-label">Product Link(URL)</label>
                        <textarea id="productUrl" class="form-control" v-model="editProdUrl"
                            name="prodUrl"
                            data-vv-as="product url"
                            v-validate="'required|url'"
                            :class="{'input': true, 'has-error': errors.has('prodUrl')}"
                        ></textarea>
                        <div v-show="errors.has('prodUrl')" style="color: #f46948">{{ errors.first('prodUrl') }}</div>
                    </div>
                    <div class="form-group form-inline">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="productSize" class="control-label">Size</label>
                                <input id="productSize" type="text" class="form-control" v-model="editProdSize" />
                            </div>
                            <div class="col-md-4">
                                <label for="productColor" class="control-label">Color</label>
                                <input id="productColor" type="text" class="form-control" v-model="editProdColor" />
                            </div>
                            <div class="col-md-4">
                                <label for="productQuantity" class="control-label">Quantity</label>
                                <input id="productQuantity" type="number" min="0" class="form-control" v-model="editProdQuantity"
                                    name="quantity"
                                    data-vv-as="quantity"
                                    v-validate="'numeric'"
                                 />
                                 <div v-show="errors.has('quantity')" style="color: #f46948">{{ errors.first('quantity') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click.prevent="onCancel()">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div>
        </div>
    </form>
    </div>
</li>
</template>

<script>

import axios from 'axios';
import VeeValidate from 'vee-validate';

export default {
    props: [
        'li',
        'user_id',
        'shoplist_id'
    ],
    data() {
        return {
            editing: false,
            editProdTitle: this.li.product_name,
            editProdUrl: this.li.product_url,
            editProdSize: this.li.size,
            editProdColor: this.li.color,
            editProdQuantity: this.li.quantity
        }
    },
    methods: {
        onEditProduct: function(){
            this.editing = true;
        },
        onUpdateProduct: function(){
            let vm = this;


            this.$validator.validateAll().then(result => {
                if (result) {

            if ( this.editProdSize == null || this.editProdSize == ""){
                this.editProdSize = "N/A"
            }

            if ( this.editProdColor == null || this.editProdColor == ""){
                this.editProdColor = "N/A"
            }

            if ( this.editProdQuantity == null || this.editProdQuantity == ""){
                this.editProdQuantity = 1
            }

            axios.put('/api/v1/product/' + this.li.id, {
                    productName: this.editProdTitle,
                    productUrl: this.editProdUrl,
                    productSize: this.editProdSize,
                    productColor: this.editProdColor,
                    productQuantity: this.editProdQuantity
                })
                .then(
                    (response) => {
                        this.li.product_name = this.editProdTitle;
                        this.li.product_url = this.editProdUrl;
                        this.li.size = this.editProdSize;
                        this.li.color = this.editProdColor;
                        this.li.quantity = this.editProdQuantity;

                        $('#edit-product-form').modal('toggle');
                        $('#edit-product-form').on('hidden.bs.modal', function (e) {
                            vm.editing = false;
                            toastr.success('Product successfully updated!', 'Update successful', {
                                timeOut: 5000
                            });
                        });
                    }

                )
                .catch(
                    (error) => {
                        console.log(error);
                        toastr.error('Unable to update product', 'Update error', {
                            timeOut: 5000
                        });
                    }
                );
            }
        });
        },
        onCancel: function(){
            let root = this;
            $('#edit-product-form').on('hidden.bs.modal', function (e) {
                root.editing = false;
            });
        },
        onDeleteProduct: function(id) {
            let vm = this;
            swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {

                axios.delete('/api/v1/product/' + id)
                    .then(
                        swal(
                            'Deleted!',
                            'Your item has been deleted!',
                            'success'
                        ),
                        vm.$emit('productDeleted', id)
                    ).catch(
                        (error) => {
                            toastr.error('Unable to delete the list', 'Error Deletion', {
                                timeOut: 5000
                            });
                        }
                    );
            }, function(dismiss){
                if (dismiss === 'cancel') {
                    return null;
                }
            });

        },
    }
}
</script>
