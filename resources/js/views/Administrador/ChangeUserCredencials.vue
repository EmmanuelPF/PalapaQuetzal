<template>
  <div>
    <div class="p-5">
      <v-row>
        <v-col>
          <v-text-field
            label="Nombre"
            class="p-3"
            id="nombre"
            v-model="usuario.name"
          ></v-text-field>
          <v-text-field
            label="Email"
            class="p-3"
            id="email"
            v-model="usuario.email"
          ></v-text-field>
          <v-text-field
            label="Nueva contraseña"
            class="p-3"
            id="contraseña"
            type="password"
            v-model="usuario.contraseña"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-btn color="success" class="mr-4" block @click="actualizar">
        Actualizar
      </v-btn>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import axios from 'axios'
import jsonToFormData from '@ajoelp/json-to-formdata';

export default Vue.extend({
  data() {
    return {
      usuario: {},
    };
  },
  beforeMount() {
    this.usuario = this.$route.params;
    this.usuario.password = ""
  },
  methods: {
    async actualizar() {
      console.log('Aqui')
      const formData = jsonToFormData(this.usuario)
      await axios.post('/api/usuarios/actualizarUsuario', formData)
      this.$router.push({ name:'adminNewUser' })
    }
  }
});
</script>