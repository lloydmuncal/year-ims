<template>
    <div>
        <div lass="h-screen flex items-center justify-center">
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
                <div class="bg-gray-200 p-4 rounded shadow-md w-fit">
                    <button class="float-right text-gray-500 hover:text-gray-700">
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
                                <div class="mb-4 ml-2">
                                <label for="lrn" class="block text-lg  font-semibold">LRN</label>
                                    <input v-model="userData.lrn" type="text" id="lrn" class="w-full rounded border p-2" required>
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
</template>
<script>
    export default {
        data() {
            return {
                userData: {

                }
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
