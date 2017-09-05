<template>
<div>
    <h2>{{ this.listTitle['title'] }}</h2>
    <!-- Single button -->
    <div class="shoplist-toolbar">
        
        <button type="button" class="btn-no-border btn-norm btn-green pull-right" data-toggle="modal" data-target="#add-product">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add Product
        </button>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id', 'userid'],
    data() {
        return {
            listTitle: ''
        }
    },
    mounted: function() {
        this.getShoplistTitle();
    },
    methods: {
        getShoplistTitle: function() {
            axios.get('/api/v1/shoplist/' + this.id)
                .then(
                    (response) => {
                        this.listTitle = response.data.shoplist;
                    }
                )
                .catch(
                    (error) => console.log(error)
                );
        },
        shareOnFacebook: function() {
                FB.ui({
                    method: 'share',
                    display: 'popup',
                    href: 'https://developers.facebook.com/docs/',
                }, function(response) {});

        }
    }
}
</script>
