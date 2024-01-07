<template>
    <div class="fixed top-0 left-0 h-screen  w-screen flex items-center justify-center bg-gray-900 bg-opacity-40 z-50">
        <div class=" overflaw-y-auto">
            <div class="bg-white ">
                <div v-if="tab == 0" class="p-4 ">
                    <div class="flex justify-end bg-white">
                        <button @click="CloseDialog()" class="text-blue-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                            </svg>
                        </button>
                    </div>
                    <h1 class="font-semibold text-xl mb-3">Book Details</h1>
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                        <div class="flex-grow">
                            <label for="title" class="block text-gray-500">Title:</label>
                            <input type="text" id="title" v-model="newObj.title" class="border-2 border-gray-400 p-2 mb-2 w-full" placeholder="Enter title">
                        </div>
                        <div class="flex-grow">
                            <label for="Batch" class="block text-gray-500">Batch:</label>
                            <select id="year" name="year" v-model="newObj.Batch" class="border-2 border-gray-400 p-2 mb-2 w-full cursor-pointer appearance-none">
                                <option value="" disabled selected>Select Batch</option>
                                <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="flex justify-center">
                        <button @click="tab=1" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block md:w-56">Create Book</button>
                    </div>
                </div>
                <!-- <div v-else-if="tab==1" class="p-4">
                    <div class="flex justify-end  bg-white" >
                        <button @click="CloseDialog()" class="text-blue-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                            </svg>
                        </button>
                    </div>
                    <h1 class="font-semibold text-xl mb-3">Template</h1>
                    <div class="w-full">
                        <label for="Cover" class="block text-gray-500 ">Cover:</label>
                        <select id="Cover" v-model="newObj.SelectedCover" class="border-2  bg-gray-300  p-2  w-full ">
                            <option value="" disabled selected >Select Cover</option>
                            <option :value="item.FileName" v-for="(item,i) in CoverList" :key="i">{{ item.Name }}</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="BackGround" class="block text-gray-500 ">BackGround:</label>
                        <select id="BackGround" v-model="newObj.SelectedBackground" class="border-2  bg-gray-300  p-2  w-full ">
                            <option value="" disabled selected >Select BackGround</option>
                            <option :value="item.FileName" v-for="(item,i) in BackGroundList" :key="i">{{ item.Name }}</option>
                        </select>
                    </div>
                    <h1 class="font-semibold text-xl mb-3">Page Details</h1>
                    <div class="w-full">
                        <label for="Section" class="block text-gray-500 ">Section:</label>
                        <select id="Section" v-model="newObj.Section" class="border-2  bg-gray-300  p-2  w-full ">
                            <option value="" disabled>Select Section</option>
                            <option v-for="sec in sections" :key="sec.SectionName" >{{ sec.SectionName}}</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="NoOfPages"  class="block text-gray-500 ">No Of Pages:</label>
                        <select id="NoOfPages" v-model="noofpage" @change="NoofPage(noofpage)" class="border-2  bg-gray-300 p-2 w-full">
                            <option value="" disabled selected >No of Pages</option>
                            <option v-for="(item,i) in 10" :key="i"  >{{ `${i+1}` }}</option>
                        </select>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button  @click="tab=0" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block w-24 ">Back</button>
                        <button  @click="UploadImage()" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block w-24 ">Next</button>
                    </div>
                </div> -->
                <div v-else-if="tab==1" class="p-4">
                    <div class="flex justify-end bg-white">
                        <button @click="CloseDialog()" class="text-blue-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                            </svg>
                        </button>
                    </div>
                    <h1 class="font-semibold text-xl mb-3">Template</h1>
                    <div class="w-full mb-4">
                        <label for="Cover" class="block text-gray-500">Cover:</label>
                        <select id="Cover" v-model="newObj.SelectedCover" class="border-2 bg-gray-300 p-2 w-full">
                            <option value="" disabled selected >Select Cover</option>
                            <option :value="item.FileName" v-for="(item,i) in CoverList" :key="i">{{ item.Name }}</option>
                        </select>
                    </div>
                    <div class="w-full mb-4">
                        <label for="BackGround" class="block text-gray-500">BackGround:</label>
                        <select id="BackGround" v-model="newObj.SelectedBackground" class="border-2 bg-gray-300 p-2 w-full">
                            <option value="" disabled selected >Select BackGround</option>
                            <option :value="item.FileName" v-for="(item,i) in BackGroundList" :key="i">{{ item.Name }}</option>
                        </select>
                    </div>
                    <h1 class="font-semibold text-xl mb-3">Page Details</h1>
                    <div class="w-full mb-4">
                        <label for="Section" class="block text-gray-500">Section:</label>
                        <select id="Section" v-model="newObj.Section" class="border-2 bg-gray-300 p-2 w-full">
                            <option value="" disabled>Select Section</option>
                            <option v-for="sec in sections" :key="sec.SectionName" >{{ sec.SectionName}}</option>
                        </select>
                    </div>
                    <div class="w-full mb-4">
                        <label for="NoOfPages" class="block text-gray-500">No Of Pages:</label>
                        <select id="NoOfPages" v-model="noofpage" @change="NoofPage(noofpage)" class="border-2 bg-gray-300 p-2 w-full">
                            <option value="" disabled selected >No of Pages</option>
                            <option v-for="(item,i) in 10" :key="i"  >{{ `${i+1}` }}</option>
                        </select>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button @click="tab=0" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block w-full md:w-24 mb-2 md:mb-0">Back</button>
                        <button @click="UploadImage()" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block w-full md:w-24 mb-2 md:mb-0">Next</button>
                    </div>
                </div>
              </div>
        </div>
    </div>
</template>
<script>
import { inject } from 'vue';
    export default {
        data() {
            return {
                tab:0,
                api:inject('apiUrl'),
                newObj:{
                    title: null,
                    Batch:null,
                    SelectedCover:null,
                    SelectedBackground:null,
                    NoOfPage:[ ],
                },
                noofpage:-1,
                placeholderText: 'Select or type a batch',
                BackGroundList:[],
                CoverList:[],
                sections:[],
                years:[],
                noImage:''
            }
        },
        methods: {
            getAllBG(){
                axios({
                    method:'get',
                    url:'/getBackground',
                }).then(res=>{
                    this.BackGroundList = res.data
                })
            },
            getAllCover(){
                    axios({
                        method:'get',
                        url:'/getCoverPage',
                    }).then(res=>{
                        this.CoverList = res.data
                    })
            },
            UploadImage(){
                this.newObj.NoOfPage.unshift(
                    [[]],
                    [[]],
                    [[]],
                    [[]]
                )
                console.log(this.newObj)
                this.$emit('YearBookDetails',{data:this.newObj,dialog:false})
            },
            CloseDialog(){
                this.$emit('CloseDialog',false)
            },
            getAllSection() {
                axios({
                    method:'get',
                    url:'/getAllSection'
                }).then(res=>{
                    this.sections=res.data
                })
            },
            getDateInfo(){
                const currentYear = new Date().getFullYear();
                const startYear = currentYear - 20; // Adjust the range as needed
                for (let year = startYear; year <= currentYear; year++) {
                    this.years.push(year);
                }
            },
            NoofPage(index){
                this.newObj.NoOfPage=[]
                for (let i = 0; i <= index-1; i++) {
                    this.newObj.NoOfPage.push(
                        [
                            [
                                {
                                    url:this.noImage,
                                    FileName:`NoImage.PNG`,
                                    EXT:'PNG',
                                    Overide:null,
                                    Title:this.newObj.title,
                                    Batch:this.newObj.Batch,
                                    Name:null,
                                    SelectedCover:this.newObj.SelectedCover,
                                    SelectedBackground:this.newObj.SelectedBackground,
                                    Section:this.newObj.Section,
                                    Page:i+4,
                                    Gallery:0,
                                    pic:0,
                                    Yearbook_id:null
                                },
                                {
                                    url:this.noImage,
                                    FileName:`NoImage.PNG`,
                                    EXT:'PNG',
                                    Overide:null,
                                    Title:this.newObj.title,
                                    Batch:this.newObj.Batch,
                                    Name:null,
                                    SelectedCover:this.newObj.SelectedCover,
                                    SelectedBackground:this.newObj.SelectedBackground,
                                    Section:this.newObj.Section,
                                    Page:i+4,
                                    Gallery:0,
                                    pic:1,
                                    Yearbook_id:null
                                },
                                {
                                    url:this.noImage,
                                    FileName:`NoImage.PNG`,
                                    EXT:'PNG',
                                    Overide:null,
                                    Title:this.newObj.title,
                                    Batch:this.newObj.Batch,
                                    Name:null,
                                    SelectedCover:this.newObj.SelectedCover,
                                    SelectedBackground:this.newObj.SelectedBackground,
                                    Section:this.newObj.Section,
                                    Page:i+4,
                                    Gallery:0,
                                    pic:2,
                                    Yearbook_id:null
                                },
                                {
                                    url:this.noImage,
                                    FileName:`NoImage.PNG`,
                                    EXT:'PNG',
                                    Overide:null,
                                    Title:this.newObj.title,
                                    Batch:this.newObj.Batch,
                                    Name:null,
                                    SelectedCover:this.newObj.SelectedCover,
                                    SelectedBackground:this.newObj.SelectedBackground,
                                    Section:this.newObj.Section,
                                    Page:i+4,
                                    Gallery:0,
                                    pic:3,
                                    Yearbook_id:null
                                },
                            ],
                        ]
                    )
                }



            }
        },
        mounted () {
            this.getAllBG();
            this.getAllCover();
            this.getAllSection()
            this.getDateInfo()
            this.noImage = `${this.api}:8000/get_img/NoImage.PNG`
            console.log(this.noImage)
        },
    }
</script>

<style >

.page {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  margin: 2rem;
}

</style>
