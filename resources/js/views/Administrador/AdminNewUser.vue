<template>
  <div>
    <div v-if="$data['isMounted'] && hasData">
      <v-sheet class="pa-3 m-auto" color="grey lighten-3" elevation="12">
        <v-img
          src="/images/logo-pq.jpeg"
          aspect-ratio="1"
          class="grey lighten-2 m-auto"
          max-width="300"
          max-height="300"
        ></v-img>
        <div class="p-5">
          <v-row>
            <v-col>
              <v-text-field
                label="Nombre"
                class="p-3"
                id="nombre"
                v-model="Nombre"
              ></v-text-field>
              <v-text-field
                label="Email"
                class="p-3"
                id="email"
                v-model="Email"
              ></v-text-field>
              <v-text-field
                label="Contraseña"
                class="p-3"
                id="contraseña"
                type="password"
                v-model="Contraseña"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-btn color="success" class="mr-4" block @click="createUser"
            >registrar</v-btn
          >
        </div>
      </v-sheet>
      <v-alert class="my-5 text-center display-1" type="info">
        Usuarios existentes en la aplicacion
      </v-alert>
      <v-sheet class="pa-3 m-auto mt-5" color="grey lighten-3" elevation="12">
        <v-list>
          <v-list-item-group>
            <v-list-item v-for="(usuario, i) in Usuarios" :key="i">
              <v-list-item-content>
                <v-list-item-title class="title">Usuario</v-list-item-title>
                <v-list-item-subtitle>{{ usuario.name }}</v-list-item-subtitle>
                <v-divider dark inset light></v-divider>
                <v-divider dark inset light></v-divider>
                <v-list-item-title class="title">Correo</v-list-item-title>
                <v-list-item-subtitle>{{ usuario.email }}</v-list-item-subtitle>
                <v-divider dark inset light></v-divider>
                <v-divider dark inset light></v-divider>
                <v-list-item-title
                  class="title"
                  v-if="usuario.id == 1 || usuario.id == 2"
                >
                  Obligatorio
                </v-list-item-title>
              </v-list-item-content>
              <div class="d-flex">
                <v-tooltip v-if="usuario.id !== 1 && usuario.id !== 2" bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn icon class="update mr-3" v-on="on" @click="() => newUser(usuario)">
                      <v-icon size="40px" color="indigo darken-1"
                        >mdi-autorenew</v-icon
                      >
                    </v-btn>
                  </template>
                  <span>Actualizar</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn
                      icon
                      @click="dialog = true"
                      class="update"
                      v-on="on"
                      v-if="$auth.user().data.name == usuario.name"
                    >
                      <v-icon size="40px" color="indigo darken-1"
                        >mdi-autorenew</v-icon
                      >
                    </v-btn>
                  </template>
                  <span>Cambiar contraseña</span>
                </v-tooltip>
                <v-btn icon class="delete" @click="deleteUser(usuario.id)">
                  <v-icon size="40px" color="red lighten-1"
                    >mdi-alpha-x-circle</v-icon
                  >
                </v-btn>
              </div>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-sheet>
      <ActualizarContraseña
        :dialog="dialog"
        @CloseDialog="dialog = false"
      ></ActualizarContraseña>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import ActualizarContraseña from "./ActualizarContraseña.vue";

export default {
  data() {
    return {
      Nombre: "",
      Email: "",
      Contraseña: "",
      Usuarios: null,
      dialog: false,
      hasData: false,
      isMounted: false,
    };
  },
  async beforeMount() {
    await this.getUsers();
  },
  mounted() {
    // isMounted = true
    this.$data["isMounted"] = true;
  },
  components: {
    ActualizarContraseña,
  },
  methods: {
    newUser(usuario) {
      this.$router.push({
        name: 'changeUserCredencials',
        params: usuario
      });
    },
    async createUser() {
      try {
        let userData = new FormData();
        userData.append("name", this.Nombre);
        userData.append("email", this.Email);
        userData.append("password", this.Contraseña);

        const { data } = await axios.post("/api/v1/auth/register", userData);
        this.Usuarios.push(data);
        // this.$router.push({ name: "adminPanel" });
      } catch (error) {
        console.error(error);
        this.$toasted.error("A ocurrido un problema al registrar un usuario", {
          type: "error",
          theme: "outline",
          position: "top-right",
          duration: 5000,
        });
      }
    },
    async getUsers() {
      try {
        let { data } = await axios.post("/api/usuarios");
        this.Usuarios = data;
        console.log(data);
        this.hasData = true;
      } catch (error) {
        console.error(error);
        this.$toasted.error(
          "A ocurrido un problema al obtener a los usuarios",
          {
            type: "error",
            theme: "outline",
            position: "top-right",
            duration: 5000,
          }
        );
      }
    },
    async deleteUser(id) {
      try {
        let userData = new FormData();
        userData.append("id", id);
        await axios.post("/api/usuarios/Eliminar", userData);
        this.$toasted.success("Usuario eliminado", {
          type: "success",
          theme: "outline",
          position: "top-right",
          duration: 5000,
        });
        const index = this.Usuarios.findIndex((usuario) => usuario.id === id);
        this.Usuarios.splice(index, 1);
      } catch (error) {
        console.error(error);
        this.$toasted.error("Error al intentar eliminar un usuario", {
          type: "error",
          theme: "outline",
          position: "top-right",
          duration: 5000,
        });
      }
    },
  },
};
</script>
