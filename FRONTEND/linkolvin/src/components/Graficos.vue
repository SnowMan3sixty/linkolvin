<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  data: () => ({
    chartdata: {
      labels: ['Asix', 'Daw', 'Dam', 'Smx'],
      datasets: [
        {
          label: 'Data One',
          backgroundColor: '#f87979',
          data: [1, 2, 1, 1]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  }),

  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}
</script>
