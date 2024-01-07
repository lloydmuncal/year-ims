<template>
    <div class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="h-max w-full xs:w-1/2 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mx-auto bg-white p-4 rounded-lg space-x-2 space-y-2">
            <div class="flex justify-between items-center">
                <label for="file-upload" class="block text-gray-500 italic">Terms and Condition:</label>
                <button @click="CloseDialog()" class="text-blue-500 hover:text-red-500 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                    </svg>
                </button>
            </div>
            <div class="mt-4 text-sm overflow-y-auto h-[500px]">
                <ol>
                <li class="mb-2">1. Users must provide accurate information during registration and maintain the confidentiality of their account credentials.</li>
                <li class="mb-2">2. Respectful and appropriate behavior is required; harassment or inappropriate content is prohibited.</li>
                <li class="mb-2">3. Content is protected by copyright, and users may not reproduce, distribute, or use content without authorization.</li>
                <li class="mb-2">4. Personal information is collected for platform functionality, adhering to privacy laws.</li>
                <li class="mb-2">5. Unauthorized access attempts or suspicious activity may result in account suspension.</li>
                <li class="mb-2">6. Communication features should be used appropriately; misuse may result in disciplinary actions.</li>
                <li class="mb-2">7. The platform reserves the right to terminate or suspend accounts for violations.</li>
                <li class="mb-2">8.	The platform is not responsible for the accuracy or reliability of user-generated content.</li>
                <li>By using the platform, users agree to the  Privacy Policy.</li>
                </ol>
            </div>
        
</div>

        </div>
</template>

<script>
    export default {
        data() {
            return {
                key: false
            }
        },methods: {
            CloseDialog(){
                this.$emit('CloseDialog',false)
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>