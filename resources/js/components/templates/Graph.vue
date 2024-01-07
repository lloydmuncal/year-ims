<template>
    <div class=" px-4 ">
        <div class="font-bold  p-4">
            Total No of Student per Track
        </div>
        <apexchart
            type="bar"
            :options="chartOptions"
            :series="chartSeries"
            class="border-4 "
       />
    </div>
  </template>

  <script>
  import VueApexCharts from "vue3-apexcharts";

  export default {
    components: {
      apexchart: VueApexCharts,
    },
    data() {
      return {
        chartOptions: {
          chart: {
            stacked: false,
          },
          xaxis: {
            categories: []
          },
          yaxis: [
            {
              seriesName: "Track 1",
              axisTicks: {
                show: false,
              },
              axisBorder: {
                show: false,
                color: "#FF1654",
              },
              labels: {
                style: {
                  color: "#FF1654",
                },
              },
              title: {
                style: {
                  color: "#FF1654",
                },
              },
            },
            {
              show:false,
              seriesName: "Track 2",
              opposite: true,
              axisTicks: {
                show: true,
              },
              axisBorder: {
                show: true,
                color: "#247BA0",
              },
              labels: {
                style: {
                  color: "#247BA0",
                },
              },
              title: {
                text: "Secondary Axis",
                style: {
                  color: "#247BA0",
                },
              },
            },
            {
              seriesName: "Track 3",
              opposite: true,
              axisTicks: {
                show: true,
              },
              axisBorder: {
                show: true,
                color: "#70C1B3",
              },
              labels: {
                style: {
                  color: "#70C1B3",
                },
              },
              title: {
                text: "Tertiary Axis",
                style: {
                  color: "#70C1B3",
                },
              },
            },
          ],
        },
        chartSeries: [

        ],

      };
    },
    methods:{
        loadFucntion(){
            this.chartOptions.yaxis=[]
            this.chartOptions.xaxis.categories =[]
            let arr=[]
            let xaxis=[]
            axios({
                method:'get',
                url:'/getPerTrackYearRecords',
            }).then(res=>[
                    xaxis = res.data.reduce((total,item)=>{
                        let index= total.findIndex(x=> x==item.Year)
                                if(index == -1){
                                    total.push(item.Year)
                                }
                            return total
                    },[]).sort((a,b)=>{
                        return a-b;
                    }),

                    xaxis.filter(x=>{
                        this.chartOptions.xaxis.categories.push(x)
                    }),
                    // console.log( this.chartOptions.xaxis.categories),
                    res.data.filter(x=>{
                        this.chartOptions.yaxis.push(
                            {
                            "seriesName": x.Track,
                                "axisTicks": {
                                    "show": false
                                },
                                "axisBorder": {
                                    "show": false,
                                    "color": "#FF1654"
                                },
                                "labels": {
                                    "style": {
                                        "color": "#FF1654"
                                    }
                                },
                                "title": {
                                    "style": {
                                        "color": "#FF1654"
                                    }
                                }
                            }
                        )
                    }),
                    arr = res.data.reduce((total,item)=>{
                        let index = total.findIndex(x=> x.name == item.Track)
                        if(index > -1){
                            let index2 = total[index].data.findIndex(y=> y.year == item.Year)
                            if(index2 > -1){
                                total[index].data[index2].value+=item.Total
                            }else{
                                total[index].data.push({year:item.Year,value:item.Total})
                            }
                            return total
                        }else{
                            total.push({
                                name:item.Track,
                                data:[{year:item.Year,value:item.Total}]
                            })
                            return total
                        }
                    },[]),
                    arr.filter(x=>{
                        this.chartOptions.xaxis.categories.filter(d=>{
                            let index = x.data.findIndex(y=> d == y.year )
                            if(index == -1){
                                x.data.push ({year:d,value:0})
                                x.data.sort((a,b)=>{
                                    return a.year-b.year;
                                })
                            }
                        })
                    }),
                ,
                    arr.filter((x,i)=>{
                        x.data=x.data.map(r=>{
                            return r.value
                        })
                        x.yAxisIndex=i
                    }),
                    this.chartSeries = arr
            ])



        //===========================================================================
        },
        handleResize() {
            const containerHeight = this.$refs.chart.$el.offsetHeight;
            this.chartOptions.chart.height = containerHeight;
            this.$refs.chart.updateOptions(this.chartOptions);
        },
    },
    beforeDestroy() {
        // Clean up the resize event listener
        window.removeEventListener('resize', this.handleResize);
    },
    mounted() {
    window.addEventListener('resize', this.handleResize);
        this.loadFucntion()
    },
  };
  </script>

  <style>

  </style>
