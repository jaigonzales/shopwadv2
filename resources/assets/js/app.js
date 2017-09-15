
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('profile-badge', require('./components/ShopList/ProfileBadge.vue'));
Vue.component('user-lists', require('./components/ShopList/Lists.vue'));
Vue.component('shopping-bag-title', require('./components/ShopList/SingleListTitle.vue'));
Vue.component('products', require('./components/ShopList/Products/Products.vue'));
Vue.component('approval-buttons', require('./components/Requests/ApproveDenyFriendRequest.vue'));
Vue.component('add-friend-button', require('./components/Requests/AddFriendButton.vue'));
Vue.component('total-friend-requests', require('./components/Requests/TotalFriendRequests.vue'));
Vue.component('settings-comp', require('./components/Settings/Settings.vue'));
Vue.component('friend-settings', require('./components/Friends/FriendSettings.vue'));
Vue.component('unblock', require('./components/Friends/Unblock.vue'));

const app = new Vue({
    el: '#app'
});
