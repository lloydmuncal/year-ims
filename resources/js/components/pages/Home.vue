<template>
    <div class="h-screen ">
        <div class="flex flex-col sm:flex-col  md:flex-col lg:flex-row
                    space-x-0 lg:space-x-2 xl:space-x-4
                    space-y-0 sm:space-y-2 md:space-y-4
                     items-center  p-4 ">

                <div class=" container border-4 mx-auto rounded-lg mt-4 shadow-2xl p-4 h-40 text-center lg:text-left">
                    <div class="rounded-full w-fit p-2 bg-fuchsia-400 mx-auto lg:mx-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H16C16 18.6863 13.3137 16 10 16C6.68629 16 4 18.6863 4 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM10 11C12.21 11 14 9.21 14 7C14 4.79 12.21 3 10 3C7.79 3 6 4.79 6 7C6 9.21 7.79 11 10 11ZM18.2837 14.7028C21.0644 15.9561 23 18.752 23 22H21C21 19.564 19.5483 17.4671 17.4628 16.5271L18.2837 14.7028ZM17.5962 3.41321C19.5944 4.23703 21 6.20361 21 8.5C21 11.3702 18.8042 13.7252 16 13.9776V11.9646C17.6967 11.7222 19 10.264 19 8.5C19 7.11935 18.2016 5.92603 17.041 5.35635L17.5962 3.41321Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </div>
                    <h1 class="text-lg sm:text-sm md:text-xl lg:text-md xl:text-lg font-bold italic">Graduating Students:</h1>
                    <h1 class="text-lg sm:text-sm md:text-xl lg:text-2xl font-bold">{{ totalRecords }}</h1>
                </div>

                <div class="container border-4 mx-auto rounded-lg  shadow-2xl p-4 h-40 text-center lg:text-left">
                    <div class="rounded-full w-fit p-2 bg-orange-400 mx-auto lg:mx-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM16 13H8V15H16V13ZM16 9H8V11H16V9Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </div>
                    <h1 class="text-lg sm:text-sm md:text-xl lg:text-lg font-bold italic">Sections:</h1>
                    <h1 class="text-lg sm:text-sm md:text-xl lg:text-2xl font-bold ">{{sections}}</h1>
                </div>

                <div class="container border-4 mx-auto rounded-lg shadow-2xl p-4 h-40 text-center lg:text-left">
                    <div class="rounded-full w-fit p-2 bg-blue-400 mx-auto lg:mx-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM16 13H8V15H16V13ZM16 9H8V11H16V9Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </div>
                    <h1 class="text-lg sm:text-sm md:text-xl lg:text-lg font-bold italic">Track:</h1>
                    <div class="overflow-y-auto max-h-[60px] border-2 p-3">
                        <h1 class="text-lg sm:text-sm md:text-md lg:text-md font-bold p-1" v-for="(item, i) in tracks" :key="i">{{ '* '+item }}</h1>
                    </div>
                </div>
        </div>


        <div class="flex justify-center xl:justify-between  " >
            <div class="flex flex-col lg:flex-row justify-between lg:space-y-0 container space-x-2 mx-auto ">
                <div class="w-screen xs:w-full sm:w-full md:w-full lg:w-full xl:w-full md:w-full p-4">
                    <div class="font-bold  p-4">
                        Total No of Graduating Student
                    </div>
                    <div class="max-h-[400px] overflow-y-auto border-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Section
                                    </th>
                                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        No of Male
                                    </th>
                                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        No of Female
                                    </th>
                                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Total
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 border-4 ">
                                <tr v-for="(item, i) in SectionRecord" :key="i">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.Section }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{  item.MALE  }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{  item.FEMALE  }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{  item.Total  }}</td>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-fit xs:w-full sm:w-full md:w-full lg:w-full xl:w-full  mx-auto p-4 ">
                    <graph/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DateCalendar from '../templates/DateCalendar.vue';
import { useUserStore } from '../../Store/mainStore'
import Graph from '../templates/Graph.vue';
export default {
  components: { DateCalendar, Graph },
            data() {
                return {
                useUser:useUserStore(),
                    month: '',
                    year: '',
                    yearbookArr:'',
                    selectedDate: new Date(),
                    tracks:0,
                    sections:0,
                    totalRecords:0,
                    SectionRecord:[],

                }
            },
            methods: {
                getAllTrack() {
                    axios({
                        method:'get',
                        url:'/getAllTrack'
                    }).then(res=>{
                            this.tracks=res.data.map(x=>{
                                return x.TrackName
                            })
                    })
                },
                getAllSection() {
                    axios({
                        method:'get',
                        url:'/getAllSection'
                    }).then(res=>{
                        this.sections=res.data.length
                    })
                },
                getYearbook(){
                    axios({
                        method:'get',
                        url:'/getYearbookCover',
                    }).then(res=>{
                        this.yearbookArr =res.data.length
                    })
                },
                // getRecords(){
                //     axios({
                //         method:'get',
                //         url:'/getPerSectionRecords',
                //     }).then(res=>{
                //       this.SectionRecord = res.data
                //     })
                // },
                getRecords(){
                    axios({
                        method:'get',
                        url:'/getPerSectionRecords',
                    }).then(res=>{
                      this.SectionRecord = res.data
                    })
                    axios({
                        method:'get',
                        url:'/getTotalCount',
                    }).then(res=>{
                      this.totalRecords = res.data
                    })
                },
            },
            mounted() {
                this.getAllTrack()
                this.getAllSection()
                this.getYearbook()
                this.getRecords()

            },
        }
</script>

<style lang="scss" scoped>

</style>
