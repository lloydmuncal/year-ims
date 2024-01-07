<template>
    <div class="h-screen flex items-center justify-center">
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 p-2 z-50">
            <div class="w-screen sm:w-max  md:w-max bg-white ">
            <div class=" ">
                <div class="flex justify-between bg-gray-500 p-3 ">
                    <h1 class="text-xl font-bold italic text-white">{{ `${title} Records`  }}</h1>
                    <button @click="CloseDialog()" class="" title="Close Dialog">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="32" height="32" >
                            <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </button>
                </div>
                <div class="border-t-4 border-gray-500"></div>
                <div class="p-4 h-96   md:h-max  lg:h-max  overflow-y-auto">
                <div >
                    <label for="lrnno"  class="block text-gray-700 text-sm font-bold mb-2">LRN No.:</label>
                    <input  id="lrnno" name="lrnno" v-model="userObj.LRN_No" type="text" class="w-full border border-black" />
                </div>
                <div class="flex  grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                    <div >
                        <label class="block text-gray-700 text-sm font-bold mb-2">First Name:</label>
                        <input v-model="userObj.FirstName" type="text" class="w-full border border-black" />
                    </div>
                    <div >
                        <label class="block text-gray-700 text-sm font-bold mb-2">Surname:</label>
                        <input v-model="userObj.SurName" type="text" class="w-full border border-black" />
                    </div>
                </div>
                <div class="flex grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                    <div class="flex gap-2">
                        <div >
                            <label class="block text-gray-700 text-sm font-bold mb-2">M.I :</label>
                            <input v-model="userObj.Mi" type="text" class="w-24 border border-black" />
                        </div>
                        <div >
                            <label class="block text-gray-700 text-sm font-bold mb-2">Suffix:</label>
                            <input v-model="userObj.Suffix" type="text" class="w-24 border border-black" />
                        </div>
                    </div>
                    <div >
                        <label class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
                        <select v-model="userObj.Gender" class="w-full border border-black">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="">
                    <div >
                        <label class="block text-gray-700 text-sm font-bold mb-2">Adviser:</label>
                        <input v-model="userObj.Adviser" type="text" class=" w-full border border-black" />
                    </div>
                    <div >
                        <label class="block text-gray-700 text-sm font-bold mb-2">Track:</label>
                        <select v-model="userObj.Track" class="w-full border border-black">
                            <option value="" disabled>Select Track</option>
                            <option v-for="track in tracks" :key="track.TrackName" >{{ track.TrackName}}</option>
                        </select>
                    </div>

                </div>
                <div class="flex grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2" >
                    <div >
                        <label class="block text-gray-700 text-sm font-bold mb-2">Section:</label>
                        <select v-model="userObj.Section" class="w-full border border-black">
                            <option value="" disabled>Select Section</option>
                            <option v-for="sec in sections" :key="sec.SectionName" >{{ sec.SectionName}}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Year:</label>
                        <select v-model="userObj.Year" class="w-full border border-black">
                            <option value="" disabled selected>Select Year</option>
                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center" >
                    <button @click="SubmitData()" class="bg-green-500 text-white py-2 px-4 rounded mt-4 flex" title="Save Record">
                        Save
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M7 19V13H17V19H19V7.82843L16.1716 5H5V19H7ZM4 3H17L21 7V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM9 15V19H15V15H9Z" fill="rgba(255,255,255,1)"></path></svg>
                    </button>
                </div>
                </div>

            </div>
            </div>
        </div>
    </div>
  </template>
  <script>
  import Swal from 'sweetalert2';
  export default {
    props:['userObj','title'],
    data() {
      return {
        newObj:{},
        years: [],
        tracks:[],
        sections:[]
      };
    },
    methods: {
    getDateInfo(){
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 20; // Adjust the range as needed
        for (let year = startYear; year <= currentYear; year++) {
            this.years.push(year);
        }
    },
    SubmitData() {
            const userObjCopy = { ...this.userObj };
            if(!this.userObj.LRN_No||!this.userObj.SurName||!this.userObj.FirstName||
            !this.userObj.Gender||!this.userObj.Track||
            !this.userObj.Year||!this.userObj.Section){
                Swal.fire({
                    title: "Warning!",
                    text: `Please Complete All fields!`,
                    icon: "warning"
                });
                return false
            }
            this.$emit('submitData', userObjCopy);
            this.$emit('ClsDialog', false);
      },
      CloseDialog(){
        this.$emit('ClsDialog',false)
      },
      getAllTrack() {
            axios({
                method:'get',
                url:'/getAllTrack'
            }).then(res=>{
                    this.tracks=res.data
            })
        },
        getAllSection() {
            axios({
                method:'get',
                url:'/getAllSection'
            }).then(res=>{
                this.sections=res.data
            })
        },
    },
    watch:{

    },
    mounted(){
        this.getAllTrack()
        this.getAllSection()
        this.getDateInfo()
    }
  };
  </script>

  <style scoped>

  </style>
