<template>
    <div>
        <b-modal
            id="createAddressModal"
            size="lg"
            hide-footer
            title="New Address">
            <h4>Address Details</h4>
            <hr>
            <form @submit.prevent="submit">
            <div  v-for="(address, index) in form.addresses">
                <div v-if="index > 0">
                    <hr>
                </div>
                <b-row>
                    <b-col offset-md="1"> <b-row>
                        <b-col>
                            <b-form-group
                                id="input-group-2"
                                label="Address Line 1:"
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
                                label="Address Line 2:"
                                label-for="input-2"
                            >
                                <b-form-input class="radius-none"
                                              id="input-2"
                                              v-model="address.address_line_2"
                                              name="form.addresses[][address_line_2]"
                                              placeholder="Enter an address"
                                ></b-form-input>
                                <span class="alert-danger" v-if="errors && errors[`addresses.${index}.address_line_2`]">{{errors[`addresses.${index}.address_line_2`][0]}}</span>

                            </b-form-group>
                        </b-col>
                    </b-row>
                        <b-row>
                            <b-col>
                                <b-form-group
                                    id="input-group-2"
                                    label="City:"
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
                                    label="Country:"
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
        </b-modal>
    </div>

</template>

<script>
export default {
    name: "CreateAddressComponent",
    mounted() {
            axios.get('/api/countries').then(function(response){
                this.countryOpt = response.data;
            }.bind(this));
                this.$root.$on('createAddressEvent', (text) => { // here you need to use the arrow function
            this.$root.$emit('bv::show::modal', 'createAddressModal')
            this.form.company_id = text
            if (this.form.addresses.length < 1){
                this.form.addresses.push(Vue.util.extend({}, this.address))
            }
        })
    },

    data() {
        return {
            errors: {},

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
            form:{
                company_id: '',
                addresses:[],
            },

        }
    },
    methods:{
        addAddress: function() {
            this.form.addresses.push(Vue.util.extend({},this.address))
        },
        removeAddress: function(index) {
            Vue.delete(this.form.addresses, index);
        },
        submit(){
            this.errors = {};
            axios.post('/api/addresses', this.form).then(response => {
                this.$root.$emit('createdEvent','Address')
                this.onReset();
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        },
        onReset(event) {
            this.$bvModal.hide('createAddressModal')
            this.form = {
                company_id: '',
                addresses:[],
            }
        }
    },
}
</script>

<style scoped>

</style>
