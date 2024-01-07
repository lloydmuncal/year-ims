<template>
    <div class="fixed top-0 left-0  h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-40 overflow-y-auto  ">
        <div class="  w-full sm:w-1/2 h-full sm:h-5/6 overflow-y-auto  ">
                <div class="flex flex-col lg:flex-row   bg-white border-4 ">
                    <div class="md:block bg-gray-700   ">
                        <div class="flex justify-end">
                            <button @click="CloseDialog" class="text-blue-500 hover:underline lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z" fill="rgba(255,255,255,1)"></path>
                                </svg>
                            </button>
                        </div>
                        <img src="https://depedcavitecity.ph/wp-content/uploads/2019/09/spnhs-shs-294x300.png" alt="Logo" class="w-32 h-32 mx-auto max-w-full md:mt-4">
                        <div class="flex justify-center items-center  md:mt-12">
                            <p class="text-lg text-white text-center font-bold">
                                "UNLEASH THE MAGIC OF MEMORIES:"
                            </p>
                        </div>
                        <div class="flex justify-center items-center">
                            <p class="text-lg text-center text-white font-bold">
                                STEP INTO OUR VIRTUAL CAPSULE!"
                            </p>
                        </div>
                    </div>
    <!-- ================================================================================================================ -->
                    <div v-if="tab==0 && loading==false" class="w-full  p-4  ">
                        <div class="flex justify-between ">
                            <h2 class="text-2xl font-semibold mb-4">Register Account</h2>
                            <button @click="CloseDialog" class="text-blue-500 hover:underline hidden lg:inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                </svg>
                            </button>

                        </div>
                        <div v-if="tab1message" class="flex justify-center">
                            <p class="text-red-600 text-lg font-bold"> {{ tab1message }}</p>
                        </div>
                        <br v-else/>
                        <div class="mb-2">
                            <label for="lrn" class="block text-sm font-medium text-gray-600">LRN No.</label>
                            <input @input="FindLrnNO()" type="text" id="lrn" v-model="user.LRN_no" name="lrn" class="mt-1 p-2 rounded border border-gray-300 w-full" placeholder="Enter LRN No." />
                        </div>
                       <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <div class="md:col-span-3"> <!-- Surname and First Name share 3/4 of the width -->
                                <div>
                                    <label for="surname" class="block text-sm font-medium text-gray-600">Surname</label>
                                    <input type="text" id="surname" v-model="user.SurName" name="surname" class="mt-1 p-2 rounded border border-gray-300 w-full" placeholder="Enter Surname" />
                                </div>
                                <div>
                                    <label for="firstname" class="block text-sm font-medium text-gray-600">First Name</label>
                                    <input type="text" id="firstname" v-model="user.FirstName" name="firstname" class="mt-1 p-2 rounded border border-gray-300 w-full" placeholder="Enter First Name" />
                                </div>
                            </div>
                            <div class="md:col-span-1"> <!-- M.I and Suffix share the remaining 1/4 of the width -->
                                <div>
                                <div class="flex mt-1">
                                    <label for="mi" class="block text-xs font-medium text-gray-600">M.I</label>
                                    <p class="text-red-400 text-xs">(Optional)</p>
                                </div>
                                <input type="text" id="mi" name="mi" v-model="user.Mi" class="mt-1 p-2 rounded border border-gray-300 w-full" placeholder="Enter M.I" />
                                </div>
                                <div>
                                <div class="flex mt-1">
                                    <label for="suffix" class="block text-xs font-medium text-gray-600">Suffix </label>
                                    <p class="text-red-400 text-xs">(Optional)</p>
                                </div>
                                <input type="text" id="suffix" v-model="user.Suffix" name="suffix" @mouseover="showSuffixTooltip = true" @mouseout="showSuffixTooltip = false" class="mt-1 p-2 rounded border border-gray-300 w-full" placeholder="Enter Suffix" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-8 gap-1 flex justify-stretch">
                            <div class="md:col-span-4">
                                <label for="Email" class="block text-sm font-medium text-gray-600">Email</label>
                                <input type="email" id="Email" name="Email" v-model="user.Email" class="mt-1 p-2 rounded border border-gray-300 text-base w-full" placeholder="Enter Email" />
                            </div>
                            <div class="md:col-span-3">
                                <label for="phone" class="block text-sm font-medium text-gray-600">Phone No</label>
                                <input type="tel" id="phone" name="phone" @input="handlePhoneInput" v-model="user.Phone_No" class="mt-1 p-2 rounded border border-gray-300 text-base w-full" placeholder="Enter Phone No" maxlength="11" required />
                            </div>
                            <div class="md:col-span-1">
                                <label for="gender" class="block text-sm font-medium text-gray-600">Gender</label>
                                <select id="gender" name="gender" v-model="user.Gender" class="mt-1 p-2 rounded border border-gray-300 text-sm">
                                    <option value="Male">M</option>
                                    <option value="Female">F</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="track" class="block text-sm font-medium text-gray-600">Track</label>
                                <select id="text" name="text" v-model="user.Track" class="mt-1 p-2 rounded border border-gray-300 w-full">
                                    <option value="" disabled>Select Track</option>
                                    <option v-for="track in tracks" :key="track.TrackName" >{{ track.TrackName}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="section" class="block text-sm font-medium text-gray-600">Section</label>
                                <select id="section" name="section" v-model="user.Section" class="mt-1 p-2 rounded border border-gray-300 w-full">
                                    <option value="" disabled>Select Section</option>
                                    <option v-for="sec in sections" :key="sec.SectionName" >{{ sec.SectionName}}</option>
                                </select>
                            </div>


                            <div class="relative">
                                <label for="year" class="block text-sm font-medium text-gray-600">Select Year</label>
                                <div class="relative">
                                <select id="year" name="year" v-model="user.Year"  class="mt-1 p-2 rounded border border-gray-300 w-full cursor-pointer appearance-none">
                                    <option value="" disabled selected>Select Year</option>
                                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 flex justify-end">
                            <button @click="passwordTab" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Next</button>
                        </div>
                    </div>
<!-- ================================================================================================================ -->
                    <div v-if="tab==1 && loading==false" class="w-full p-4 ">
                        <div class="flex justify-between ">
                            <div>
                                <h2 class="text-2xl font-semibold mb-4">Create a Password</h2>
                            </div>
                            <button @click="CloseDialog" class="text-blue-500 hover:underline  hidden lg:inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                    <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                </svg>
                            </button>
                        </div>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <div v-if="tab2message" class="flex justify-center">
                            <p class="text-red-600 text-sm"> {{ tab2message }}</p>
                        </div>
                        <br v-else/>
                        <div >
                            <p class="text-sm text-gray-400  italic ">* Create a Password with at least 8 characters long.</p>
                            <p class="text-sm text-gray-400 mb-2  italic "> It should be something other couldn't guess.</p>
                            <div class="relative">
                                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
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
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <div class="flex items-center">
                            <input v-model="user.Agreement" type="checkbox" id="agreeCheckbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                            <label  for="agreeCheckbox" class="ml-2 block text-sm italic">
                                I agree to
                                <a href="#" @click="TermsFnc()" class="text-blue-500 hover:underline">Terms of Service</a>
                                and
                                <a href="#" @click="PrivcyFnc()" class="text-blue-500 hover:underline">Privacy Policy.</a>
                            </label>
                        </div>
                        <div class="flex justify-between  ">
                            <button @click="tab = 0" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 mt-16">Back</button>
                            <button @click="registerTab()"
                            :class="{ 'bg-blue-500': user.Agreement, 'bg-gray-400 cursor-not-allowed': !user.Agreement }"
                            :disabled="!user.Agreement"
                            class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 mt-16">Next</button>
                        </div>
                    </div>
<!-- ================================================================================================================ -->
                    <div v-if="tab==2 && loading==false" class=" w-full  p-4 ">
                        <div class="flex justify-center items-center md:mt-16">
                            <h4 class="text-xl font-bold">YOUR REGISTRATION</h4>
                        </div>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <div class="flex justify-center items-center">
                            <h4 class="text-xl font-bold">SUCCESSFUL DONE!</h4>
                        </div>
                        <div class="md:mt-16">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBHXC7cL9mfgxPGLLggQNsHu_zIQnk4R0BmnnyCTRflEb9gRMGpkuIDMSww4TKoc1yrZg&usqp=CAU" alt="Logo" class="w-40 h-84 mx-auto mt-4">
                        </div>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <div class="flex justify-center items-center ">
                            <button @click="CloseDialog()" class="bg-gray-700 rounded-lg px-2 py-2 text-white font-bold">
                                Go back to login-page
                            </button>
                        </div>
                    </div>
                    <div v-if=" loading==true" class="w-full  p-4 ">
                        <div class="flex justify-center items-center md:mt-16">
                            <h4 class="text-3xl font-bold">Please Wait</h4>
                        </div>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <div class="mt-16 flex justify-center items-center">
                            <img src="../../Asset/ZKZg.gif" class="w-22 h-32"/>
                        </div>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <div class="flex justify-center items-center">
                            <h4 class="text-3xl font-bold">LOADING!</h4>
                        </div>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                        <br class=" hidden lg:inline-block"/>
                    </div>
                </div>
            </div>
            <div v-if="termsDailog ==true ">
                <Terms @CloseDialog="CloseTermsPrivacy"/>
            </div>
            <div v-if="privacyDialog==true">
                <Privacy @CloseDialog="CloseTermsPrivacy"/>
            </div>
    </div>
</template>

<script>
import Privacy from './Privacy.vue';
import Terms from './Terms.vue'

    export default {
    data() {
        return {
            termsDailog:false,
            privacyDialog:false,
            tab: 1,
            years: [],
            user: {
                LRN_no: null,
                SurName: null,
                Mi: null,
                FirstName: null,
                Suffix: null,
                Email: null,
                Password: null,
                PinCode: null,
                Path: null,
                Phone_No: null,
                Gender: null,
                Track: null,
                Section: null,
                Year: null,
                UserType: 'User',
                Status: 0,
                Agreement: false
            },
            confirmPassword: null,
            tab1message: null,
            tab2message: null,
            showPassword: false,
            loading: false,
            showMITooltip: false,
            showSuffixTooltip: false,
            tracks: [],
            sections: []
        };
    },
    methods: {
        PrivcyFnc(){
            this.termsDailog=true
        },
        TermsFnc(){
            this.privacyDialog=true
        },
        CloseTermsPrivacy(val){
            this.termsDailog=val
            this.privacyDialog=val

        },
        
        getAllTrack() {
            axios({
                method: 'get',
                url: '/getAllTrack'
            }).then(res => {
                this.tracks = res.data;
            });
        },
        getAllSection() {
            axios({
                method: 'get',
                url: '/getAllSection'
            }).then(res => {
                this.sections = res.data;
            });
        },
        CloseDialog() {
            this.tab = 0;
            this.tab1message = null;
            this.$emit('CloseRegister', false);
        },
        passwordTab() {
            if (!this.user.LRN_no || !this.user.SurName || !this.user.FirstName ||
                !this.user.Phone_No || !this.user.Gender || !this.user.Track ||
                !this.user.Year || !this.user.Section) {
                this.tab1message = 'Please Complete All fields!';
                return false;
            }
            if (this.user.Phone_No.length != 11) {
                this.tab1message = 'Mobile Number length must be 11!';
                return false;
            }
            if (!this.user.Email.includes('@gmail.com') && !this.user.Email.includes('@yahoo.com')) {
                this.tab1message = 'Check your Email Format!';
                return false;
            }
            this.loading = true;
            setTimeout(() => {
                this.tab = 1;
                this.loading = false;
            }, 1500);
        },
        registerTab() {
            this.loading = true;
            if (!this.user.Password || !this.confirmPassword) {
                this.tab2message = 'Please Complete All fields !';
                this.loading = false;
                return false;
            }
            if (this.user.Password != this.confirmPassword) {
                this.tab2message = 'Password Not Match!';
                this.loading = false;
                return false;
            }
            setTimeout(() => {
                this.user.Status = 0;
                axios({
                    method: 'post',
                    url: 'api/insertUser',
                    data: this.user
                }).then(res => {
                    this.tab = 2;
                    this.loading = false;
                }).catch(err => {
                    alert(err.response.data.message);
                    this.loading = false;
                });
            }, 2000);
        },
        getDateInfo() {
            const currentYear = new Date().getFullYear();
            const startYear = currentYear - 20; // Adjust the range as needed
            for (let year = startYear; year <= currentYear; year++) {
                this.years.push(year);
            }
        },
        FindLrnNO() {
            axios({
                method: 'post',
                url: '/getLrnRecord',
                data: this.user
            }).then(res => {
                if (res.data.length > 0) {
                    let obj = res.data[0];
                    this.user = {
                        LRN_no: obj.LRN_No,
                        SurName: obj.SurName,
                        Mi: obj.Mi,
                        FirstName: obj.FirstName,
                        Suffix: obj.Suffix,
                        Gender: obj.Gender,
                        Track: obj.Track,
                        Section: obj.Section,
                    };
                }
            }).catch(err => {
                alert(err.response.data.message);
                this.loading = false;
            });
        },
        handlePhoneInput() {
            this.user.Phone_No = this.user.Phone_No.replace(/[^0-9]/g, '');
            if (this.user.Phone_No.length > 11) {
                this.user.Phone_No = this.user.Phone_No.slice(0, 11);
            }
        },
    },
    mounted() {
        this.getAllSection();
        this.getAllTrack();
        this.getDateInfo();
    },
    components: { Terms, Privacy }
}
</script>

<style lang="scss" scoped>

</style>
