<template>

    <div>
        <b-row>
            <b-col  sm="7" md="5" class="my-2 mx-auto" >
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    class="my-0"
                ></b-pagination>
            </b-col>

            <b-col  sm="7" md="5" class="my-2 mx-auto">
            <b-form-group
                label-for="filter-input"
                label-align-sm="right"
                class="mb-0"
            >
            <b-input-group  size="md">
                    <b-form-input
                        class="radius-none"
                        id="filter-input"
                        v-model="filter"
                        type="search"
                        placeholder="Type to Search"
                    ></b-form-input>

                    <b-input-group-append>
                        <b-button class="radius-none" :disabled="!filter" @click="filter = ''">Clear</b-button>
                    </b-input-group-append>
                </b-input-group>
            </b-form-group>
            </b-col>
        </b-row>

        <b-table
            :filter="filter"
            :filter-included-fields="filterOn"
            @filtered="onFiltered"
            :current-page="currentPage"
            :per-page="perPage"
            id="yay"
            ref="table"
            responsive
            striped
            hover
            :items="items"
            :fields="fields"
            table-variant="dark"
            class="m-0 p-0"
        >

            <template #cell(primary_name)="data">

                <div v-if="data.item.primary_contact.length > 0" >  {{data.item.primary_contact[0]['name'] }}</div>
            </template>
            <template #cell(primary_phone)="data">
                <div v-if="data.item.primary_contact.length > 0" >   {{data.item.primary_contact[0]['phone'] }}</div>


            </template>
            <template #cell(primary_address)="data">
                <div v-if="data.item.primary_address.length > 0" >{{data.item.primary_address[0]['address_line_1']}}</div>

            </template>
            <template #row-details="data">
                <b-card>
                    <b-row>
                        <b-col>
                            <b-card v-if="data.item.addresses">
                                <b-card-header class="text-dark text-center"><h4>Addresses</h4>
                                    <b-button v-on:click="createAddress(data.item.id)" variant="success"><i class="fa fa-plus"></i></b-button>
                                </b-card-header>
                                <b-table
                                    head-variant="dark"
                                    bordered
                                    :tbody-tr-class="rowClass"
                                    name="my-table4"
                                    id="my-table4"
                                    stripped
                                    :items="data.item.addresses"
                                    :fields="addressTableFields"
                                >
                                    <template #cell(action)="data">
                                        <b-button-group>
                                            <b-button v-on:click="editAddress(data.item)" size="sm" squared variant="primary"><i class="fa fa-edit"></i></b-button>
                                            <b-button v-if="!data.item.is_primary" v-on:click="deleteAddress(data.item.id)" size="sm" squared variant="danger"><i class="fa fa-times"></i></b-button>
                                        </b-button-group>
                                    </template>
                                </b-table>
                            </b-card>
                        </b-col>
                        <b-col>
                            <b-card>
                                <b-card-header class="text-dark text-center"><h4>Contact Phones</h4>
                                    <b-button v-on:click="createContact(data.item.id)" variant="success"><i class="fa fa-plus"></i></b-button>
                                </b-card-header>
                                <b-table
                                    head-variant="dark"
                                    bordered
                                    :tbody-tr-class="rowClass"
                                    name="my-table3"
                                    id="my-table3"
                                    stripped
                                    :items="data.item.contacts"
                                    :fields="infoModal.modalfields"
                                >
                                    <template #cell(action)="data">
                                        <b-button-group>

                                            <b-button v-on:click="editContact(data.item)" size="sm" squared variant="primary"><i class="fa fa-edit"></i></b-button>
                                            <b-button v-if="!data.item.is_primary" v-on:click="deleteContact(data.item.id)" size="sm" squared variant="danger"><i class="fa fa-times"></i></b-button>
                                        </b-button-group>
                                    </template>
                                </b-table>
                            </b-card>
                        </b-col>
                    </b-row>
                </b-card>
            </template>
            <template #cell(shipperDetails)="data" >
                <b-form-checkbox class="mx-auto"  v-model="data.detailsShowing" @change="data.toggleDetails" switch >
                </b-form-checkbox> </template>
            <template #cell(actions)="row">
            <div>
                <b-button-group>
                    <b-button
                        squared
                        size="sm"
                        @click="editCompany(row.item)"
                        variant="primary"
                    ><i class="fa fa-edit"></i></b-button
                    ><b-button
                        squared
                        size="sm"
                        @click="del(row.item, row.index, $event.target)"
                        variant="danger"
                    ><i class="fa fa-times"></i></b-button
                    >
                </b-button-group>
            </div>
        </template>
        </b-table>
            <c-address-component></c-address-component>
            <c-contact-component></c-contact-component>
            <d-address-component></d-address-component>
            <d-contact-component></d-contact-component>
            <e-address-component></e-address-component>
            <e-contact-component></e-contact-component>
            <e-company-component></e-company-component>
        <b-modal
            :id="deleteModal.id"
            :title="deleteModal.title"
            @ok="deleteCompany(deleteModal.delid)"
        >
            Are you sure you want to delete {{deleteModal.content}}?
        </b-modal>
    </div>
</template>
<script>




import CreateContactComponent from "./CreateContactComponent";
import DeleteContactComponent from "./DeleteContactComponent";
export default {
    components: {DeleteContactComponent, CreateContactComponent},
    mounted: function () {
        this.$root.$on('refreshTableEvent', () => {
            this.getPosts()
        })
        this.$root.$on('errorEvent',(text) =>{
            this.error(text)
        })
        this.$root.$on('createdEvent', (text) => {
            this.getPosts();
            this.createdAlert(text);

        })
        this.$root.$on('deletedEvent', () => {
            this.getPosts()
            this.deletedAlert()
        })
        this.$root.$on('updatedEvent', () => {
            this.$root.$emit('refreshTableEvent')
            this.updatedAlert()
        })
    },

    data(){
        return {
            filter: null,
            filterOn: [],
            currentPage: 1,
            perPage: 25,
            totalRows: 0,
            addressTableFields: [
                {key:'address_line_1'},
                {key:'address_line_2'},
                {key:'city'},
                {key:'state_province_county'},
                {key:'country'},
                {key:'zip_post_code'},
                {key:'other_address_details'},
                {key:'action'}
            ],
            infoModal: {
                id: 'info-modal',
                title: '',
                content: '',
                modalfields: [{key:'name'},{key:'phone_country'},{key:'phone'},{key:'action'}],
            },
            deleteModal: {
                id: 'delete-modal',
                title: '',
                content: '',
            },
            fields: [
                {
                    key: 'name',
                    sortable: true
                },
                {
                    label: 'Primary Address',
                    key: 'primary_address'
                },{
                    label: 'Primary Contact Name',
                    key: 'primary_name'
                },
                {
                    label: 'Primary Contact Phone',
                    key: 'primary_phone'
                },
                { key: 'shipperDetails', label: 'Shipper Details' },
                {key:'actions'}

            ],
            items: [],

        }
    },
    methods:{
        editCompany(data){
          this.$root.$emit('editCompanyEvent', data);
        },
        editAddress(data){
            this.$root.$emit('editAddressEvent', data);
        },
        editContact(data){
            this.$root.$emit('editContactEvent', data);
        },
        createAddress(data){
            this.$root.$emit('createAddressEvent', data);
        },
        deleteAddress(data){
            this.$root.$emit('deleteAddressEvent',data);
        },
        deleteContact(data){
            this.$root.$emit('deleteContactEvent',data);
        },
        createContact(data){
            this.$root.$emit('createContactEvent', data);
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        error(text){
            // Use sweetalert2
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: 'error',
                title: text ,
            });
        },
        createdAlert(text) {
            // Use sweetalert2
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                icon: 'success',
                title: text + ' created successfully.',
            });
        },
        deletedAlert(text) {
            // Use sweetalert2
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: 'success',
                title: 'Deleted successfully!',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        },
        updatedAlert(text) {
            // Use sweetalert2
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: 'success',
                title: 'Updated successfully!',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        },
        info(item, index, button) {
            this.infoModal.title = `${item.name} Contact List`
            this.infoModal.content = Object.values(item.contacts)
            this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            this.$root.$emit('bv::refresh::table', 'my-table')
        },
        del(item, index, button) {
            this.deleteModal.title = `Confirmation`
            this.deleteModal.delid = `${item.id}`
            this.deleteModal.content = `${item.name}`
            this.$root.$emit('bv::show::modal', this.deleteModal.id, button)
        },
        resetInfoModal() {
            this.infoModal.title = ''
            this.infoModal.content = []
        },
        getPosts() {
            axios.get('/api/companies').then(function(response){
                this.items = response.data.data;
                this.totalRows = this.items.length;
            }.bind(this));
        },
        rowClass(item, type) {
            if (!item || type !== 'row') return
            if (item.is_primary === true) return 'table-success text-dark'
        },
        deleteCompany(id) {

            axios.delete('/api/companies/' + id)
                .then(response => {
                    this.deletedAlert()

                    this.getPosts();
                });
        },
    },
    created: function(){
        this.getPosts()
    }
}
</script>
