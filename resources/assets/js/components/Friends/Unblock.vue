<template>
    <div>
        <div v-if="isUnblocked">
            <i class="fa fa-check" aria-hidden="true" style="color: #6eb34c"></i> User unblocked
        </div>
        <div v-else>
            <button class="btn btn-danger btn-xs" @click.prevent="unblock">
                {{ isLoading ? "Loading..." : "Unblock" }}
            </button>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default{
        props: ['recipientid'],
        data() {
            return {
                checkBlockStatus: null,
                isUnblocked: false,
                isLoading: false,
            }
        },
        methods: {
            unblock: function() {
                this.isLoading = true;
                axios.get('/api/v1/friendship/unblock/' + this.recipientid )
                    .then(
                        (response) => {
                            this.isLoading = false;
                            this.isUnblocked = true;
                        }
                    )
                    .catch(
                        (error) => {}
                    )
            }
        }
    }
</script>