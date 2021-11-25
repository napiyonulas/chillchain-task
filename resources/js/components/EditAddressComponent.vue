<template>
    <div>
        <b-modal
            size="lg"
            :id="this.editModal.id"
            :title="this.editModal.title"
            hide-footer
        >
            <form v-if="form[0]" @submit.prevent="submit">
                <b-row>
                    <b-col offset-md="1" md="10">
                        <b-row>
                        <b-col>
                            <b-form-group
                                id="input-group-2"
                                label="Address Line 1:"
                                label-for="input-2"
                            >
                                <b-form-input class="radius-none"
                                              id="input-2"
                                              v-model="form[0].address_line_1"
                                              name="address_line_1"
                                              placeholder="Enter an address"
                                              required
                                ></b-form-input>
                                <span class="alert-danger" v-if="errors && errors[`address_line_1`]">{{errors[`address_line_1`][0]}}</span>

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
                                              v-model="form[0].address_line_2"
                                              name="address_line_2"
                                              placeholder="Enter an address"
                                              required
                                ></b-form-input>
                                <span class="alert-danger" v-if="errors && errors[`address_line_2`]">{{errors[`address_line_2`][0]}}</span>

                            </b-form-group>
                        </b-col>

                    </b-row>
                        <b-row>
                            <b-col>
                                <b-form-group
                                    id="input-group-2"
                                    label="City"
                                    label-for="input-2"
                                >
                                    <b-form-input class="radius-none"
                                                  id="input-2"
                                                  v-model="form[0].city"
                                                  name="city"
                                                  placeholder="Enter an address"
                                                  required
                                    ></b-form-input>
                                    <span class="alert-danger" v-if="errors && errors[`city`]">{{errors[`city`][0]}}</span>

                                </b-form-group>

                            </b-col>
                            <b-col>
                                <b-form-group
                                    id="input-group-2"
                                    label="Address Country:"
                                    label-for="input-2"
                                >
                                    <b-form-select
                                        v-model="form[0].country"
                                        name="country"
                                        :options="countryOpt"
                                        class="mb-3 radius-none"
                                        value-field="name"
                                        text-field="name"
                                        disabled-field="notEnabled"
                                        required
                                    ></b-form-select>
                                    <span class="alert-danger" v-if="errors && errors[`country`]">{{errors[`country`][0]}}</span>

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
                                                  v-model="form[0].state_province_county"
                                                  name="state_province_county"
                                                  placeholder="Enter an address"
                                                  required
                                    ></b-form-input>
                                    <span class="alert-danger" v-if="errors && errors[`state_province_county`]">{{errors[`state_province_county`][0]}}</span>

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
                                                  v-model="form[0].zip_post_code"
                                                  name="zip_post_code"
                                                  placeholder="Enter an address"
                                                  required
                                    ></b-form-input>
                                    <span class="alert-danger" v-if="errors && errors[`zip_post_code`]">{{errors[`zip_post_code`][0]}}</span>

                                </b-form-group>

                            </b-col>
                        </b-row>
                        <b-row>
                            <b-col v-if="address.is_primary === false" >
                                <b-form-group
                                    label="Is primary?"
                                    label-cols-md="2"
                                    label-for="check">
                                    <b-form-checkbox id="check" v-model="form[0].is_primary" switch >
                                    </b-form-checkbox>
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
                                        name="other_address_details"
                                        v-model="form[0].other_address_details"
                                        placeholder="Enter something..."
                                        rows="3"
                                        max-rows="6"
                                    ></b-form-textarea>
                                    <span class="alert-danger" v-if="errors && errors[`other_address_details`]">{{errors[`other_address_details`][0]}}</span>

                                </b-form-group>
                            </b-col>
                        </b-row></b-col>
                </b-row>
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
    name: "EditAddressComponent",

    mounted() {
        this.getCountries();
        this.$root.$on('editAddressEvent', (text)=>{
            this.$root.$emit('bv::show::modal', this.editModal.id)
            this.address = text
            this.form.push(Vue.util.extend({}, text))
        })
    },
    data(){
        return {
            errors: {},
            editModal:{
                id: 'edit-address-modal',
                title: 'Edit Address'
            },
            countryOpt: [],
            address: {},
            form:[],
        }
    },
    methods: {
        getCountries(){
            axios.get('/api/countries').then(function(response){
                this.countryOpt = response.data;
            }.bind(this));
        },
        onReset(event) {
            this.$bvModal.hide(this.editModal.id)
            this.form = []
        },
        submit() {
            this.errors = {};
            axios.put('/api/addresses/'+ this.form[0].id, this.form[0]).then(response => {
                this.$root.$emit('updatedEvent');
                this.onReset();
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });

        },
    }
}
</script>


