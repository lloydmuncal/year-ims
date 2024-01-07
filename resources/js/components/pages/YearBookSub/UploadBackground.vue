<template>
    <div  class="h-fit">
        <div>
            <div class="flex flex-col px-3" >
                <div class="w-full md:w-5/8  order-2  md:flex-row py-10  ">
                    <div class="container mx-auto rounded relative  ">
                        <div class="flex justify-between">
                            <div class="flex space-x-4 justify-start">
                                <div
                                    v-for="(tab, index) in tabData"
                                    :key="index"
                                    @click="activeTab = index ; index==0 ? title ='Cover': title ='Background'"
                                    :class="{
                                    ' bg-gray-600 text-white border-4': activeTab === index,
                                    'cursor-pointer': activeTab !== index
                                    }"
                                    class="text-gray-600 text-lg font-bold hover:bg-gray-300   hover:border-4   px-2 "
                                >
                                    {{ tab.label }}
                                </div>
                            </div>
                            <div >
                                <input
                                    v-model="search"
                                    type="text"
                                    :placeholder="` Search ${title}`"
                                    class="w-full h-10 rounded p-2 text-black focus:outline-none focus:ring focus:ring-gray-400 border border-gray-600 "
                                />
                            </div>
                        </div>
                    <div class="border-t-4 border-gray-500"></div>
                        <template v-if="activeTab==0">
                            <div v-if="loading==true" class="flex justify-center items-center py-32 ">
                                <loading />
                            </div>
                            <div v-else class="max-h-[500px] overflow-y-auto space-y-2 flex justify-center md:justify-between">
                                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:grid-cols-5">
                                    <div v-for="(item, i) in FilterData" :key="i" class="px-4 py-4 w-fit">
                                        <div class="rounded-lg border-2 border-gray-600 shadow-xl px-4 py-4 items-center ">
                                            <div class="aspect-w-1 aspect-h-1 mb-2">
                                                <img :src="`${api}:8000/get_cover/${item.FileName}`" alt="yearbook" class="w-40 h-48 object-cover mb-2">
                                            </div>
                                            <div class="flex justify-between">
                                                <h1 class="text-lg font-semibold italic underline tooltip" v-html="truncateText(item.Name, 10)" :title="item.Name"></h1>
                                                <button @click="deleteImage(item)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="mt-1">
                                                        <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM13.4142 13.9997L15.182 15.7675L13.7678 17.1817L12 15.4139L10.2322 17.1817L8.81802 15.7675L10.5858 13.9997L8.81802 12.232L10.2322 10.8178L12 12.5855L13.7678 10.8178L15.182 12.232L13.4142 13.9997ZM9 4V6H15V4H9Z" fill="rgba(240,64,64,1)" ></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-if="activeTab==1">
                            <div v-if="loading==true" class="flex justify-center items-center py-32 ">
                                <loading />
                            </div>
                            <div  v-else class="max-h-[500px] overflow-y-auto space-y-2 flex justify-center md:justify-between">
                                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:grid-cols-5">
                                    <div v-for="(item, i) in FilterData" :key="i" class="px-4 py-4 w-fit">
                                        <div  class="rounded-lg border-2 border-gray-600 shadow-xl px-4 py-4 items-center ">
                                            <div class="aspect-w-1 aspect-h-1 mb-2">
                                                <img :src="`${api}:8000/get_bg/${item.FileName}`" alt="yearbook" class="w-40 h-48 object-cover mb-2">
                                            </div>
                                            <div class="flex justify-between">
                                                <h1 class="text-lg font-semibold italic underline tooltip" v-html="truncateText(item.Name, 10)" :title="item.Name"></h1>
                                                <button @click="deleteImage(item)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="mt-1">
                                                        <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM13.4142 13.9997L15.182 15.7675L13.7678 17.1817L12 15.4139L10.2322 17.1817L8.81802 15.7675L10.5858 13.9997L8.81802 12.232L10.2322 10.8178L12 12.5855L13.7678 10.8178L15.182 12.232L13.4142 13.9997ZM9 4V6H15V4H9Z" fill="rgba(240,64,64,1)" ></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <button @click="UploadIamge()" class=" hover:bg-gray-300   bg-gray-800 text-white font-bold text-xl w-fit px-2 absolute bottom-5  right-5       rounded-md flex justify-between  ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"  class="mt-1">
                                <path d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z" fill="rgba(255,255,255,1)"></path>
                            </svg>
                           <span> Template </span>
                    </button>
                </div>
            </div>
        </div>
        <div v-if="BackgroundDialog ==true">
            <uploade :activeTab="activeTab" :title="title" @CloseDialog="CloseDialog" @handleFileUpload="handleFileUpload"/>
        </div>
    </div>
</template>

<script>
import Uploade from '../../templates/Uploade.vue'
import Swal from 'sweetalert2'
import Loading from '../Loading.vue'
import { inject } from 'vue';
    export default {
    components: { Uploade, Loading },
        data() {
            return {
                activeTab: 0,
                tabData: [
                    { id: "tab1", label: "Cover Page" },
                    { id: "tab2", label: "Background" }
                ],
                BackgroundDialog:false,
                BackGroundList:[],
                CoverList:[],
                title:'Cover',search:null,
                loading:false,
                api:inject('apiUrl')
            }
        },
        methods: {
            truncateText(text, maxLength) {
                    if (text.length > maxLength) {
                        return text.substring(0, maxLength) + "...";
                    }
                    return text;
            },
            UploadIamge() {
                this.title=''
                this.BackgroundDialog =true
                this.title = this.activeTab==0 ? 'Cover' : this.activeTab==1 ? 'Background' :''
            },
            CloseDialog(val){
                this.BackgroundDialog =val

            },
            handleFileUpload(val){
                this.loading=true
                if(this.activeTab==0){
                    axios({
                        method:'POST',
                        url:'/insertCover',
                        data:{data:val}
                    }).then(res=>{
                        alert(res.data)
                        this.getAllCover()
                        this.BackgroundDialog=false
                        this.loading =false
                    })
                }
                else if(this.activeTab==1){
                    axios({
                        method:'POST',
                        url:'/insertBackground',
                        data:{data:val}
                    }).then(res=>{
                        alert(res.data)
                        this.getAllBG()
                        this.BackgroundDialog=false
                        this.loading =false
                    })
                }
            },
            getAllCover(){
                this.loading=true
                setTimeout(() => {
                    axios({
                        method:'get',
                        url:'/getCoverPage',
                    }).then(res=>{
                        console.log(res.data,'background')
                        this.CoverList = res.data
                        this.loading =false
                    })
                }, 1500);
            },
            getAllBG(){
                this.loading=true
                setTimeout(() => {
                    axios({
                        method:'get',
                        url:'/getBackground',
                    }).then(res=>{
                        console.log(res.data,'background')
                        this.BackGroundList = res.data
                        this.loading =false
                    })
                }, 1500);
            },
            deleteImage(item){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios({
                            method:'POST',
                            url:`${ this.activeTab == 1 ? '/deleteBackground' : this.activeTab ==0 ? '/deleteCover' :''}`,
                            data:item
                        }).then(res=>{
                            this.getAllBG()
                            this.getAllCover()
                            this.BackgroundDialog=false
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        })
                    }
                });
            }

        },
        mounted() {
            this.getAllBG()
            this.getAllCover()
            console.log(this.api)
        },
        computed: {
                FilterData() {
                    if (this.search) {

                        // const searchQuery = this.search.toUpperCase();
                        // return userDataCopy.filter((data) => {
                        //     const valuesAsString = Object.values(data).join(" ").toUpperCase();
                        //     const searchData = new RegExp(searchQuery.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), "g");
                        // return searchData.test(valuesAsString);
                        // });
                    const userDataCopy =  this.activeTab == 0 ? [...this.CoverList] : [...this.BackGroundList];
                    const searchQuery = this.search.toUpperCase();
                    return userDataCopy.filter((data) => {
                        return data.Name.toUpperCase().includes(searchQuery)
                    })

                    } else {
                        return this.activeTab == 0 ? this.CoverList : this.BackGroundList;
                    }
            }
        },
    }
</script>

<style >
.tooltip {
  /* Your other styles */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  position: relative;
}

.tooltip:hover::before {
  content: attr(title);
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  white-space: normal;
  background-color: #333;
  color: #fff;
  padding: 0.5rem;
  border-radius: 5px;
  z-index: 1;
}
</style>

