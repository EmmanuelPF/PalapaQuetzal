<template>
    <v-carousel cycle>
        <v-carousel-item
        v-for="(dato, i) in datosCarousel"
        :key="i"
        :src="dato.src">

        <v-sheet
        height="100%"
        color="rgba(0,0,0,.2)">
            <v-row
            class="fill-height"
            align="end"
            justify="center">
            <div class="display-1 pb-5 mb-5 text-center"> {{ dato.descripcion }} </div>
            </v-row>
        </v-sheet>

        </v-carousel-item>
    </v-carousel>
</template>

<script>
export default {
    name:"carousel",
    data() {
        return {
            datosCarousel: [
                { src: "/images/carousel1.jpeg" , descripcion:"Lugar Espacioso" },
                { src: "/images/carousel2.jpeg" , descripcion:"Eventos Personalizados"},
                { src: "/images/carousel3.jpeg" , descripcion:"Mesas de postres"},
                { src: "/images/carousel4.jpeg" , descripcion:"Eventos Noctunos"},
                { src: "/images/carousel5.jpeg" , descripcion:"Decora a tu gusto"}
            ]
        }
    }
}
</script>

<style lang="scss">

</style>
