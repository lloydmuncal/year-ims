<template>
    <div>

        <div class="container mx-auto rounded relative px-10">
            <div class="bg-gray-100 p-2 flex flex-col md:flex-row md:items-center justify-between">
                <h1 class="text-2xl font-semibold mb-2 md:mb-0">MANAGE USERS</h1>

                <div class="flex items-center w-4/12">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" class="mr-2">
                        <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path>
                    </svg>
                    <input
                    v-model="search"
                    type="text"
                    placeholder="Search name or number here"
                    class="w-full h-10 rounded p-2 text-black focus:outline-none focus:ring focus:ring-blue-200 border-2 border-black "
                    />
                    <button class="bg-blue-300 text-white text-xl font-semibold  shadow-xl rounded-md flex  w-fit px-4 py-2 ml-4" @click="openDialog('ADD',item)" >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="mt-1 mr-2">
                            <path d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                        ADD
                    </button>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                No
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Name
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Phone number
                                </th>
                                <th scope="col" class="sticky top-0 bg-gray-700 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 ">
                            <tr v-for="(item, i) in 20" :key="i">
                                <td class="px-6 py-4 whitespace-nowrap">{{ i+1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap">555-555-5555</td>
                                <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                    <button @click="openDialog('EDIT',item)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24"  >
                                        <path d="M16.7574 2.99666L14.7574 4.99666H5V18.9967H19V9.2393L21 7.2393V19.9967C21 20.5489 20.5523 20.9967 20 20.9967H4C3.44772 20.9967 3 20.5489 3 19.9967V3.99666C3 3.44438 3.44772 2.99666 4 2.99666H16.7574ZM20.4853 2.09717L21.8995 3.51138L12.7071 12.7038L11.2954 12.7062L11.2929 11.2896L20.4853 2.09717Z" fill="rgba(70,146,221,1)"></path>
                                    </svg>
                                </button>
                                <button  @click="openDialog()">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" >
                                        <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z" fill="rgba(248,10,10,1)"></path>
                                    </svg>
                                </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div v-if="dialog==true">
            <div lass="h-screen flex items-center justify-center">
                <!-- Dialog Overlay -->
                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
                    <div class="bg-gray-200 p-4 rounded shadow-md w-fit">
                        <button class="float-right text-gray-500 hover:text-gray-700" @click="dialog =!dialog">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                            </svg>
                        </button>
                        <h2 class="text-2xl font-bold mb-4">{{ title + ' USER' }} </h2>
                            <form @submit.prevent="saveUser">

                                <div class="flex justify-center">
                                    <div class="mb-4 ">
                                        <label for="firstName" class="block text-lg font-semibold">First Name</label>
                                        <input v-model="userData.firstName" type="text" id="firstName" class="w-full rounded border p-2" required>
                                    </div>

                                    <div class="mb-4 ml-2" >
                                        <label for="lastName" class="block text-lg  font-semibold">Last Name</label>
                                        <input v-model="userData.lastName" type="text" id="lastName" class="w-full rounded border p-2" required>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                         <div class="mb-4 ">
                                            <label for="phoneNumber" class="block text-lg   font-semibold">Phone Number</label>
                                        <div class="flex justify-between ">
                                            <div class="mt-2 text-sm"> (+63)</div>
                                            <input v-model="userData.phoneNumber" type="tel" id="phoneNumber" class="w-40 rounded border p-2" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="mb-4">
                                    <label for="password" class="block text-lg  font-semibold">Password</label>
                                    <input v-model="userData.password" type="password" id="password" class="w-full rounded border p-2" required>
                                    </div>

                                    <div class="mb-4 ml-2" >
                                    <label for="confirmPassword" class="block text-lg   font-semibold">Confirm Password</label>
                                    <input v-model="userData.confirmPassword" type="password" id="confirmPassword" class="w-full rounded border p-2" required>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="bg-gray-700 w-1/4 text-white p-2 rounded cursor-pointer">Save</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
                title:''
            }
        },
        methods: {
            openDialog(title,item) {
                this.dialog = true
                this.title = title
                console.log(item)
            },
            saveUser() {
                    if (this.userData.password === this.userData.confirmPassword) {
                        console.log(this.userData)
                    } else {
                        alert('Password and Confirm Password do not match.');
                    }
                },
        },

    }
</script>

<style lang="scss" scoped>

</style>
