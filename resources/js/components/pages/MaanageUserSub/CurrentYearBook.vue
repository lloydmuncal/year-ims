<template>
    <div >
        <div class="container mx-auto rounded relative px-10">
            <div class="bg-gray-200 p-2">
                <h1 class="text-2xl md:text-xl font-semibold mb-2 md:mb-0 ">CURRENT YEARBOOK USERS</h1>
                <div class=" flex flex-col md:flex-row lg:flex-row md:items-center justify-end rounded">
                    <div class="flex  flex-col md:flex-row   items-center mt-4 md:mt-0 md:ml-4 w-full md:w-2/5">
                        <div class="flex w-full ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" class="mr-2 mt-2">
                                <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path>
                            </svg>
                            <input
                                v-model="search"
                                type="text"
                                placeholder="Search name or number here"
                                class="w-full h-10 rounded p-2 text-black focus:outline-none focus:ring focus:ring-blue-200 border-2 border-black"
                            />
                        </div>
                        <div class="mt-2 md:mt-0 lg:mt-0 ">
                            <button class="bg-blue-400 text-white text-xl font-semibold  shadow-xl rounded-md flex   px-2 py-1 ml-1" @click="openDialog('ADD')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="mt-1 mr-2">
                                    <path d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z" fill="rgba(255,255,255,1)"></path>
                                </svg>
                                ADD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto shadow-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                No
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                SurName
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                FirstName
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                LRN No.
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                Email
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                Phone number
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody v-if="loading==false" class="bg-white divide-y divide-gray-200 ">
                                <tr v-for="(item, i) in FilterData" :key="i" class="border-2 text-center">
                                    <td class="px-6 py-4 whitespace-nowrap ">{{ i+1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{item.SurName}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{item.FirstName}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{item.LRN_No}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{item.Email}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.Phone_No }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select v-model="item.Status" @change="updateStatus(item)" class="border-2 border-black p-1">
                                            <option :value="1">Active</option>
                                            <option :value="0">In-Active</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                    <button  @click="updateUSer('EDIT',item)" title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" >
                                            <path d="M16.7574 2.99666L14.7574 4.99666H5V18.9967H19V9.2393L21 7.2393V19.9967C21 20.5489 20.5523 20.9967 20 20.9967H4C3.44772 20.9967 3 20.5489 3 19.9967V3.99666C3 3.44438 3.44772 2.99666 4 2.99666H16.7574ZM20.4853 2.09717L21.8995 3.51138L12.7071 12.7038L11.2954 12.7062L11.2929 11.2896L20.4853 2.09717Z" fill="rgba(20,157,29,1)"></path>
                                        </svg>
                                    </button>
                                    <button  @click="deleteUser(item)" title="Delete User">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" >
                                            <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z" fill="rgba(248,10,10,1)"></path>
                                        </svg>
                                    </button>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    <div v-if="loading==true" class="flex justify-center mt-20">
                            <loading/>
                    </div>
                </div>
            </div>
            <div v-if="dialog==true">
                <add-user :userObj="UserObj" :title="title"   @submitData="handleSubmitData" @ClsDialog="CloseDialog()"/>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '../Loading.vue'
import addUser from './addUser.vue'
import Swal from 'sweetalert2'
    export default {
  components: { addUser, Loading },
        data() {
            return {
                loading:false,
                key: false,
                dialog:false,
                userData: {
                    firstName: '',
                    lastName: '',
                    lrn: '',
                    phoneNumber: '',
                    password: '',
                    confirmPassword: '',
                },
                title:'',
                User:null,
                search:null,
                UserObj:{
                    LRN_No: null,
                    SurName: null,
                    Mi: null,
                    FirstName:null,
                    Suffix: null,
                    Email: null,
                    Password: 'password',
                    PinCode: null,
                    Path:null,
                    Phone_No: null,
                    Gender: null,
                    Track: null,
                    Section: null,
                    Year :null,
                    UserType:'User',
                    Status:0,
                }
            }
        },
        methods: {
            openDialog(title) {
                this.UserObj={
                    LRN_No: null,
                    SurName: null,
                    Mi: null,
                    FirstName:null,
                    Suffix: null,
                    Email: null,
                    Password: 'password',
                    PinCode: null,
                    Path:null,
                    Phone_No: null,
                    Gender: null,
                    Track: null,
                    Section: null,
                    Year :null,
                    UserType:'User',
                    Status:0,
                }
                this.dialog = true
                this.title = title
            },
            loadAllUser(){
                this.userData=[]
                this.loading=true
                setTimeout(() => {
                    axios({
                        method:'GET',
                        url:'api/getUser'
                    }).then(res=>{
                        if(res.data){
                            this.User=res.data
                            this.loading=false
                        }
                    }).catch(err=>{
                        alert(err.message)
                        this.loading=false
                    });
                },1500);
            },
            updateStatus(item){
                axios({
                method:'post',
                url:'api/updateStatus',
                data:item
                }).then(res=>{
                    if(res.data){
                        Swal.fire({
                                position: "center",
                                icon: "success",
                                title: `User ${res.data.message}`,
                                showConfirmButton: false,
                                timer: 1500
                        });
                      this.loadAllUser()
                    }
                }).catch(err=>{
                   alert(err.response.data.message)
                   return false
                })
            },
            updateUSer(title,item){
                this.UserObj={}
                this.title ={}
                this.UserObj={...item}
                this.title = title
                this.dialog= true
            },
            deleteUser(item){
                Swal.fire({
                    title: "Delete this user?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios({
                                method:'post',
                                url:'api/deleteUser',
                                data:item
                            }).then(res=>{
                                    if(res.data){
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: `User Successfully deleted`,
                                        icon: "success"
                                    });
                                    this.loadAllUser()
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
                    url:'api/updateOrInsert',
                    data:val
                }).then(res=>{
                    if(res.data){
                        Swal.fire({
                            title: "Success!",
                            text: `${res.data}`,
                            icon: "success"
                        });
                      this.loadAllUser()
                    }
                }).catch(err=>{
                    console.log(err.response.data.message)
                })
            },
            CloseDialog(val){
                this.dialog=val
            }
        },
        mounted() {
            this.loadAllUser()
        },
        computed: {
            FilterData() {
                if (this.search) {
                    const userDataCopy = [...this.User];
                    const searchQuery = this.search.toUpperCase();
                    return userDataCopy.filter((data) => {
                        const valuesAsString = Object.values(data).join(" ").toUpperCase();
                        const searchData = new RegExp(searchQuery.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), "g");
                    return searchData.test(valuesAsString);
                    });
                } else {
                    return this.User;
                }
            },
        },

    }
</script>

<style lang="scss" scoped>

</style>
