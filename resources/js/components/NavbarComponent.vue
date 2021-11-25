<template>
    <div>
        <b-navbar toggleable="lg" type="dark" :style="myStyle">
            <b-container>
                <b-navbar-brand href="/"
                ><img class="brand-logo" height="20" :src="'/img/logo.png'"
                /></b-navbar-brand>
            </b-container>
        </b-navbar>
    </div>
</template>

<script>
export default {
    name: "NavbarComponent.vue",
    data(){
        return{
            myStyle:{
                backgroundColor:"#263338"
            }

        }
    },

}
</script>

<style scoped></style>
