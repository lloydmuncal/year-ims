<template>
    <div class="h-screen">
      <div  class=" max-w-3xl mx-auto container h-6/8 overflow-y-auto p-6 bg-white shadow-xl border-4 ">
            <div >
                <div class="flex justify-end">
                    <img @click="uploadImage()" :src="useUser.avatar" class="w-24 h-24 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 cursor-pointer mb-2" alt="User Avatar">
                </div>
                <div class="flex justify-start grid grid-cols-1 md:grid-cols-2">
                    <h1 class="text-2xl font-semibold ">Profile Information</h1 >
                    <p :class="{'text-green-400' :confirmColor, 'text-red-400' :!confirmColor }"
                    class="text-red-400 italic font-semibold md:mt-2">{{profileInfoMessage ? ` *${profileInfoMessage}*` : ''  }}</p>
                </div>
                <div class="border-t-4 border-gray-500"></div>
                <div>
                    <label for="lrn" class="block text-sm font-medium text-gray-600">LRN (Learner Reference Number):</label>
                    <input v-model="profileInfo.LRN_No" id="lrn" type="text" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="cols-span-2">
                        <div >
                            <label for="firstName" class="block text-sm font-medium text-gray-600">First Name:</label>
                            <input v-model="profileInfo.FirstName" id="firstName" type="text" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name:</label>
                            <input v-model="profileInfo.SurName" id="lastName" type="text" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="cols-span-2">
                        <div >
                            <label for="MI" class="block text-sm font-medium text-gray-600">M.I:</label>
                            <input v-model="profileInfo.Mi" id="MI" type="text" class="mt-1 px-4 py-2 block w-24 border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                        <div >
                            <label for="Suffix" class="block text-sm font-medium text-gray-600">Suffix:</label>
                            <input v-model="profileInfo.Suffix" id="Suffix" type="text" class="mt-1 px-4 py-2 block w-24 border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>

                </div>
                <div class="mt-2 flex justify-center">
                    <button @click="saveProfileInfo()" class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                        <span v-if="profileInfoLoading">
                            <img src="../../Asset/ZKZg.gif" alt="Loading" class="mr-2 h-6 w-6 inline" /> Loading...
                        </span>
                        <span v-else>
                            Save Change
                        </span>
                    </button>
                </div>
            </div>
            <div>
                <div>
                    <div class=" bg-white shadow-md rounded-md">
                        <div class="flex justify-start grid grid-cols-1 md:grid-cols-2">
                            <h1 class="text-2xl font-semibold">Password and Security</h1>
                            <p :class="{'text-green-400' :confirmColor, 'text-red-400' :!confirmColor }"
                             class="text-red-400 italic font-semibold md:mt-2">{{securityInfoMessage ? ` *${securityInfoMessage}*` : ''  }}</p>
                        </div>

                     <div class="border-t-4 border-gray-500 mb-4"></div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label for="CurrentPassword" class="block text-sm font-medium text-gray-600">Current Password:</label>
                            <input v-model="securityInfo.CurrentPassword" id="CurrentPassword" :type="showPassword ? 'text' : 'password'" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="NewPassword" class="block text-sm font-medium text-gray-600">New Password:</label>
                            <input v-model="securityInfo.NewPassword" id="NewPassword" :type="showPassword ? 'text' : 'password'" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="ConfirmPassword" class="block text-sm font-medium text-gray-600 ">Confirm Password:</label>
                        <input v-model="securityInfo.ConfirmPassword" id="ConfirmPassword" :type="showPassword ? 'text' : 'password'" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>

                    <input type="checkbox" id="showPassword" v-model="showPassword" class="h-4 w-4  text-blue-500 border border-gray-300 rounded cursor-pointer" />
                    <label for="showPassword" class="ml-2 text-sm text-gray-600 cursor-pointer">Show Password</label>
                    <div class="mt-2 flex justify-center">
                        <button @click="saveSecurityInfo()" class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                            <span v-if="securityInfoLoading">
                                <img src="../../Asset/ZKZg.gif" alt="Loading" class="mr-2 h-6 w-6 inline" /> Loading...
                            </span>
                            <span v-else>
                                Save Change
                            </span>
                        </button>
                    </div>
                    </div>
                </div>
            </div>
            <div>
                <div class=" bg-white shadow-md ">
                    <div class="flex justify-start grid grid-cols-1 md:grid-cols-2">
                        <h1 class="text-2xl font-semibold">Contact</h1>
                        <p :class="{'text-green-400' :confirmColor, 'text-red-400' :!confirmColor }"
                            class="text-red-400 italic font-semibold md:mt-2">{{contactInfoMessage ? ` *${contactInfoMessage}*` : ''  }}</p>
                    </div>
                <div class="border-t-4 border-gray-500 mb-4"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="Email" class="block text-sm font-medium text-gray-600">Email:</label>
                        <input v-model="contactInfo.Email" id="Email" type="text" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="Mobile" class="block text-sm font-medium text-gray-600">Mobile:</label>
                        <input @input="handlePhoneInput" v-model="contactInfo.Mobile" id="Mobile" type="text" class="mt-1 px-4 py-2 block w-full border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                    </div>
                </div>
                <div class="mt-2 flex justify-center">
                    <button @click="saveContactInfo()" class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                        <span v-if="contactInfoLoading">
                            <img src="../../Asset/ZKZg.gif" alt="Loading" class="mr-2 h-6 w-6 inline" /> Loading...
                        </span>
                        <span v-else>
                            Save Change
                        </span>
                    </button>
                </div>
                </div>
            </div>
            <div v-if="uploadingDialog">
                <upload-avatar  @handleFileUpload="handleFileUpload"  @CloseDialog="ClsDialog()" />
            </div>
        </div>
    </div>
  </template>

  <script>
import { useUserStore } from '../../Store/mainStore'
import uploadAvatar from '../templates/uploadAvatar.vue';
  export default {
  components: { uploadAvatar },
    data() {
      return {
        useUser:useUserStore(),
        profileInfoMessage:null,
        profileInfoLoading:false,
        confirmColor:false,
        profileInfo: {
            id:null,
            LRN_No:null,
            FirstName: null,
            SurName: null,
            Mi:null,
            Suffix:null
        },
        showPassword:false,
        securityInfoLoading:false,
        securityInfoMessage:null,
        securityInfo: {
          CurrentPassword:null,
          NewPassword: null,
          ConfirmPassword:null
        },
        contactInfoLoading:false,
        contactInfoMessage:null,
        contactInfo: {
            Email: null,
            Mobile:null
        },
        uploadingDialog:false
      };
    },
    methods: {
      saveProfileInfo() {
        this.profileInfoMessage = null;
        this.profileInfoLoading=true
        this.confirmColor=false
        if(!this.profileInfo.LRN_No || !this.profileInfo.FirstName|| !this.profileInfo.SurName ){
            this.profileInfoMessage = 'Please Complete All Necessary Fields!'
            this.profileInfoLoading=false
            return false;
        }
        axios({
            method:'POST',
            url:'api/updateUserInfo',
            data:this.profileInfo
        }).then(res=>{
            // this.userStore.setUser(null)
            this.useUser.setUser(res.data.data)
            this.useUser.initializeUser()
            this.loadData()

            this.confirmColor=true
            this.profileInfoMessage =res.data.message
            this.profileInfoLoading=false
            // this.useUser.userData.LRN_No = this.profileInfo.LRN_No
            // this.useUser.userData.FirstName = this.profileInfo.FirstName
            // this.useUser.userData.SurName = this.profileInfo.SurName
            // this.useUser.userData.Mi = this.profileInfo.Mi
            // this.useUser.userData.Suffix = this.profileInfo.Suffix
            setTimeout(() => {
                this.confirmColor=false
                this.profileInfoMessage=false
            }, 4500);

        }).catch(err=>{
            this.profileInfoLoading=false
            this.profileInfoMessage = err.message
        })

      },
      saveSecurityInfo() {
        this.securityInfoMessage = null;
        this.securityInfoLoading=true
        this.confirmColor=false
        if(!this.securityInfo.CurrentPassword || !this.securityInfo.NewPassword|| !this.securityInfo.ConfirmPassword ){
            this.securityInfoMessage = 'Please Complete All Necessary Fields!'
            this.securityInfoLoading=false
            return false;
        }
        axios({
            method:'POST',
            url:'api/updateSecurityInfo',
            data:this.securityInfo
        }).then(res=>{

            this.confirmColor=true
            this.securityInfoMessage =res.data.message
            this.securityInfoLoading=false

            setTimeout(() => {
                this.confirmColor=false
                this.securityInfoMessage=false
            }, 4500);

        }).catch(err=>{
            this.securityInfoLoading=false
            this.securityInfoMessage = err.message
        })
      },
      saveContactInfo() {
        this.securityInfoMessage = null;
        this.contactInfoLoading=true
        this.confirmColor=false
        if(!this.contactInfo.Email || !this.contactInfo.Mobile ){
            this.contactInfoMessage = 'Please Complete All Necessary Fields!'
            this.contactInfoLoading=false
            return false;
        }
        if(!this.contactInfo.Email.includes('@gmail.com') && !this.contactInfo.Email.includes('@yahoo.com')  ){
            this.contactInfoMessage='Check your Email Format!'
            this.contactInfoLoading=false
            return false
        }
        axios({
            method:'POST',
            url:'api/updateContactInfo',
            data:this.contactInfo
        }).then(res=>{

            this.confirmColor=true
            this.contactInfoMessage =res.data.message
            this.useUser.setUser(res.data.data)
            this.useUser.initializeUser()
            this.loadData()
            // this.useUser.userData.Email = this.profileInfo.Email
            // this.useUser.userData.Phone_No = this.profileInfo.Mobile
            this.contactInfoLoading=false
            setTimeout(() => {
                this.confirmColor=false
                this.contactInfoMessage=false
            }, 4500);
        }).catch(err=>{
            this.contactInfoLoading=false
            this.contactInfoMessage = err.message
        })
      },
      uploadImage(){
        this.uploadingDialog=true
      },
      ClsDialog(val){
        this.uploadingDialog=val
      },
      handleFileUpload(val){
            val[0].LRN_No = this.useUser.userData.LRN_No
            val[0].id = this.useUser.userData.id
            axios({
                method:'POST',
                url:'api/addAvatar',
                data:val[0]
            }).then(res=>{
                console.log(res.data,'asd')
                this.useUser.setAvatar(val[0].filename)
                this.uploadingDialog=false
            })
      },
      loadData(){
        let data= this.useUser.UserDetails();
        this.useUser.getAvatar()
        this.profileInfo.id = data.id
        this.profileInfo.LRN_No  = data.LRN_No
        this.profileInfo.FirstName = data.FirstName
        this.profileInfo.SurName = data.SurName
        this.profileInfo.Mi = data.Mi
        this.profileInfo.Suffix = data.Suffix
        this.securityInfo.id = data.id
        this.contactInfo.id = data.id
        this.contactInfo.Email = data.Email
        this.contactInfo.Mobile = data.Phone_No
      },
      handlePhoneInput() {
        this.contactInfo.Mobile = this.contactInfo.Mobile.replace(/[^0-9]/g, '');
        if (this.contactInfo.Mobile.length > 11) {
            this.contactInfo.Mobile = this.contactInfo.Mobile.slice(0, 11);
        }
    },
    },
    mounted () {
        this.loadData()
    },
  };
  </script>
