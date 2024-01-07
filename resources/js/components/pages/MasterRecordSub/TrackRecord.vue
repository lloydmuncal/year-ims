<template>
    <div class="container mx-auto p-4">
      <div class="flex flex-col md:flex-row justify-between ">
            <div class="mb-4 flex ">
                <input placeholder="Input Track" v-model="newTrack.TrackName" type="text" id="newTrack" class="p-2 border border-gray-300 rounded-md" />
                <button @click="insertTrack()" class="ml-2 p-2 bg-green-500 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7 19V13H17V19H19V7.82843L16.1716 5H5V19H7ZM4 3H17L21 7V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM9 15V19H15V15H9Z" fill="rgba(255,255,255,1)"></path></svg>
                </button>
            </div>
            <div class="mb-4 flex ">
                <input
                v-model="search"
                type="text"
                placeholder="Search Track"
                class="p-2 border border-gray-300 rounded-md "
                />
                <button @click="resetSearch" class="ml-2 p-2 bg-red-500 rounded-md" title="Clear Search">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z" fill="rgba(255,255,255,1)"></path></svg>
                </button>
            </div>
        </div>
      <div v-if="loading==false" class="max-h-64 overflow-y-auto border-4">
        <table class="w-full  border-collapse shadow-xl" >
            <thead class="bg-gray-100">
            <tr >
                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Track ID</th>
                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Track Name</th>
                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody >
            <tr v-for="track in filteredTracks" :key="track.id" class="text-center ">
                <td class="border border-gray-300 px-4 py-2">{{ track.Track_id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ track.TrackName }}</td>
                <td class="border border-gray-300 px-4 py-2">
                <button @click="editTrack(track)" title="Edit Track" class="mr-2 p-1 bg-green-500 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path d="M6.41421 15.89L16.5563 5.74786L15.1421 4.33365L5 14.4758V15.89H6.41421ZM7.24264 17.89H3V13.6474L14.435 2.21233C14.8256 1.8218 15.4587 1.8218 15.8492 2.21233L18.6777 5.04075C19.0682 5.43128 19.0682 6.06444 18.6777 6.45497L7.24264 17.89ZM3 19.89H21V21.89H3V19.89Z" fill="rgba(255,255,255,1)"></path></svg>
                </button>
                <button @click="deleteTrack(track)" title="Delete Track" class="p-1 bg-red-500 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 4V6H15V4H9Z" fill="rgba(255,255,255,1)"></path></svg>
                </button>
                </td>
            </tr>
            </tbody>
        </table>
      </div>
    <div v-else class="flex justify-center mt-10">
        <loading/>
    </div>
    </div>
  </template>

  <script>
import Loading from '../Loading.vue';
import Swal from 'sweetalert2';
  export default {
  components: { Loading },
    data() {
      return {
        loading:false,
        tracks: [],
              // Your track data array
        search: '',   // Search term for filtering tracks
        newTrack: {
            TrackName:null
        },     // New track name for insertion
      };
    },
    computed: {
      filteredTracks() {
        if (this.search) {
            const userDataCopy = [...this.tracks];
            const searchQuery = this.search.toUpperCase();
            return userDataCopy.filter((data) => {
                return data.TrackName.toUpperCase().includes(searchQuery) || data.Track_id.toUpperCase().includes(searchQuery)
            })
        } else {
            return this.tracks;
        }

      },
    },
    methods: {
      resetSearch() {
        this.search = '';
      },
      insertTrack() {
        if (!this.newTrack.TrackName) {
            return false
        }
        axios({
            method:'post',
            url:'/insertTrack',
            data:this.newTrack
        }).then((res)=>{
            this.loadTrack()
            this.newTrack={}
        })
      },
      editTrack(track) {
        this.newTrack={...track}
      },
      deleteTrack(trackId) {
        Swal.fire({
            title: "Delete this Track?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                axios({
                    method:'post',
                    url:'/deleteTrack',
                    data:trackId
                }).then(()=>{
                    Swal.fire({
                    title: "Deleted!",
                    text: "Track has been deleted.",
                    icon: "success"
                });
                    this.loadTrack()
                    this.newTrack= { }
                })
            }
        })
      },
      loadTrack(){
        this.tracks=[];
        this.loading=true
        setTimeout(() => {
            axios({
                method:'get',
                url:'/getAllTrack'
            }).then(res=>{
                this.tracks=res.data
                this.loading=false
            })
        }, 1500);
      }
    },
    mounted () {
        this.loadTrack()
    },
  };
  </script>

  <style scoped>
  /* Add any additional styles or Tailwind CSS classes as needed */
  </style>
