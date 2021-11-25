<template>
    <div>
        <b-modal
            @ok="submit"
            @hidden="onReset"
            id="createContactModal"
            size="lg"
            title="New Contact">
            <h4>Contact Details</h4>
            <hr>
            <div v-for="(contact, index) in form.contacts">
                <b-row>
                    <b-col offset-md="1">
                        <b-form-group
                            id="input-group-2"
                            label="Contact Name"
                            label-for="input-2"
                        >
                            <b-form-input class="radius-none"
                                          id="input-2"
                                          v-model="contact.name"
                                          name="form.contacts[][name]"
                                          placeholder="Enter contact name"
                                          required
                            ></b-form-input>
                            <span class="alert-danger" v-if="errors && errors[`contacts.${index}.name`]">{{errors[`contacts.${index}.name`][0]}}</span>

                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            id="input-group-2"
                            label="Contact Country:"
                            label-for="input-2"
                        >
                            <b-form-select
                                v-model="contact.phone_country"
                                name="form.contacts[][phone_country]"
                                :options="countryOpt"
                                class="mb-3 radius-none"
                                value-field="code"
                                text-field="name"
                                disabled-field="notEnabled"
                                required
                            ></b-form-select>
                            <span class="alert-danger" v-if="errors && errors[`contacts.${index}.phone_country`]">{{errors[`contacts.${index}.phone_country`][0]}}</span>

                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            id="input-group-2"
                             label="Contact Phone:"
                            label-for="input-2"
                        >
                            <b-form-input class="radius-none"
                                          id="input-2"
                                          v-model="contact.phone"
                                          name="form.contacts[][phone]"
                                          v-on:keypress="NumbersOnly"
                                          placeholder="Enter name"
                                          required
                            ></b-form-input>
                            <span class="alert-danger" v-if="errors && errors[`contacts.${index}.phone`]">{{errors[`contacts.${index}.phone`][0]}}</span>
                        </b-form-group>
                    </b-col>
                    <b-col cols="2">
                        <b-form-group class=" py-4 my-2">
                            <b-button-group>
                                <b-button size="sm" v-on:click="addContact" variant="success"
                                ><i class="fa fa-plus"></i></b-button
                                >

                                <b-button
                                    size="sm"
                                    v-if="index > 0"
                                    v-on:click="removeContact(index)"
                                    variant="danger"
                                ><i class="fa fa-trash"></i></b-button
                                >
                            </b-button-group>
                        </b-form-group>
                    </b-col>
                </b-row>
            </div>
        </b-modal>
    </div>

</template>

<script>
export default {
    name: "CreateContactComponent",
    mounted() {
        axios.get('/api/countries').then(function(response){
            this.countryOpt = response.data;
        }.bind(this));
        this.$root.$on('createContactEvent', (text) => { // here you need to use the arrow function
            this.$root.$emit('bv::show::modal', 'createContactModal')
            this.form.company_id = text
            if (this.form.contacts.length < 1){
                this.form.contacts.push(Vue.util.extend({}, this.contact))
            }
        })
    },

    data() {
        return {
            errors: {},
            contact: {
                name: '',
                phone: '',
                phone_country: '',
                is_primary: false,
            },
            form:{
                company_id: '',
                contacts:[],
            },

        }
    },
    methods:{
        addContact: function() {
            this.form.contacts.push(Vue.util.extend({},this.contact))
        },
        removeContact: function(index) {
            Vue.delete(this.form.contacts, index);
        },
        submit(){
            this.errors = {};
            axios.post('/api/contacts', this.form).then(response => {
                this.$root.$emit('createdEvent','Contact')
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        },
        NumbersOnly(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        onReset(event) {
            this.$bvModal.hide('createContactModal')
            this.form = {
                company_id: '',
                contacts:[],
            }
        }
    },
}
</script>

<style scoped>

</style>
