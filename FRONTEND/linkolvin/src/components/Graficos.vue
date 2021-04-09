<script>
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
  data: () => ({
    chartdata: null,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
          yAxes: [{     
            ticks:{
            beginAtZero: true, }     
          }]
        }
    },
    loaded: false,
    catSmx: 0,
    catDam: 0,
    catAsix: 0,
    catDaw: 0,
  }),
  methods: {
    // asix: function () {
    //   this.axios
    //     .get(
    //       "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,2&filter2=estat,eq,1&order=data_publicacio,desc"
    //     )
    //     .then((response) => {
    //       console.log("asix", response.data.length);
    //       return response.data.records.length;
    //       // this.$parent.modal = response.data.records[0];
    //     });
    // },
    // daw: function () {
    //   var daw = 0;
    //   this.axios
    //     .get(
    //       "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,3&filter2=estat,eq,1&order=data_publicacio,desc"
    //     )
    //     .then((response) => {
    //        console.log("daw", response.data.length);
    //       daw = response.data.records.length;
    //     });
    // },
    // dam: function () {
    //   var dam = 0;
    //   this.axios
    //     .get(
    //       "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,4&filter2=estat,eq,1&order=data_publicacio,desc"
    //     )
    //     .then((response) => {
    //       console.log("dam", response.data.length);
    //       this.$dam = response.data.records.length;
    //     });
    // },
    // smx: function () {
    //   var smx = 0;
    //   this.axios
    //     .get(
    //       "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,5&filter2=estat,eq,1&order=data_publicacio,desc"
    //     )
    //     .then((response) => {
    //       console.log("smx", response.data.length);
    //       smx = response.data.records.length;
    //     });
    // },
  },
  async mounted() {   
    await this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,3&filter2=estat,eq,1"
        )
        .then((response) => {
           console.log("daw", response.data.records.length);
          this.catDaw = response.data.records.length;
        });

    await this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,5&filter2=estat,eq,1"
        )
        .then((response) => {
          console.log("smix", response.data.records.length);
          this.catSmx = response.data.records.length;
          // this.$parent.modal = response.data.records[0];
        });

    await this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,2&filter2=estat,eq,1"
        )
        .then((response) => {
          console.log("asix", response.data.records.length);
          this.catAsix = response.data.records.length;
          // this.$parent.modal = response.data.records[0];
        });
    
    await this.axios
        .get(
          "http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,4&filter2=estat,eq,1"
        )
        .then((response) => {
          console.log("dam", response.data.records.length);
          this.catDam = response.data.records.length;
        });

    

    this.loaded = true;
    this.chartdata = {
      labels: ["Asix", "Dam", "Daw", "Smx"],
      datasets: [
        {
          label: "Numero de ofertes",
          backgroundColor: "#f87979",
          data: [this.catAsix, this.catDam,this.catDaw ,this.catSmx],
          //data: [2, 2, 0, 0],
        },
      ],
    };
    this.renderChart(this.chartdata, this.options);
  },
};
</script>
