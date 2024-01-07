<template>
    <div class="h-fit">
        <div class="flex flex-col px-3" >
            <div  v-if="uploadPage==false" class="w-full md:w-5/8  order-2  md:flex-row py-10  ">
                <div class="container mx-auto rounded relative  shadow-xl">
                    <div class="p-2 flex flex-col md:flex-row md:items-center justify-between">
                        <h1 class="text-2xl font-bold ml-4 mb-2 md:mb-0">YEARBOOK</h1>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search items"
                        class="w-full md:w-1/4 h-10 rounded p-2 text-black focus:outline-none focus:ring focus:ring-blue-200 border-2 border-black"
                    />
                    </div>

                    <div  class="max-h-[300px] overflow-y-auto space-y-2 flex justify-center md:justify-between">
                        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:grid-cols-5">
                            <div v-for="(item, i) in FilterData" :key="i" class="px-4 py-4 w-fit">
                                <div  class="rounded-lg border-2 border-gray-600 shadow-xl px-4 py-4 items-center hover:cursor-pointer ">
                                    <div @click="openYearbook(item)" class="aspect-w-1 aspect-h-1 mb-2" >
                                        <img :src="`${api}:8000/get_cover/${item.SelectedCover}`" alt="yearbook" class="w-40 h-48 object-cover mb-2">
                                    </div>
                                    <div class="flex justify-between">
                                        <h1 class="text-lg font-semibold italic underline tooltip" v-html="truncateText(item.Title, 10)" :title="item.Title"></h1>
                                        <button @click="deleteImage(item)" v-show=" useStore.userData.UserType!='User'" title="Archive">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="mt-1">
                                                <path d="M20 3L22 7V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V7.00353L4 3H20ZM20 9H4V19H20V9ZM13 10V14H16L12 18L8 14H11V10H13ZM18.7639 5H5.23656L4.23744 7H19.7639L18.7639 5Z" fill="rgba(240,64,64,1)" ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="flex justify-end">
                <button @click="AddBook()" title="Create Book" class="bg-gray-800 text-white text-2xl w-fit px-2 -py-2 rounded-md flex  bottom-0 right-0 m-4" v-show=" useStore.userData.UserType!='User'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26" height="26" class="pt-2">
                        <path d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z" fill="rgba(255,255,255,1)"></path>
                    </svg>
                    ADD BOOK
                </button>
            </div>

        </div>
        <div v-if="showAddBook" >
            <create-book @CloseDialog="CloseAddBook" @YearBookDetails="YearBookDetails"/>
        </div>
        <div v-if="uploadPage==true">
            <uploading-page :items="yearBookPage" @CloseUploading="CloseUploading"/>
        </div>
      </div>
    </div>
</template>

<script>
import CreateBook from "./YearBookSub/CreateBook.vue"
import UploadingPage from './YearBookSub/UploadingPage.vue'
import { useUserStore } from '../../Store/mainStore'
import Swal from "sweetalert2";
import { inject } from 'vue';
    export default{
        components: { CreateBook, UploadingPage },
        data() {
            return {
                key: false,
                useStore:useUserStore(),
                search:null,
                filteredItems:[],
                showAddBook:false,
                uploadPage:false,
                yearBookPage:{},
                yearbookArr:[],
                api:inject('apiUrl'),
                noImage:'https://imgv3.fotor.com/images/homepage-feature-card/upload-image_2023-04-11-023334_kxuh.jpg',
            }
        },
        methods: {
            AddBook() {
                this.showAddBook = !this.showAddBook
            },
            YearBookDetails(val){
                this.yearBookPage=val.data
                this.showAddBook =val.dialog
                this.uploadPage=true
            },
            CloseUploading(val){
                this.uploadPage=val
                this.getData();
                // this.CloseUploading=val
            },
            CloseAddBook(val){
                this.showAddBook =val
            },
            getData(){
                axios({
                    method:'get',
                    url:'/getYearbookCover',
                }).then(res=>{
                    console.log(res.data)
                    if(this.useStore.userData.UserType =='Admin'){
                        this.yearbookArr =res.data
                    }else{
                        this.yearbookArr =res.data.filter(x=>{
                            if(x.Batch == this.useStore.userData.Year){
                                return x;
                            }
                        })  
                    }
       
                })
            },
            openYearbook(item){
                this.yearBookPage={}
                axios({
                    method:'post',
                    url:'/specificYearBook',
                    data:item
                }).then(res=>{
                    console.log(res.data,'res.data')
                    this.yearBookPage={
                        title: res.data[0].Title,
                        Batch:res.data[0].Batch,
                        SelectedCover:res.data[0].SelectedCover,
                        SelectedBackground:res.data[0].SelectedBackground,
                        Section:res.data[0].Section,
                        Yearbook_id:res.data[0].Yearbook_id,
                        EXT:res.data[0].EXT,
                        Overide:res.data[0].Overide,
                        NoOfPage:[],
                    }
                    let page = res.data[res.data.length-1]
                    for (let i = 0; i <= page.Page; i++) {
                        this.yearBookPage.NoOfPage.push([])
                        for (let x = 0; x <= page.Gallery; x++) {
                            this.yearBookPage.NoOfPage[i].push([])
                            for (let y = 0; y <= page.pic; y++) {
                                this.yearBookPage.NoOfPage[i][x].push({url:null})
                            }
                        }
                    }
                    res.data.filter(x=>{
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].id=x.id
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Yearbook_id=x.Yearbook_id
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].url= x.FileName ? `${this.api}:8000/get_img/${x.FileName}` : this.noImage
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Page=x.Page
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Name=x.Name
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Gallery=x.Gallery
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].pic=x.pic
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].FileName=x.FileName
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].EXT=x.EXT
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Overide=x.Overide
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Title=x.Title
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Batch=x.Batch
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].SelectedCover=x.SelectedCover
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].SelectedBackground=x.SelectedBackground
                        this.yearBookPage.NoOfPage[x.Page][x.Gallery][x.pic].Section=x.Section

                    })

                    this.uploadPage=true
                })
            },
            deleteImage(item){

                Swal.fire({
                text: "Archive this YearBook ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios({
                            method:'post',
                            url:'/deleteYearbook',
                            data:item
                        }).then(()=>{
                            Swal.fire({
                            title: "Archive Succesful!",
                            icon: "success"
                            });
                            let obj={
                                FirstName:this.useStore.userData.FirstName,
                                SurName:this.useStore.userData.SurName,
                                LRN_No:this.useStore.userData.LRN_No,
                                Details:'Archived YearBook Success'
                            }
                            axios({
                                method:'post',
                                url:'/ArchiveLogs',
                                data:obj
                            }).then(rex=>{})
                            this.getData();
                        })
                    }
                })
            },
            getArchiveYB(){
                axios({
                    method:'get',
                    url:'/getArchiveYearbook',
                }).then(res=>{
                   console.log(res.data)
                })
            },
            truncateText(text, maxLength) {
                    if (text.length > maxLength) {
                        return text.substring(0, maxLength) + "...";
                    }
                    return text;
            },
        },
        mounted () {
            this.getData();
            this.getArchiveYB()
            console.log(this.useStore.userData)
        },
        computed: {
            FilterData() {
                if (this.search) {
                    const userDataCopy = [...this.yearbookArr];
                    const searchQuery = this.search.toUpperCase();
                    return userDataCopy.filter((data) => {
                        return data.Title.toUpperCase().includes(searchQuery)
                    })


                } else {
                    return this.yearbookArr;
                }
            },
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
