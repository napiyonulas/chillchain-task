<template>
    <div>
        <b-button v-b-modal.modal-1 squared variant="outline-white">New Shipper Company</b-button>

        <b-modal
            id="modal-1"

            size="lg"
            title="New Shipper Company"
            hide-footer
        >
            <div>
                <form @submit.prevent="submit" v-if="show">
                    <b-row>
                        <b-col offset-md="1" md="10">
                            <b-form-group
                                id="input-group-1"
                                label="Company Name:"
                                label-for="input-1"
                            >
                                <b-form-input class="radius-none"
                                    id="input-1"
                                    v-model="form.name"
                                    type="text"
                                    required
                                ></b-form-input>
                                <span class="alert-danger" v-if="errors && errors['name']">{{errors['name'][0]}}</span>

                            </b-form-group>

                        </b-col>
                    </b-row>
                    <h4>Contact Details</h4>
                    <hr>
                    <div v-for="(contact, index) in form.contacts">
                        <b-row>
                            <b-col offset-md="1">
                                <b-form-group
                                    id="input-group-2"
                                    :label="index == '0' ? 'Primary Contact Name:' : 'Contact Name:'"
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
                                    :label="index == '0' ? 'Primary Phone Country:' : 'Phone Country:'"
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
                                    :label="index == '0' ? 'Primary Contact Phone:' : 'Contact Phone:'"
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
                    <h4>Address Details</h4>
                    <hr>
                    <div v-for="(address, index) in form.addresses">
                        <div v-if="index > 0">
                            <hr>
                        </div>
                        <b-row>
                            <b-col offset-md="1"> <b-row>
                                <b-col>
                                    <b-form-group
                                        id="input-group-2"
                                        :label="index == '0' ? 'Primary Address Line 1:' : 'Address Line:'"
                                        label-for="input-2"
                                    >
                                        <b-form-input class="radius-none"
                                            id="input-2"
                                            v-model="address.address_line_1"
                                            name="form.addresses[][address_line_1]"
                                            placeholder="Enter an address"
                                            required
                                        ></b-form-input>
                                        <span class="alert-danger" v-if="errors && errors[`addresses.${index}.address_line_1`]">{{errors[`addresses.${index}.address_line_1`][0]}}</span>

                                    </b-form-group>
                                </b-col>
                                <b-col>
                                    <b-form-group
                                        id="input-group-2"
                                        :label="index == '0' ? 'Primary Address Line 2:' : 'Address Line:'"
                                        label-for="input-2"
                                    >
                                        <b-form-input class="radius-none"
                                            id="input-2"
                                            v-model="address.address_line_2"
                                            name="form.addresses[][address_line_2]"
                                            placeholder="Enter an address"
                                            required
                                        ></b-form-input>
                                        <span class="alert-danger" v-if="errors && errors[`addresses.${index}.address_line_2`]">{{errors[`addresses.${index}.address_line_2`][0]}}</span>

                                    </b-form-group>
                                </b-col>
                            </b-row>
                                <b-row>
                                    <b-col>
                                        <b-form-group
                                            id="input-group-2"
                                            :label="index == '0' ? 'Primary Address City:' : 'Address City:'"
                                            label-for="input-2"
                                        >
                                            <b-form-input class="radius-none"
                                                id="input-2"
                                                v-model="address.city"
                                                name="form.addresses[][city]"
                                                placeholder="Enter an address"
                                                required
                                            ></b-form-input>
                                            <span class="alert-danger" v-if="errors && errors[`addresses.${index}.city`]">{{errors[`addresses.${index}.city`][0]}}</span>

                                        </b-form-group>

                                    </b-col>
                                    <b-col>
                                        <b-form-group
                                            id="input-group-2"
                                            :label="index == '0' ? 'Primary Address Country:' : 'Address Country:'"
                                            label-for="input-2"
                                        >
                                            <b-form-select
                                                v-model="address.country"
                                                name="form.addresses[][country]"
                                                :options="countryOpt"
                                                class="mb-3 radius-none"
                                                value-field="name"
                                                text-field="name"
                                                disabled-field="notEnabled"
                                                required
                                            ></b-form-select>
                                            <span class="alert-danger" v-if="errors && errors[`addresses.${index}.country`]">{{errors[`addresses.${index}.country`][0]}}</span>

                                        </b-form-group>
                                    </b-col>
                                    <b-col>
                                        <b-form-group
                                            id="input-group-2"
                                            label="State/Province/County"
                                            label-for="input-2"
                                        >
                                            <b-form-input class="radius-none"
                                                id="input-2"
                                                v-model="address.state_province_county"
                                                name="form.addresses[][state_province_county]"
                                                placeholder="Enter an address"
                                                required
                                            ></b-form-input>
                                            <span class="alert-danger" v-if="errors && errors[`addresses.${index}.state_province_county`]">{{errors[`addresses.${index}.state_province_county`][0]}}</span>

                                        </b-form-group>

                                    </b-col>
                                    <b-col>
                                        <b-form-group
                                            id="input-group-2"
                                            label="Zip/Post Code"
                                            label-for="input-2"
                                        >
                                            <b-form-input class="radius-none"
                                                id="input-2"
                                                v-model="address.zip_post_code"
                                                name="form.addresses[][zip_post_code]"
                                                placeholder="Enter an address"
                                                required
                                            ></b-form-input>
                                            <span class="alert-danger" v-if="errors && errors[`addresses.${index}.zip_post_code`]">{{errors[`addresses.${index}.zip_post_code`][0]}}</span>

                                        </b-form-group>

                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <b-form-group
                                            id="input-group-2"
                                            label="Other Address Details"
                                            label-for="input-2">

                                            <b-form-textarea
                                                class="radius-none"
                                                id="textarea"
                                                name="form.addresses[][other_address_details]"
                                                v-model="address.other_address_details"
                                                placeholder="Enter something..."
                                                rows="3"
                                                max-rows="6"
                                            ></b-form-textarea>
                                            <span class="alert-danger" v-if="errors && errors[`addresses.${index}.other_address_details`]">{{errors[`addresses.${index}.other_address_details`][0]}}</span>

                                        </b-form-group>
                                    </b-col>
                                </b-row></b-col>
                            <b-col md="1">
                                    <b-button-group class="btn-group-vertical">
                                        <b-button
                                            size="sm"
                                            v-on:click="addAddress"
                                            squared
                                            variant="success"
                                            v-if="index <= 0"
                                        ><i class="fa fa-plus"></i></b-button
                                        >

                                        <b-button squared
                                            size="sm"
                                            v-if="index > 0"
                                            v-on:click="removeAddress(index)"
                                            variant="danger"
                                        ><i class="fa fa-times"></i></b-button
                                        >
                                    </b-button-group>

                            </b-col>
                        </b-row>

                    </div>
                    <div class="modal-footer">
                        <b-button class="radius-none" v-on:click="onReset">Cancel</b-button>
                        <b-button class="radius-none" type="submit" variant="primary">Save</b-button>
                    </div>
                </form>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    beforeMount(){
      this.getCountries();
    },
    mounted() {
        this.form.contacts.push(Vue.util.extend({}, this.primary_contact))
        this.form.addresses.push(Vue.util.extend({}, this.primary_address))
    },
    data() {
        return {
            countryOpt: {},
            errors: {},
            primary_contact: {
                name: '',
                phone: '',
                phone_country: '',
                is_primary: true,
            },
            contact: {
                name: '',
                phone: '',
                phone_country: '',
                is_primary: false,
            },
            primary_address: {
                address_line_1: '',
                address_line_2: '',
                city: '',
                state_province_county: '',
                country: '',
                zip_post_code: '',
                other_address_details: '',
                is_primary: true
            },
            address: {
                address_line_1: '',
                address_line_2: '',
                city: '',
                state_province_county: '',
                country: '',
                zip_post_code: '',
                other_address_details: '',
                is_primary: false
            },
            form: {
                name: '',
                contacts: [],
                addresses: [],

            },
            show: true
        }
    },
    methods: {
        getCountries(){
            axios.get('/api/countries').then(function(response){
                this.countryOpt = response.data;
            }.bind(this));
        },
        NumbersOnly(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        },
        addContact: function() {
            this.form.contacts.push(Vue.util.extend({}, this.contact))
        },
        removeContact: function(index) {
            Vue.delete(this.form.contacts, index);
        },
        addAddress: function() {
            this.form.addresses.push(Vue.util.extend({}, this.address))
        },
        removeAddress: function(index) {
            Vue.delete(this.form.addresses, index);
        },
        submit() {
            this.errors = {};
            axios.post('/api/companies/', this.form).then(response => {
                this.$root.$emit('createdEvent', this.form.name);
                this.onReset();
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });

        },
        onReset(event) {
            this.$bvModal.hide('modal-1')
            this.form = {
                name: '',
                contacts: [{
                    name: '',
                    phone: '',
                    is_primary: true,
                }],
                addresses: [{
                    address_line_1: '',
                    address_line_2: '',
                    city: '',
                    state_province_county: '',
                    country: '',
                    zip_post_code: '',
                    other_address_details: '',
                    is_primary: true
                }],

            }
        }

    },
}
</script>
