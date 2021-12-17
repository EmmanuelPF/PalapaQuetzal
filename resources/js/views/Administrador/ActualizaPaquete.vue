<template>
  <div>
    <v-form>
      <v-container>
        <v-row>
          <v-col>
            <v-alert type="info" class="display-2 text-center" text>
              Modificar paquete un nuevo paquete!
            </v-alert>

            <v-text-field
              name="NombrePaquete"
              id="NombrePaquete"
              label="Nombre del paquete"
              v-model="paquete.NombrePaquete"
            ></v-text-field>

            <v-text-field
              name="Precio"
              id="Precio"
              label="Precio del paquete"
              v-model="paquete.Precio"
              type="number"
            ></v-text-field>

            <v-alert type="info" text> Color de fondo del paquete </v-alert>
                <v-color-picker v-model="paquete.Color" mode="hexa" class="mx-auto" hide-mode-switch>
            </v-color-picker>

            <v-alert type="info" text> Imagen de fondo </v-alert>
            <v-file-input
              accept="image/png, image/jpeg, image/bmp"
              placeholder="Escoge una imgen de fondo para el paquete"
              prepend-icon="mdi-camera"
              label="Imagen de fondo"
              v-model="paquete.URLImagen"
            ></v-file-input>

            <v-text-field
              name="Mesas"
              id="Mesas"
              label="Mesas disponibles"
              type="number"
              v-model="paquete.caracteristicas_paquete.Mesas"
            ></v-text-field>

            <v-text-field
              name="Mesas_Adicionales"
              id="Mesas_Adicionales"
              label="Mesas adicionales"
              type="number"
              v-model="paquete.caracteristicas_paquete.Mesas_Adicionales"
            ></v-text-field>

            <v-text-field
              name="Juegos_De_Feria"
              id="Juegos_De_Feria"
              label="Juegos de feria disponibles"
              type="number"
              v-model="paquete.caracteristicas_paquete.Juegos_De_Feria"
            ></v-text-field>

            <v-alert type="info" text>
              Duracion maxima del evento (Definido en horas)
            </v-alert>
            <div
              class="mx.auto d-flex scroll-info"
              style="min-width: 500px; overflow: auto"
            >
              <v-time-picker
                v-model="paquete.caracteristicas_paquete.Duracion_Del_Evento"
                color="green lighten-1"
                header-color="primary"
                format="24hr"
                class="mx-auto"
                landscape
                scrollable
              >
              </v-time-picker>
            </div>

            <v-alert type="info" text>
              Tiempo previo para organizar el evento (Definido en horas)
            </v-alert>
            <div
              class="mx.auto d-flex scroll-info"
              style="min-width: 500px; overflow: auto"
            >
              <v-time-picker
                v-model="paquete.caracteristicas_paquete.Organizacion_Evento"
                color="green lighten-1"
                header-color="primary"
                format="24hr"
                class="mx-auto"
                landscape
                scrollable
              >
              </v-time-picker>
            </div>

            <v-row>
              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Evento_Nocturno">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Evento_Nocturno">
                        Evento Nocturno : Activado
                      </div>
                      <div v-else>Evento Nocturno : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Manteleria">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Manteleria">
                        Manteleria : Activado
                      </div>
                      <div v-else>Manteleria : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Bocinas_Bluetooth">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Bocinas_Bluetooth">
                        Bocinas Bluetooth : Activado
                      </div>
                      <div v-else>Bocinas Bluetooth : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Camara_De_Luces">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Camara_De_Luces">
                        Camara De Luces : Activado
                      </div>
                      <div v-else>Camara De Luces : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Ayudante">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Ayudante">
                        Ayudante : Activado
                      </div>
                      <div v-else>Ayudante : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Inflable">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Inflable">
                        Inflable : Activado
                      </div>
                      <div v-else>Inflable : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Piñata">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Piñata">
                        Piñata : Activado
                      </div>
                      <div v-else>Piñata : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>

              <v-col cols="12" sm="12" lg="6">
                <v-switch v-model="paquete.caracteristicas_paquete.Pastel_Oblea">
                  <template v-slot:label>
                    <slot name="label">
                      <div v-if="paquete.caracteristicas_paquete.Pastel_Oblea">
                        Pastel Oblea : Activado
                      </div>
                      <div v-else>Pastel Oblea : Desactivado</div>
                    </slot>
                  </template>
                </v-switch>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
      <v-btn color="success" block @click="sendDataForm">Actualizar paquete</v-btn>
    </v-form>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
import assingDataIfExist from '../../mixins/assingDataIfExist'
import jsonToFormData from '@ajoelp/json-to-formdata';

export default Vue.extend({
  mixins: [
    assingDataIfExist({ 
      property: 'paquete',
      exclude: ['URLImagen']
     }, function (vue, paquete) {
       vue.paquete.caracteristicas_paquete.Ayudante = JSON.parse(paquete.caracteristicas_paquete.Ayudante)
       vue.paquete.caracteristicas_paquete.Bocinas_Bluetooth = JSON.parse(paquete.caracteristicas_paquete.Bocinas_Bluetooth)
       vue.paquete.caracteristicas_paquete.Camara_De_Luces = JSON.parse(paquete.caracteristicas_paquete.Camara_De_Luces)
       vue.paquete.caracteristicas_paquete.Evento_Nocturno = JSON.parse(paquete.caracteristicas_paquete.Evento_Nocturno)
       vue.paquete.caracteristicas_paquete.Inflable = JSON.parse(paquete.caracteristicas_paquete.Inflable)
       vue.paquete.caracteristicas_paquete.Manteleria = JSON.parse(paquete.caracteristicas_paquete.Manteleria)
       vue.paquete.caracteristicas_paquete.Pastel_Oblea = JSON.parse(paquete.caracteristicas_paquete.Pastel_Oblea)
       vue.paquete.caracteristicas_paquete.Piñata = JSON.parse(paquete.caracteristicas_paquete.Piñata)
     })
  ],
  data() {
    return {
      paquete: {
        id: 0,
        NombrePaquete: "",
        Precio: 0,
        URLImagen: null,
        Color: "",
        caracteristicas_paquete: {
          Mesas: 0,
          Mesas_Adicionales: 0,
          Juegos_De_Feria: 0,
          Duracion_Del_Evento: "07:00",
          Organizacion_Evento: "03:00",
          Evento_Nocturno: false,
          Manteleria: false,
          Bocinas_Bluetooth: false,
          Camara_De_Luces: false,
          Ayudante: false,
          Inflable: false,
          Piñata: false,
          Pastel_Oblea: false,
        },
      },
    };
  },
  methods: {
    async sendDataForm() {
      const formData = jsonToFormData(this.paquete)
      // console.log(...data.keys())
      // console.log(...data.values())
      try {
        let { data } = await axios.post(
          "/api/paquetes/actualizar",
          formData
        );
        this.$toasted.success("Paquete creado con exito", {
          type: "success",
          theme: "outline",
          position: "top-right",
          duration: 5000,
        });
        this.$router.push({
          name: "adminPanel",
        });
        console.log(data);
      } catch (error) {
        this.$toasted.success("A ocurrido un error intentelo de nuevo", {
          type: "error",
          theme: "outline",
          position: "top-right",
          duration: 5000,
        });
        console.log(error);
      }
    },

  },
});
</script>