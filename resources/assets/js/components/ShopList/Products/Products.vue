<template>
<div>

        <div v-if="products.length >= 1" class="shopbag-content">
            <div class="create-btn">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-product">Add an item</button>
            </div>
        <ul class="products list-group" >
            <shoplist-product
                v-for="product in products"
                v-bind:key="product"
                :li="product"
                @productDeleted="onProductDeleted($event)"
                :user_id="userid"
                :shoplist_id="id">
            </shoplist-product>
        </ul>

        </div>
        <div v-else class="shopbag-content">
            <table class="empty-list-container">
                <tr>
                    <td class="align-middle">
                        <h3>Shopping bag is empty.</h3>
                        <p>Start adding a product</p>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-product">Add a product.</button>
                    </td>
                </tr>
            </table>
        </div>

        <v-paginator :resource_url="resource_url" ref="vpaginator" @update="updateResource"></v-paginator>
    <!-- add item form  -->
    <div id="add-product" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="onAddProduct" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="prodName" class="control-label">Product name</label>
                            <input id="prodName" name="prodName" type="text" class="form-control" v-model="formFields.prodName"
                                data-vv-as="product name"
                                v-validate="'required'"
                                :class="{'input': true, 'has-error': errors.has('prodName') }"
                                autofocus
                            />
                            <div v-show="errors.has('prodName')" style="color: #f46948">{{ errors.first('prodName') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="prodUrl" class="control-label">Product link(URL)</label>
                            <span class="label label-info" data-toggle="popover" title="Product URL" data-content="The URL link of the product. i.e. http://website.com/product?id=1985">?</span>
                            <textarea id="prodUrl" class="form-control" name="prodUrl" v-model="formFields.prodUrl"
                                data-vv-as="product url"
                                v-validate="'required|url'"
                                :class="{'input': true, 'has-error': errors.has('prodUrl') }"
                            ></textarea>
                            <div v-show="errors.has('prodUrl')" style="color: #f46948">{{ errors.first('prodUrl') }}</div>
                        </div>
                        <div class="form-group form-inline">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="prodSize" class="control-label">Size</label>
                                    <input id="prodSize" type="text" class="form-control" v-model="formFields.prodSize" />
                                </div>
                                <div class="col-md-4">
                                    <label for="prodColor" class="control-label">Color</label>
                                    <input id="prodColor" type="text" class="form-control" v-model="formFields.prodColor" />
                                </div>
                                <div class="col-md-4">
                                    <label for="prodQuantity" class="control-label">Quantity</label>
                                    <input id="prodQuantity" type="number" min="0" class="form-control" v-model="formFields.prodQuantity"
                                        name="quantity"
                                        data-vv-as="quantity"
                                        v-validate="'numeric'"
                                     />
                                     <div v-show="errors.has('quantity')" style="color: #f46948">{{ errors.first('quantity') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scope>
.label-info:hover {
    cursor: pointer;
}
</style>
<script>
import VueResource from 'vue-resource';
import VuePaginator from 'vuejs-paginator';
import Product from './Product.vue';
import axios from 'axios';

export default {
    props: ['userid', 'id'],
    components: {
        'shoplist-product': Product,
        VPaginator: VuePaginator
    },
    data() {
        return {
            products: [],
            resource_url: '/api/v1/' + this.userid + '/shoplist/' + this.id + '/products',
            formFields: {
                prodName: null,
                prodUrl: null,
                prodSize: null,
                prodColor: null,
                prodQuantity: null,
            }
        }
    },
    watch: {

    },
    methods: {

        onAddProduct: function() {

            let vm = this;

            this.$validator.validateAll().then(result => {
                if (result) {

            if ( this.formFields.prodSize == null || this.formFields.prodSize == ""){
                this.formFields.prodSize = "N/A"
            }

            if ( this.formFields.prodColor == null || this.formFields.prodColor == ""){
                this.formFields.prodColor = "N/A"
            }

            if ( this.formFields.prodQuantity == null || this.formFields.prodQuantity == ""){
                this.formFields.prodQuantity = 1
            }


            axios.post('/api/v1/product', {
                    user_id: this.userid,
                    shoplist_id: this.id,
                    product_name: this.formFields.prodName,
                    product_url: this.formFields.prodUrl,
                    size: this.formFields.prodSize,
                    color: this.formFields.prodColor,
                    quantity: this.formFields.prodQuantity
                })
                .then(
                    (response) => {
                        $('#add-product').modal('hide');
                        this.resetForm();
                        this.$validator.clean();
                        toastr.success('Product added!', 'Success', {
                            timeOut: 5000
                        });
                        vm.$refs.vpaginator.fetchData(vm.resource_url);

                    },
                )
                .catch(
                    (error) => {
                        console.log(error);
                        $('#add-product').modal('hide');
                        toastr.error('Failed to add product.', 'Error', {
                            timeOut: 5000
                        });
                    }
                );

            }
            });
        },
        onProductDeleted: function(id) {

            this.$nextTick(function(){
                this.$refs.vpaginator.fetchData(this.resource_url);
            });

            this.$forceUpdate();
        },
        updateResource: function(data) {
            this.products = data;
        },

        resetForm: function(){
                this.formFields.prodName = null;
                this.formFields.prodUrl = null;
                this.formFields.prodSize = null;
                this.formFields.prodColor = null;
                this.formFields.prodQuantity = null;

        },
    }
}

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
</script>
