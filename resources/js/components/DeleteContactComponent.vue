<template>
    <div>
        <b-modal
            :id="this.deleteModal.id"
            title="Confirmation"
            @ok="deleteAddress(deleteModal.contact_id)"
        >
            Are you sure you want to delete this contact?
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "DeleteContactComponent",

    mounted(){
        this.$root.$on('deleteContactEvent',(text) =>{
            this.$root.$emit('bv::show::modal', this.deleteModal.id)
            this.deleteModal.contact_id = text
        })
    },
    data(){
        return {
            errors: {},
            deleteModal: {
                id: 'deleteContactModal',
                contact_id: '',
            },
        }
    },
    methods:{
        deleteAddress(id){
            axios.delete('/api/contacts/'+ id).then(response => {
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

