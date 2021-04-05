<template>
  <div>
    <b-card
      v-if="(moment(moment().format('YYYY/MM/DD')).diff(this.infoOferta.data_publicacio, 'days')) < 15 "
      :title="infoOferta.titol"
      :img-src="`https://source.unsplash.com/featured/?${infoOferta.ubicacio}`"
      img-alt="Image"
      img-top
      img-height="200"
      img-width="200"
      tag="article"
      style="max-width: 20rem; border: 5px solid red;"
      class="mb-2"
      @click="pasarOfertaCompletaSeleccionada"
      v-b-modal.modalOfertaCompleta
    >
      <b-card-text>
        {{ this.infoOferta.descripcio }}
      </b-card-text>
      <small class="text-muted">Publicado hace {{ moment(moment().format('YYYY/MM/DD')).diff(this.infoOferta.data_publicacio, 'days') }} días</small>
    </b-card>
    <b-card
      v-else-if="(moment(moment().format('YYYY/MM/DD')).diff(this.infoOferta.data_publicacio, 'days')) > 90"
      :title="infoOferta.titol"
      :img-src="`https://source.unsplash.com/featured/?${infoOferta.ubicacio}`"
      img-alt="Image"
      img-top
      img-height="200"
      img-width="200"
      tag="article"
      style="display: none;"
      class="mb-2"
      @click="pasarOfertaCompletaSeleccionada"
      v-b-modal.modalOfertaCompleta
    >
      <b-card-text>
        {{ this.infoOferta.descripcio }}
      </b-card-text>
      <small class="text-muted">Publicado hace {{ moment(moment().format('YYYY/MM/DD')).diff(this.infoOferta.data_publicacio, 'days') }} días</small>
    </b-card>
    <b-card
      v-else
      :title="infoOferta.titol"
      :img-src="`https://source.unsplash.com/featured/?${infoOferta.ubicacio}`"
      img-alt="Image"
      img-top
      img-height="200"
      img-width="200"
      tag="article"
      style="max-width: 20rem"
      class="mb-2"
      @click="pasarOfertaCompletaSeleccionada"
      v-b-modal.modalOfertaCompleta
    >
      <b-card-text>
        {{ this.infoOferta.descripcio }}
      </b-card-text>
      <small class="text-muted">Publicado hace {{ moment(moment().format('YYYY/MM/DD')).diff(this.infoOferta.data_publicacio, 'days') }} días</small>
    </b-card>
  </div>
</template>
<script>
import moment from 'moment';

export default {
  name: "FichaOferta",
  props: {
    infoOferta: {},
  },
  data() {
    return {
      idCandidato_candidat: "",
      idCandidato_real_oferta_candidat: ""
    };
  },
  methods: {
    pasarOfertaCompletaSeleccionada: function () {
      //console.log(this.infoOferta.id);
      this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?join=empresa&join=categoria&filter=id,eq," +
            this.infoOferta.id
        )
        .then((response) => {
          //console.log(response.data.records[0]);
          this.$parent.modal = response.data.records[0];
        });
    },
    moment: function () {
      return moment();
    }
  },
  mounted() {
    this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/candidat?filter=usuari_id,eq," +this.$cookies.get("user")).then((response) => {
      //console.log(response.data.records[0]);
      this.idCandidato_candidat = response.data.records[0];
      console.log("El id del candidato es: "+this.idCandidato_candidat.id);
      this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/real_oferta_candidat?filter=candidat_id,eq," +this.idCandidato_candidat.id).then((response) => {
        //console.log(response.data.records[0]);
        this.idCandidato_real_oferta_candidat = response.data.records[0];
        console.log("El id del candidato de la tabla nueva es: "+this.idCandidato_real_oferta_candidat.candidat_id);
      });
    })
  }
};
</script>

<style>
</style>
