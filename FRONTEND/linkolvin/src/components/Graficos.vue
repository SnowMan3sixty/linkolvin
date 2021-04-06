<script>
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
  data: () => ({
    chartdata: null,
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
    loaded: false,
  }),
  methods: {
    asix: function () {
      var asix = 0;
      this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,2&filter2=estat,eq,1&order=data_publicacio,desc"
        )
        .then((response) => {
          console.log("asix", response.data.length);
          asix = response.data.records.length;
          return asix;
          // this.$parent.modal = response.data.records[0];
        });
    },
    daw: function () {
      var daw = 0;
      this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,3&filter2=estat,eq,1&order=data_publicacio,desc"
        )
        .then((response) => {
          console.log("daw", response.data.length);
          daw = response.data.records.length;
          return daw;
        });
    },
    dam: function () {
      var dam = 0;
      this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,4&filter2=estat,eq,1&order=data_publicacio,desc"
        )
        .then((response) => {
          console.log("dam", response.data.length);
          this.$dam = response.data.records.length;
          return dam;
        });
    },
    smx: function () {
      var smx = 0;
      this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,5&filter2=estat,eq,1&order=data_publicacio,desc"
        )
        .then((response) => {
          console.log("smx", response.data.length);
          smx = response.data.records.length;
          return smx;
        });
    },
  },
  async mounted() {
    this.loaded = true;
    this.chartdata = {
      labels: ["Asix", "Daw", "Dam", "Smx"],
      datasets: [
        {
          label: "Numero de ofertes",
          backgroundColor: "#f87979",
          data: [this.asix(), this.dam(), this.daw(), this.smx()],
          // data: [2, 2, 0, 0],
        },
      ],
    };
    this.renderChart(this.chartdata, this.options);
  },
};
</script>
