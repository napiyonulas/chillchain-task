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
                        <b-form-group
                            id="input-group-2"
                            label="Contact Name"
                            label-for="input-2"
                        >
                            <b-form-input class="radius-none"
                                          id="input-2"
                                          v-model="form[0].name"
                                          name="form.[name]"
                                          required
                            ></b-form-input>
                            <span class="alert-danger" v-if="errors && errors[`name`]">{{errors[`name`][0]}}</span>
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
    name: "EditCompanyComponent",

    mounted() {
        this.$root.$on('editCompanyEvent', (text)=>{
            this.$root.$emit('bv::show::modal', this.editModal.id)
            this.company.name = text.name
            this.company.id = text.id
            this.form.push(Vue.util.extend({}, this.company))
        })
    },
    data(){
        return {
            errors: {},
            editModal:{
                id: 'edit-company-modal',
                title: 'Edit Company'
            },
            countryOpt: [],
            company: {},
            form:[],
        }
    },
    methods: {
        onReset(event) {
            this.$bvModal.hide(this.editModal.id)
            this.form = []
        },
        submit() {
            this.errors = {};
            axios.put('/api/companies/'+ this.form[0].id, this.form[0]).then(response => {
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


