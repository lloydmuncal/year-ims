<template>
    <div class="container mx-auto p-4">
      <div class="flex justify-between">
        <div class="w-full flex ">
            <input
            v-model="search"
            type="text"
            placeholder="Search Section"
            class="p-2 border border-gray-300 rounded-md"
            />
            <button @click="resetSearch" class="ml-2 p-2 bg-red-500 rounded-md" title="clear">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z" fill="rgba(255,255,255,1)"></path></svg>

            </button>
        </div>
        <div class="flex justify-end">
            <button @click="addRecord('ADD')" class="ml-2 p-2 bg-green-300 rounded-md text-white flex" title="Add Student">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z" fill="rgba(255,255,255,1)"></path></svg>
            </button>
        </div>
      </div>

      <div v-if="loading==false" class="max-h-80 overflow-y-auto border-4">
        <table class="w-full  border-collapse shadow-xl" >
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">LRN No.</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">First Name</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Last Name</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Middle Initial</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Gender</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Track</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Section</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Year</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Adviser</th>
                    <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Action</th>
                </tr>
                </thead>
            <tbody >
            <tr v-for="(item,i) in FilterData " :key="i" class="text-center ">
                <td class="border border-gray-300 px-4 py-2">{{ item.LRN_No }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.FirstName }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.SurName }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.Mi }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.Gender }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.Track }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.Section }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.Year }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.Adviser }}</td>
                <td class="border border-gray-300 px-4 py-2">
                <button title="Edit Record" @click="editRecord('EDIT',item)" class="mr-2 p-1 bg-green-500 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path d="M6.41421 15.89L16.5563 5.74786L15.1421 4.33365L5 14.4758V15.89H6.41421ZM7.24264 17.89H3V13.6474L14.435 2.21233C14.8256 1.8218 15.4587 1.8218 15.8492 2.21233L18.6777 5.04075C19.0682 5.43128 19.0682 6.06444 18.6777 6.45497L7.24264 17.89ZM3 19.89H21V21.89H3V19.89Z" fill="rgba(255,255,255,1)"></path></svg>
                </button>
                <button title="Delete Record" @click="deleteRecord(item)" class="p-1 bg-red-500 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 4V6H15V4H9Z" fill="rgba(255,255,255,1)"></path></svg>
                </button>
                </td>
            </tr>
            </tbody>
        </table>
      </div>
      <div v-else class="flex justify-center mt-10">
            <loading />
      </div>
        <div  v-if="recordDialog">
            <add-student-record :userObj="UserObj" :title="title"   @submitData="handleSubmitData" @ClsDialog="CloseDialog()"/>
        </div>
    </div>
  </template>

  <script>
import Loading from '../Loading.vue';
import addStudentRecord from './addStudentRecord.vue';
import Swal from 'sweetalert2';
  export default {
  components: { addStudentRecord, Loading },
    data() {
      return {
        search:'',
        title:'',
        loading:false,
        UserObj:{
            LRN_No: null,
            SurName: null,
            Mi: null,
            FirstName:null,
            Suffix: null,
            Email: null,
            Gender: null,
            Track: null,
            Section: null,
            Year :null,
            Adviser:null
        },
        recordDialog:false,
        dataRecords:[]

      };
    },
    computed: {
        FilterData() {
                if (this.search) {
                    const userDataCopy = [...this.dataRecords];
                    const searchQuery = this.search.toUpperCase();
                    return userDataCopy.filter((data) => {
                        const valuesAsString = Object.values(data).join(" ").toUpperCase();
                        const searchData = new RegExp(searchQuery.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), "g");
                    return searchData.test(valuesAsString);
                    });
                } else {
                    return this.dataRecords;
                }
            },
    },
    methods: {
        addRecord(title){
            this.UserObj={}
            this.title=title
            this.recordDialog=true
        },
        deleteRecord(val){
            Swal.fire({
                title: "Delete this Student Record?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                axios({
                    method:'post',
                    url:'/deleteRecord',
                    data:val
                }).then(res=>{
                    if(res.data){
                        Swal.fire({
                        title: "Deleted!",
                        text: "Student Record has been deleted.",
                        icon: "success"
                    });
                        this.loadRecords()
                    }
                }).catch(err=>{
                   alert(err.response.data.message)
                })

                }
            })

        },
        handleSubmitData(val){
            axios({
                method:'post',
                url:'/insertRecords',
                data:val
            }).then(res=>{
                if(res.data){
                    console.log(res.data,'2')
                    this.loadRecords()
                }
            }).catch(err=>{
                console.log(err.response.data.message)
            })
        },
        CloseDialog(val){
            this.recordDialog=val
        },
        editRecord(title,item){
            this.UserObj={}
            this.title=title
            this.recordDialog=true,
            this.UserObj={...item}
        },
        loadRecords(){
            this.loading=true
            setTimeout(() => {
                axios({
                    method:'get',
                    url:'/getAllRecords',
                }).then(res=>{
                    if(res.data){
                    this.dataRecords=res.data
                    this.loading=false
                    }
                }).catch(err=>{
                    console.log(err.response.data.message)
                    this.loading=false
                })
            }, 1500);
        }
    },
    mounted () {
        this.loadRecords()
    },
  };
  </script>

  <style scoped>
  /* Add any additional styles or Tailwind CSS classes as needed */
  </style>
