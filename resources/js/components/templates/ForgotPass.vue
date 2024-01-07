<template>
    <div  class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white p-2 rounded-lg shadow-md w-full sm:w-96">
                <div class="flex justify-end ">
                    <button @click="CloseDialog()" class="text-blue-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="bg-blue-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto">
                    <img src="https://cdn-icons-png.flaticon.com/512/67/67785.png" alt="key" class="w-10 h-10" />
                </div>
                <div class="flex justify-center">
                    <h2 class="text-2xl font-semibold mb-4">Forgot Password ?</h2>
                </div>
                <div class="border-t-4 class mb-3 border-gray-400"></div>
                <div v-if="PassWordTab ==0 && loading==false" class="flex flex-col items-center justify-center h-full">
                    <p class="mb-4">Enter your LRN to reset your password:</p>
                    <input v-model="forgot.Lrn_No" class="w-full p-2 border rounded mb-4" type="email" placeholder="LRN" />
                    <button @click="VerifyLRN()" class="w-full bg-blue-500 text-white font-semibold p-2 rounded">Verify LRN</button>
                </div>
                <div v-else-if="PassWordTab ==1 && loading==false" class="flex flex-col items-center justify-center h-full">
                    <div class="flex justify-center mb-3">
                        <p class="font-semibold italic text-sm">A Verification Pin Code has been sent to your Email Account</p>
                    </div>
                    <p class="mb-4">Enter the Pin Code:</p>
                    <input v-model="forgot.PinCode" class="w-full p-1 border rounded mb-2" type="email" placeholder="PIN CODE" />
                    <p class="mb-4 text-xs">
                        Didn't receive the code? <a  href="#" class="text-blue-500 underline" @click.prevent="resendCode">Click here to resend.</a>
                    </p>
                    <button @click="VefifyPinCode()" class="w-full bg-blue-500 text-white font-semibold p-2 rounded">Change Password.</button>
                </div>
                <div v-else-if="PassWordTab ==2 && loading==false" class="flex flex-col items-center justify-center h-full">
                    <div  >
                        <h2 class="text-xl font-semibold mb-4">Create a New Password</h2>
                        <div >

                            <p class="text-xs text-gray-400  italic ">* Create a Password with at least 8 characters long.</p>
                            <p class="text-xs text-gray-400 mb-2  italic "> It should be something other couldn't guess.</p>
                            <div class="relative">
                                <div class="flex">
                                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                                    <p v-if="tab2message" class="text-xs text-red-400  italic ml-10"> {{ '*( '+  tab2message+ ' )*' }}</p>
                                </div>
                                <input  :type="showPassword ? 'text' : 'password'" v-model="user.Password"  id="password" name="password" class="mt-1 p-2 rounded border border-gray-300 w-full pr-10" placeholder="Enter Password" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="confirm-password" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                            <div class="relative">
                                <input  :type="showPassword ? 'text' : 'password'" v-model="confirmPassword"  id="confirm-password" name="confirm-password" class="mt-1 p-2 rounded border border-gray-300 w-full pr-10" placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class=" inset-y-0 right-0 flex items-center mt-2 pr-3">
                            <input type="checkbox" id="showPassword" v-model="showPassword" class="h-4 w-4 text-blue-500 border border-gray-300 rounded cursor-pointer" />
                            <label for="showPassword" class="ml-2 text-sm text-gray-600 cursor-pointer">Show Password</label>
                        </div>
                    </div>
                    <br/>
                    <button @click="ChangePassword()" class="w-full bg-blue-500 text-white font-semibold p-2 rounded">Change Password.</button>
                </div>
                <div v-if="PassWordTab==3 && loading==false" class=" flex flex-col items-center justify-center h-full">
                    <div class="flex justify-center items-center">
                        <h4 class="text-xl font-bold">YOUR REGISTRATION</h4>
                    </div>

                    <div class="flex justify-center items-center">
                        <h4 class="text-xl font-bold">SUCCESSFUL DONE!</h4>
                    </div>
                    <div>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBHXC7cL9mfgxPGLLggQNsHu_zIQnk4R0BmnnyCTRflEb9gRMGpkuIDMSww4TKoc1yrZg&usqp=CAU" alt="Logo" class="w-40 h-84 mx-auto mt-4">
                    </div>
                    <br/>
                    <br/>
                    <div class="flex justify-center items-center ">
                        <button @click="CloseDialog()" class="bg-gray-700 rounded-lg px-2 py-2 text-white font-bold">
                            Go back to login-page
                        </button>
                    </div>
                </div>
                <div v-if=" loading==true" class="flex flex-col items-center justify-center h-full ">
                    <div class="flex justify-center items-center mt-13">
                        <h4 class="text-3xl font-bold">Please Wait</h4>
                    </div>
                    <div class="mt-16 flex justify-center items-center">
                        <img src="../../Asset/ZKZg.gif" class="w-22 h-32"/>
                    </div>
                    <br/>
                    <div class="flex justify-center items-center">
                        <h4 class="text-3xl font-bold">LOADING!</h4>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                email: '',
                otp: '',
                PassWordTab: 0,
                forgot:{
                    Lrn_No:null,
                    PinCode:null
                },
                LrnHolder:null,
                user:{},
                confirmPassword:null,
                showPassword:false,
                tab2message:'',
                loading:false
            }
        },methods: {
            VerifyLRN(){
                this.LrnHolder=null
                this.PassWordTab=0
                this.loading=true
                    axios({
                        method:'POST',
                        url:'api/VerifyLrn',
                        data:{Lrn_No:this.forgot.Lrn_No}
                    }).then(res=>{
                        if(res.data){
                            this.LrnHolder=res.data
                            axios({
                                method:'POST',
                                url:'api/GeneratePinCode',
                                data:this.LrnHolder
                            }).then(rex=>{
                                if(rex.data){
                                    this.PassWordTab=1
                                    this.loading=false
                                    axios({
                                        method:'POST',
                                        url:'api/mail/store',
                                        data:{PinCode:rex.data,ToMail:this.LrnHolder.Email}
                                    }).then(mail=>{

                                        console.log(mail.data)
                                    })
                                }
                            })
                        }
                    }).catch(err=>{
                        console.log(err.message)
                    })
            },
            resendCode() {
                    axios({
                        method:'POST',
                        url:'api/GeneratePinCode',
                        data:this.LrnHolder
                    }).then(rex=>{
                        if(rex.data){
                            this.otpSent = true
                            axios({
                                method:'POST',
                                url:'api/mail/store',
                                data:{PinCode:rex.data,ToMail:this.LrnHolder.Email}
                            }).then(mail=>{
                                console.log(mail.data)
                            })
                        }
                    })
            },
            VefifyPinCode() {
                this.PassWordTab=2
                this.loading=true
                axios({
                    method:'POST',
                    url:'api/VerifyPinCode',
                    data:{Lrn_No:this.forgot.Lrn_No,PinCode:this.forgot.PinCode}
                }).then(res=>{
                    if(res.data){
                      this.user=res.data
                      this.user.Password=null
                      this.loading=false
                    }
                })
            },
            ChangePassword(){
                if(!this.user.Password || !this.confirmPassword){
                    this.tab2message ='Please Complete All fields !'
                    return false
                }
                if(this.user.Password != this.confirmPassword){
                    this.tab2message ='Password Not Match!'
                    return false
                }
                this.loading=true
                setTimeout(() => {
                    axios({
                        method:'post',
                        url:'api/ChangePassword',
                        data:this.user
                    }).then(res=>{
                        this.PassWordTab=3
                        this.loading=false
                        console.log(res.data)
                    }).catch(err=>{
                        this.loading=false
                        alert(err.message)
                    })
                }, 2000);


            },
            CloseDialog(){
                this.$emit('CloseForgot',false)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
