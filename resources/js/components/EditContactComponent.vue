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
                    <b-col offset-md="1">
                        <b-form-group
                            id="input-group-2"
                            label="Contact Name"
                            label-for="input-2"
                        >
                            <b-form-input class="radius-none"
                                          id="input-2"
                                          v-model="form[0].name"
                                          name="form.contacts[][name]"
                                          placeholder="Enter contact name"
                                          required
                            ></b-form-input>
                            <span class="alert-danger" v-if="errors && errors[`name`]">{{errors[`name`][0]}}</span>

                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            id="input-group-2"
                            label="Contact Country:"
                            label-for="input-2"
                        >
                            <b-form-select
                                v-model="form[0].phone_country"
                                name="form.contacts[][phone_country]"
                                :options="countryOpt"
                                class="mb-3 radius-none"
                                value-field="code"
                                text-field="name"
                                disabled-field="notEnabled"
                                required
                            ></b-form-select>
                            <span class="alert-danger" v-if="errors && errors[`phone_country`]">{{errors[`phone_country`][0]}}</span>

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
                                          v-model="form[0].phone"
                                          name="form.contacts[][phone]"
                                          v-on:keypress="NumbersOnly"
                                          placeholder="Enter name"
                                          required
                            ></b-form-input>
                            <span class="alert-danger" v-if="errors && errors[`phone`]">{{errors[`phone`][0]}}</span>
                        </b-form-group>
                    </b-col>
                    <b-col v-if="contact.is_primary === false" >
                        <b-form-group
                            label="Is primary?"
                            label-for="check">
                            <b-form-checkbox id="check" v-model="form[0].is_primary" switch >
                            </b-form-checkbox>
                        </b-form-group>

                    </b-col>
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
    name: "EditContactComponent",

    mounted() {
        this.getCountries();
        this.$root.$on('editContactEvent', (text)=>{
            this.$root.$emit('bv::show::modal', this.editModal.id)
            this.contact = text
            this.form.push(Vue.util.extend({}, text))
        })
    },
    data(){
        return {
            errors: {},
            editModal:{
                id: 'edit-contact-modal',
                title: 'Edit Contact'
            },
            countryOpt: [],
            contact: {},
            form:[],
        }
    },
    methods: {
        NumbersOnly(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
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
            axios.put('/api/contacts/'+ this.form[0].id, this.form[0]).then(response => {
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


