<template>
    <div class="h-fit xs:h-full sm:h-full  flex items-center justify-center">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-200 w-screen sm:w-96 md:w-96 lg:w-96 xl:w-96">
                <div class="flex justify-center">
                    <img src="https://depedcavitecity.ph/wp-content/uploads/2019/09/spnhs-shs-294x300.png" alt="Logo" class="w-32 h-32 mx-auto">
                </div>
                <div class="flex justify-center">
                    <h1 class="text-sm font-bold">  SANGLEY POINT NATIONAL HIGH SCHOOL </h1>
                </div>
                <div class="flex justify-center">
                    <h1 class="text-lg font-bold">  SENIOR HIGH SCHOOL </h1>
                </div>
                <hr class="border-t-3 border-black"/>
                <div >
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-medium">LRN No.:</label>
                    <input v-model="login.Lrn_No"  id="email" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>
                <!-- <div class="mb-4">
                    <label for="password" class="block text-gray-600 font-medium">Password</label>
                    <input :type="showPassword ? 'text' : 'password'" v-model="login.Password" type="password" id="password"  @keyup.enter="LoginUser()" class="w-full border border-gray-300 rounded px-3 py-2">
                </div> -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-600 font-medium">Password:</label>
                    <div class="relative">
                        <input v-model="login.Password" :type="showPassword ? 'text' : 'password'" id="password" @keyup.enter="LoginUser()" class="w-full border border-gray-300 rounded px-3 py-2 pr-10">

                        <button @click="toggleShowPassword" class="absolute top-1/2 right-2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                            <path v-if="showPassword==true" d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z" fill="currentColor"></path>
                            <path  v-else d="M4.52047 5.93457L1.39366 2.80777L2.80788 1.39355L22.6069 21.1925L21.1927 22.6068L17.8827 19.2968C16.1814 20.3755 14.1638 21.0002 12.0003 21.0002C6.60812 21.0002 2.12215 17.1204 1.18164 12.0002C1.61832 9.62282 2.81932 7.5129 4.52047 5.93457ZM14.7577 16.1718L13.2937 14.7078C12.902 14.8952 12.4634 15.0002 12.0003 15.0002C10.3434 15.0002 9.00026 13.657 9.00026 12.0002C9.00026 11.537 9.10522 11.0984 9.29263 10.7067L7.82866 9.24277C7.30514 10.0332 7.00026 10.9811 7.00026 12.0002C7.00026 14.7616 9.23884 17.0002 12.0003 17.0002C13.0193 17.0002 13.9672 16.6953 14.7577 16.1718ZM7.97446 3.76015C9.22127 3.26959 10.5793 3.00016 12.0003 3.00016C17.3924 3.00016 21.8784 6.87992 22.8189 12.0002C22.5067 13.6998 21.8038 15.2628 20.8068 16.5925L16.947 12.7327C16.9821 12.4936 17.0003 12.249 17.0003 12.0002C17.0003 9.23873 14.7617 7.00016 12.0003 7.00016C11.7514 7.00016 11.5068 7.01833 11.2677 7.05343L7.97446 3.76015Z" fill="currentColor"></path>
                        </svg>
                        </button>
                    </div>
                </div>

                <div v-if="showMssg==true" class="mb-2 flex justify-center">
                    <p class="text-red-600 text-sm">Login Failed! {{ WrongMssg }}, Please Try again.</p>
                </div>
                <div>
                    <button @click="LoginUser()"
                    :class="{ 'bg-blue-500': !loadingBtn, 'bg-gray-400 cursor-not-allowed': loadingBtn }"
                    class="w-full text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                        <span v-if="loadingBtn">
                            <img src="../../Asset/ZKZg.gif" alt="Loading" class="mr-2 h-6 w-6 inline" /> Loading...
                        </span>
                        <span v-else>Login</span>
                    </button>
                </div>
                    <div class="mt-4 flex flex-col sm:flex-row    sm:justify-between " >
                        <a href="#" @click="showSignUpDialog" class="text-blue-500 hover:underline mb-2 sm:mb-0 sm:mr-2">Sign Up</a>
                        <a href="#" @click="PasswordDialog" class="text-blue-500 hover:underline">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
      <div v-if="showForgotPassword" >
        <forgot-pass @CloseForgot="CloseForgot"/>
      </div>
      <div v-if="showSignUp" >
           <register-page @CloseRegister="CloseRegister"/>
      </div>
    </div>
  </template>

  <script>
import ForgotPass from '../templates/ForgotPass.vue';
import RegisterPage from '../templates/RegisterPage.vue';
import {useUserStore} from '../../Store/mainStore.js'
  export default {
    components:{ RegisterPage, ForgotPass },
    data() {
      return {
        userStore  : useUserStore(),
        login:{
            Lrn_No:'',
            Password:''
        },
        showForgotPassword: false,
        showSignUp: false,
        tab:0,
        WrongMssg:'',
        showMssg:false,
        loadingBtn:false,
        showPassword:false
      };
    },
    methods: {
      toggleShowPassword(){
        this.showPassword = !this.showPassword
      },
      PasswordDialog() {
        this.showForgotPassword = true;
      },
      showSignUpDialog() {
        this.showSignUp = true;
      },
      CloseRegister(val) {
        this.showSignUp = val;
      },
      CloseForgot(val){
        this.showForgotPassword = val
      },
      LoginUser(){
        this.showMssg=false
        this.WrongMssg=''
        this.loadingBtn=true
        if(!this.login.Lrn_No ||!this.login.Password  ){
            this.showMssg=true
            this.loadingBtn=false
            this.WrongMssg='Complete All fields!'
            return false
        }
            axios({
                method:'Post',
                url:'api/loginUser',
                data:this.login
            }).then(res=>{
                if( typeof(res.data) == 'object'){
                    this.loadingBtn=false
                    res.data.Details='Login Success'
                    axios({
                        method:'post',
                        url:'/LoginLogs',
                        data:res.data
                    }).then(rex=>{
                        this.userStore.setUser(res.data)
                        this.userStore.setAvatar(res.data.Path)
                        this.userStore.getAvatar()
                        this.userStore.initializeUser()
                        this.$router.push('/')
                    })
                }
                else if(typeof(res.data) == 'string'){
                    this.showMssg=true
                    this.loadingBtn=false
                    this.WrongMssg=res.data
                }
            })
      }
    },
    mounted() {

    },
    created() {

    },
  };
  </script>
