<template>
    <div>
        <b-modal
            :id="this.deleteModal.id"
            title="Confirmation"
            @ok="deleteAddress(deleteModal.address_id)"
        >
            Are you sure you want to delete this address?
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "DeleteAddressComponent",

    mounted(){
        this.$root.$on('deleteAddressEvent',(text) =>{
            this.$root.$emit('bv::show::modal', this.deleteModal.id)
            this.deleteModal.address_id = text
        })
    },
    data(){
        return {
            errors: {},
            deleteModal: {
                id: 'deleteAddressModal',
                address_id: '',
            },
        }
    },
    methods:{
        deleteAddress(id){
            axios.delete('/api/addresses/'+ id)
                .then(response => {
                    this.$root.$emit('deletedEvent')
                }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data
                    this.$root.$emit('errorEvent', this.errors)
                }
            });
        }
    }
}
</script>

